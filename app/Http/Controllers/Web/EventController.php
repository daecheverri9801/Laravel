<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\Venue;
use Inertia\Inertia;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Events/Index', [
            'events' => Event::with('venue')->get(),
            'venues' => Venue::all(),
            'message' => session('message')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Events/Create', [
            'venues' => Venue::all(),
            'selectedVenue' => request('venue_id')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'event_name' => 'required|string|max:255',
            'event_date' => 'required|date',
            'event_is_virtual' => 'boolean',
            'event_speaker_name' => 'required|string|max:255',
            'fk_venue_event' => 'nullable|exists:venues,id',
        ]);

        Event::create($validated);

        return redirect()->route('events.index')
            ->with('message', 'Event created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        return Inertia::render('Events/Show', [
            'event' => $event->load('venue')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        return Inertia::render('Events/Edit', [
            'event' => $event,
            'venues' => Venue::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'event_name' => 'required|string|max:255',
            'event_date' => 'required|date',
            'event_is_virtual' => 'boolean',
            'event_speaker_name' => 'required|string|max:255',
            'fk_venue_event' => 'nullable|exists:venues,id',
        ]);

        $event->update($validated);

        return redirect()->route('events.index')
            ->with('message', 'Event updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('events.index')
            ->with('message', 'Event deleted successfully.');
    }
}
