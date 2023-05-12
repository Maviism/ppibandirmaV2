<?php

namespace App\Http\Controllers\Organisation;

use App\Http\Controllers\Controller;
use App\Models\Organisation\DesignRequest;
use Illuminate\Http\Request;

class DesignRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $designs = DesignRequest::all();
        return view('admin.medkraf.index', [
            'designs' => $designs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.medkraf.create-request');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'iDepartment' => 'required',
            'iTitle' => 'required|string',
            'iContent' => 'nullable|string',
            'idDeadline' => 'required|string',
            'ifImageReference' => 'nullable|image|max:5124'
        ]);

        $design = DesignRequest::create([
            'department' => $request->iDepartment,
            'responsible' => auth()->user()->name,
            'title' => $request->iTitle,
            'content' => $request->iContent,
            'deadline' => $request->idDeadline,
        ]);

        if ($request->hasFile('ifImageReference')) {
            $image = $request->file('ifImageReference');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/images/designreferences', $filename);
            $design->img_reference_url = $filename;
            $design->save();
        }

        return redirect('/admin');

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
        $design = DesignRequest::find($id);
        return view('admin.medkraf.update-request',[
            'design' => $design
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $design = DesignRequest::find($id);

        $design->update([
            'assign_to' => $request->iAssign,
            'status' => $request->iStatus
        ]);

        return redirect('admin/design');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
