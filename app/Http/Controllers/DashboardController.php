<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Organisation\DesignRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $arrivalYearData = User::leftJoin('personal_information as p', 'users.id', '=', 'p.user_id')
                            ->leftJoin('education as e', 'users.id', '=', 'e.user_id')
                            ->select('e.arrival_year', 
                                    DB::raw('SUM(CASE WHEN p.gender = "Laki-laki" THEN 1 ELSE 0 END) AS male'), 
                                    DB::raw('SUM(CASE WHEN p.gender = "Perempuan" THEN 1 ELSE 0 END) AS female'))
                            ->groupBy('e.arrival_year')
                            ->get();
        
        $educationStatus = DB::table('education')->select('status', DB::raw('COUNT(*) as count'))->groupBy('status')->get();
                            
        $designRequest = DesignRequest::where('deadline', '>=', date('Y/m/d'))->get();
        
        return view('admin.dashboard',[
            'designRequest' => $designRequest,
            'arrivalYearData' => $arrivalYearData,
            'educationStatus' => $educationStatus
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
