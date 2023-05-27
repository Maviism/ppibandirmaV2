<?php

namespace App\Http\Controllers\Organisation;

use App\Http\Controllers\Controller;
use App\Models\Organisation\DesignRequest;
use Illuminate\Http\Request;
use App\Services\WhatsappService;
use Illuminate\Support\Facades\Mail;


class DesignRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected $whatsappService;

    public function __construct(WhatsappService $whatsappService)
    {
        $this->whatsappService = $whatsappService;
    }
    public function index()
    {
        $designs = DesignRequest::orderBy('created_at', 'desc')->get();
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
            'ifImageReference' => 'nullable|max:5124',
            'ifImageReference.*' => 'nullable|max:5124'
        ]);


        $design = DesignRequest::create([
            'department' => $request->iDepartment,
            'responsible' => auth()->user()->name,
            'title' => $request->iTitle,
            'content' => $request->iContent,
            'deadline' => $request->idDeadline,
        ]);

        if ($request->hasFile('ifImageReference')) {
            $images = $request->file('ifImageReference');
            if(!is_null($images)){
                foreach($images as $imageUrl){
                    $filename = uniqid() . '.' . $imageUrl->getClientOriginalExtension();
                    $imageUrl->storeAs('public/images/designreferences', $filename);
                    $design->imageReferences()->create([
                        'img_reference_url' => $filename
                    ]);
                }
            }
        }

        $url = config('app.url') . '/admin/design/' . $design->id . '/edit';
        $message = "Ada request design lagi nih dari divisi " . $request->iDepartment . ".\nCek disini ya: " . $url;
        $recepient = config('whatsapp.recipient.medkraf.group_name');
        $is_group = config('whatsapp.recipient.medkraf.is_group');
        $this->whatsappService->sendMessage($recepient, $is_group , $message);

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

    public function sendMessage()
    {
        // dd('hello');
        
    }

}
