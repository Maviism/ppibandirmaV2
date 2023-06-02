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
    public function store(Request $request)
    {
        $user = User::where('email', $request->iEmail)->first();
        $eventId = $request->iEventId;
        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }
        //check is user has absen
        $absen = Absensi::where('event_id', $eventId)->where('user_id', $user->id)->first();
        if($absen){
            return response()->json(['message' => 'Kamu sudah registrasi']);
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
        if($event->type == 'Internal'){
            $users = User::with('education')->where('role', '!=', 'user')->get();
        }else {
            $users = User::with('education')->get();
        }
        $registeredUser = Absensi::with('user')->where('event_id', $id)->get();
        $registeredUsers = $registeredUser->pluck('user.id')->toArray(); // Get the IDs of registered users

        $usersRegistered = $users->whereIn('id', $registeredUsers); // Get the collection of registered users
        $usersNotRegistered = $users->whereNotIn('id', $registeredUsers); // Get the collection of users who haven't registered
        return view('admin.event.absensi', [
            'event' => $event,
            'users' => $usersNotRegistered,
            'registeredUsers' => $usersRegistered
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
