<?php

namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event\Event;
use App\Models\Event\Absensi;
use App\Models\User;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

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
    public function store(Request $request, $id)
    {
        // dd($request->iEventId);        
        $user = User::find($id);
        $eventId = $request->iEventId;

        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }
        //check is user has absen
        $absen = Absensi::where('event_id', $eventId)->where('user_id', $id)->first();
        if($absen){
            return response()->json(['message' => 'User sudah registrasi :).'], 404);
        }

        $absensi  = Absensi::create([
            'user_id' => $user->id,
            'event_id' => $eventId
        ]);

        if ($absensi != null) {
            return response()->json(['message' => 'Absen berhasil dicatat.']);
        } else {
            return response()->json(['message' => 'Absen gagal dicatat.'], 500);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $event = Event::find($id);
        $users = User::get();
        $registeredUser = Absensi::with('user')->where('event_id', $id)->get();
        return view('admin.event.absensi', [
            'event' => $event,
            'users' => $users,
            'registeredUsers' => $registeredUser
        ]);
    }

    public function showScanner(string $id)
    {
        $event = Event::find($id);
        return view('admin.event.scanner', [
            'event' => $event
        ]);
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
        $absensi = Absensi::findOrFail($id);
        $absensi->delete();
        
        return redirect()->back();
    }
}
