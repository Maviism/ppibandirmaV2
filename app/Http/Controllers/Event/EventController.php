<?php

namespace App\Http\Controllers\Event;

use App\Models\User;
use App\Models\Event\Event;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::with('absensi')->orderBy('datetime', 'desc')->get();
        return view('admin.event.event', [
            'events' => $events
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.event.create-event');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventRequest $request)
    {

        $file = $request->file('file');
        $total_participant = User::leftJoin('education as e', 'users.id', '=','e.user_id')
                            ->whereNotIn('e.status', ['lulus'])
                            ->get()->count();

        $event = Event::create([
            'title' => $request->iTitle,
            'venue' => $request->iVenue,
            'description' => $request-> iDescription,
            'datetime' => $request->iDatetime,
            'type' => $request->iType,
            'total_participants' => $total_participant
        ]);

        if ($request->hasFile('ifImage')) {
            $image = $request->file('ifImage');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/images/events', $filename);
            $event->image_url = $filename;
            $event->save();
        }

        return redirect('/admin/event')->with('success', 'Event created successfully.');

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
        $event = Event::find($id);
        return view('admin.event.edit-event', [
            'event' => $event
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreEventRequest $request, string $id)
    {
        $event = Event::find($id);

        $event->update([
            'title' => $request->iTitle,
            'venue' => $request->iVenue,
            'description' => $request-> iDescription,
            'datetime' => $request->iDatetime,
            'type' => $request->iType,
        ]);

        if ($request->hasFile('ifImage')) {

            $image = $request->file('ifImage');
            $filename = time() . '.' . $image->getClientOriginalExtension();

            // Delete the old image if exist
            if (!empty($event->image_url)) {
                Storage::delete('public/images/events/' . $event->image_url); 
            }
            $image->storeAs('public/images/events', $filename);
            $event->image_url = $filename;
            $event->save();
        }

        return redirect('/admin/event')->with('success', 'Event edited successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $event = Event::find($id);

        if (!$event) {
            return response()->json([
                'status' => 'error',
                'message' => 'Event not found',
            ], 404);
        }
        if (!empty($event->image_url)) {
            Storage::delete('public/images/events/' . $event->image_url); 
        }
    
        $event->delete();
    
        return response()->json([
            'status' => 'success',
            'message' => 'Event deleted successfully',
        ]);

        return redirect('/admin/event')->with('success', 'Event deleted successfully.');
    }
}
