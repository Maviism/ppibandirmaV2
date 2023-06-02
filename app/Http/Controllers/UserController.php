<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserInformation\DeletedUser;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Response;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $allUsers = User::leftJoin('personal_information as p', 'users.id', '=', 'p.user_id')
                    ->leftJoin('education as e', 'users.id', '=', 'e.user_id')
                    ->whereNotIn('e.status', ['lulus']) 
                    ->select('users.id', 'users.name', 'users.is_approved' ,'p.phone_number', 'e.arrival_year', 'e.university', 'e.faculty', 'e.department', 'e.status', 'e.type_of_education')
                    ->orderBy('users.name', 'ASC')
                    ->get();
        $users = $allUsers->where('is_approved', 1);
        $unapprovedUser = $allUsers->where('is_approved', 0);

        return view('admin.adminkeu.data-anggota', [
            'users' => $users,
            'unapprovedUser' => $unapprovedUser
        ]);
    }

    public function dataAlumni()
    {
        $users = User::leftJoin('personal_information as p', 'users.id', '=', 'p.user_id')
                    ->leftJoin('education as e', 'users.id', '=', 'e.user_id')
                    ->where('e.status', ['lulus']) 
                    ->select('users.id', 'users.name', 'users.is_approved' ,'p.phone_number', 'e.arrival_year')
                    ->get();

        $deletedUsers = DeletedUser::get();            

        return view('admin.adminkeu.data-alumni', [
            'graduatedUsers' => $users,
            'deletedUsers' => $deletedUsers
        ]);
    }

    public function analytic()
    {
        $arrivalYearData = User::leftJoin('personal_information as p', 'users.id', '=', 'p.user_id')
                            ->leftJoin('education as e', 'users.id', '=', 'e.user_id')
                            ->select('e.arrival_year', 
                                    DB::raw('SUM(CASE WHEN p.gender = "Laki-laki" THEN 1 ELSE 0 END) AS male'), 
                                    DB::raw('SUM(CASE WHEN p.gender = "Perempuan" THEN 1 ELSE 0 END) AS female'))
                            ->groupBy('e.arrival_year')
                            ->get();
        $educationType = DB::table('education')
                            ->select('type_of_education', DB::raw('COUNT(*) as count'))
                            ->whereNotIn('status', ['lulus']) 
                            ->groupBy('type_of_education')
                            ->get();
        $educationStatus = DB::table('education')->select('status', DB::raw('COUNT(*) as count'))->groupBy('status')->get();
                            
        $universityData = DB::table('education')
                            ->select('university', DB::raw('COUNT(*) as count'))
                            ->whereNotIn('status', ['lulus'])
                            ->groupBy('university')
                            ->orderBy('count', 'Desc')
                            ->get();
        $facultyCounts = DB::table('education')
                        ->select('university', 'faculty', DB::raw('count(*) as count'))
                        ->whereNotIn('status', ['lulus'])
                        ->groupBy('university', 'faculty')
                        ->orderBy('count', 'Desc')
                        ->get();

        // dd($facultyCounts);
        return view('admin.adminkeu.analytic', [
            'arrivalYearData' => $arrivalYearData,
            'educationType' => $educationType,
            'educationStatus' => $educationStatus,
            'universityData' => $universityData,
            'facultyCounts' => $facultyCounts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.adminkeu.tambah-anggota');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        try {
            DB::transaction(function () use ($request) : void{
                $user = User::create([
                    'name' => $request->iFullname,
                    'email' => $request->iMail,
                    'password' => Hash::make(Str::random(16)),
                    'is_approved' => 1
                ]);
            
                $user->personalInformation()->create([
                    'phone_number' => $request->iPhone,
                    'birthday' => $request->iBirthday,
                    'gender' => $request->iGender,
                    'address_tr' => $request->iAddress,
                ]);

                $user->education()->create([
                    'arrival_year' => $request->iArrivalYear,
                    'type_of_education' => $request->iEducationType,
                    'university' => $request->iUniv,
                    'faculty' => $request->iFaculty,
                    'department' => $request->iDepartment,
                    'status' => $request->iStatus,
                ]);
            });
        } catch (Exception $e) {
            if (isset($user)) {
                $user->delete();
            }
            return redirect('admin/dataanggota/create');
        }
        return redirect('admin/dataanggota')->with('sweetAlert', true);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::leftJoin('personal_information as p', 'users.id', '=', 'p.user_id')
                    ->leftJoin('education as e', 'users.id', '=', 'e.user_id')
                    ->where('users.id', $id) 
                    ->select('users.id', 'users.role','users.name', 'users.email', 'users.is_approved' ,'p.*', 'e.*')
                    ->first();
        return view('admin.adminkeu.edit-anggota', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUserRequest $request, string $id)
    {
        //
        $user = User::with(['education', 'personalInformation'])->find($id);
        $isAlumni = $user->education->status;
        $user->update([
            'name' => $request->iFullname,
            'email' => $request->iMail,
            'is_approved' => 1,
        ]);
        
        if(isset($request->iRole)){
            $user->update([
                'role' => $request->iRole
            ]);
        }

        $education = $user->education;
        $education->update([
            'status' => $request->iStatus,
            'arrival_year' => $request->iArrivalYear,
            'type_of_education' => $request->iEducationType,
            'university' => $request->iUniv,
            'faculty' => $request->iFaculty,
            'department' => $request->iDepartment,
        ]);

        $profil = $user->personalInformation;
        $profil->update([
            'phone_number' => $request->iPhone,
            'birthday' => $request->iBirthday,
            'gender' => $request->iGender,
            'address_tr' => $request->iAddress,
        ]);

        $message = '';
        if($request->typeRequest == 'review'){
            $message = 'Data '. $user->name .' berhasil ditambahkan!';
        }elseif($request->typeRequest == 'edit'){
            $message = 'Data berhasil diubah!';
        }

        if($isAlumni === 'Lulus'){
            return redirect('admin/dataalumni')->with('success', $message);
        }

        return redirect('admin/dataanggota')->with('success', $message);
    }

    public function showUserReview(string $id)
    {
        $user = User::leftJoin('personal_information as p', 'users.id', '=', 'p.user_id')
                    ->leftJoin('education as e', 'users.id', '=', 'e.user_id')
                    ->where('users.id', $id) 
                    ->select('users.id', 'users.name', 'users.email', 'users.is_approved' ,'p.*', 'e.*')
                    ->first();
        if($user->is_approved){
            return redirect('/admin/data-anggota');
        }
        return view('admin.adminkeu.review-anggota', [
            'user' => $user
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $request->validate([
            'reason' => 'required|string'
        ]);
        $user = User::findOrFail($id);
        $name = $user->name;
        $arrival_year = $user->education->arrival_year;
        DeletedUser::create([
            'name' => $name,
            'arrival_year' => $arrival_year,
            'reason' => $request->reason
        ]);
        $user->delete();
        
        return response()->json([
            'message' => "User '$name' has been deleted."
        ]);
    }

    public function unapproveuser(string $id){
        $user = User::findOrFail($id);
        $name = $user->name;
        $user->delete();

        return redirect('admin/dataanggota')->with('success', 'kamu baru saja menghapus data '. $name);
    }

    public function generateMembershipCard($id)
    {
        // Load the membership card template image
        $decrypted;
        try {
            $decrypted =  Crypt::decrypt($id);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            // Handle decryption error, such as returning null or throwing an exception
            abort(404);
        }
        $user = User::with('education')->findOrFail($decrypted);
        
        $templatePath = storage_path('app/card.png');
        $image = Image::make($templatePath);

        $userName = ucwords(strtolower($user->name));
        $parts = explode(" ", $userName); // Split the name into individual parts
        
        // Process the first and second names
        $firstName = $parts[0] ?? "";
        $secondName = $parts[1] ?? "";
        
        // Process the remaining names
        $initials = "";
        for ($i = 2; $i < count($parts); $i++) {
            $initials .= substr($parts[$i], 0, 1) . ".";
        }
        
        $modifiedName = $firstName . " " . $secondName . " " . trim($initials);
        // Customize the membership card with the person's name
        $image->text($modifiedName, 57, 600, function ($font) {
            $font->file(public_path('/assets/fonts/Mark-Pro-Bold.ttf')); 
            $font->size(32);
            $font->color('#000');
            $font->valign('middle');
        });

        $image->text($user->education->department, 57, 630, function ($font) {
            $font->file(public_path('/assets/fonts/Mark-Pro.ttf')); 
            $font->size(24);
            $font->color('#555d50');
            $font->valign('middle');
        });

        $qrCodeFilePath = public_path('/assets/qrcode.png');
        $qrCode = QrCode::format('png')
                ->style('round')
                ->margin(1)
                ->errorCorrection('Q')
                ->eye('circle')
                ->eyeColor(0, 0, 0, 0, 91, 185, 50)
                ->eyeColor(1, 0, 0, 0, 33, 136, 255)
                ->eyeColor(2, 0, 0, 0, 219, 76, 159)
                ->size(300)
                ->generate($user->email, $qrCodeFilePath);
        
        $qrCodeImage = Image::make($qrCodeFilePath)->resize(250, 250);
        $image->insert($qrCodeImage, 'center', -26, 64);    

        $imageData = $image->encode('jpg')->getEncoded();

        // Return the image as a response with the .jpg extension
        return response($imageData)->header('Content-Type', 'image/jpeg');
    }

}
