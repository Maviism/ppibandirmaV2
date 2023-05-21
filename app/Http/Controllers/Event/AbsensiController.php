<?php

namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event\Event;
use App\Models\Event\Absensi;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $userId = $id;
        if($request->iType == 'scanner'){
            try {
                $userId = Crypt::decrypt($id);
            } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                // Handle decryption error, such as returning null or throwing an exception
                return response()->json(['message' => 'User not found.'], 404);
            }
        }

        $user = User::find($userId);
        $eventId = $request->iEventId;

        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }
        //check is user has absen
        $absen = Absensi::where('event_id', $eventId)->where('user_id', $userId)->first();
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
