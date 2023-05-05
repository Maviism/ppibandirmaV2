<?php

namespace App\Http\Controllers\Organisation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Organisation\Kabinet;
use App\Models\Organisation\KabinetPerson;

class KabinetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.organisasi.kabinet');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.organisasi.tambah-kabinet');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $positions = $request->input('position');

        dd($request->all());
        // Lakukan validasi input disini

        // Lakukan loop untuk menyimpan posisi dan anggota-anggotanya
        foreach($positions as $position){
            $posisi_model->name = $position['name'];
            $posisi_model->save();

            // Loop untuk menyimpan anggota
            foreach($position['members'] as $member){
                $anggota_model = new Anggota;
                $anggota_model->name = $member['name'];
                $anggota_model->position_id = $posisi_model->id; // set foreign key
                $anggota_model->save();
            }
        }

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
