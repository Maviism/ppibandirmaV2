<?php

namespace App\Http\Controllers\Organisation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Organisation\Kabinet;
use App\Models\Organisation\KabinetPerson;
use App\Http\Requests\StoreKabinetRequest;
use Illuminate\Support\Facades\DB;

class KabinetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kabinets = Kabinet::select('kabinets.id', 'kabinets.name', 'kabinets.periode', 'kabinets.logo_url',DB::raw('COUNT(DISTINCT kabinet_people.position) - 2 as position_count'), DB::raw('COUNT(kabinet_people.position) as people_count'))
                    ->leftJoin('kabinet_people', 'kabinets.id', '=', 'kabinet_people.kabinet_id')
                    ->groupBy('kabinets.id')
                    ->get();
    
        return view('admin.organisasi.kabinet',[
            'kabinets' => $kabinets
        ]);
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
    public function store(StoreKabinetRequest $request)
    {
        $positions = $request->input('position');
        // dd($request->all());

        $kabinet = Kabinet::create([
            'name' => $request->iName,
            'periode' => $request->iPeriode,
            'description' => $request->iDescription
        ]);

        if ($request->hasFile('ifLogoImage')) {
            $image = $request->file('ifLogoImage');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/images/kabinet', $filename);
            $kabinet->logo_url = $filename;
            $kabinet->save();
        }
        
        // Lakukan loop untuk menyimpan posisi dan anggota-anggotanya
        foreach($positions as $position){
            // $posisi_model->name = $position['name'];
            // $posisi_model->save();
            // Loop untuk menyimpan anggota
            foreach($position['members'] as $member){
                $kabinet_person = KabinetPerson::create([
                    'kabinet_id' => $kabinet->id,
                    'name' => $member['name'],
                    'position' => $position['name'],
                    'instagram' => $member['instagram']
                ]);

            }
        }

        return redirect('/admin/kabinet');

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
        $kabinet = Kabinet::with('kabinetPerson')->find($id);

        // dd($kabinet->kabinetPerson->groupBy('position'));
        return view('admin.organisasi.edit-kabinet', [
            'kabinet' => $kabinet
        ]);
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
        $kabinet = Kabinet::find($id);
        $name =$kabinet->name;
        $kabinet->delete();
        return response()->json([
            'message' => "Kabinet '$name' has been deleted."
        ]);
    }
}
