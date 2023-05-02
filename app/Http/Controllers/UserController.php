<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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
    public function store(Request $request)
    {
        return 'hello';
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
