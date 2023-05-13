<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserInformation\DeletedUser;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
                    ->select('users.id', 'users.name', 'users.is_approved' ,'p.phone_number', 'e.arrival_year')
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

        return view('admin.adminkeu.data-alumni', [
            'graduatedUsers' => $users,
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
}
