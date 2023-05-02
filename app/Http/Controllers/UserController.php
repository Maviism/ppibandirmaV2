<?php

namespace App\Http\Controllers;

use App\Models\User;
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

    public function analytic(){
        return view('admin.adminkeu.analytic');
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
            return redirect('admin/data-anggota/create');
        }
        return redirect('admin/data-anggota')->with('sweetAlert', true);
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
