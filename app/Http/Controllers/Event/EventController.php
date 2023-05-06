<?php

namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventRequest;
use App\Models\Event\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::get();
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
        //
        $file = $request->file('file');
        $event = Event::create([
            'title' => $request->iTitle,
            'venue' => $request->iVenue,
            'description' => $request-> iDescription,
            'datetime' => $request->iDatetime ,
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
