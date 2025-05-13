<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // return view('events.index', [
        //     'events' => Event::all()
        // ]);
        // return Event::all(); mostrar todos los evento
        return Event::where('event_name', 'ilike', "%$request->search%")
            ->orderBy('event_date', 'desc')
            ->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventRequest $request)
    {
        $event = Event::create($request->all());
        return response()->json($event, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        // return $event;
        // $event = Event::find($id);
        return response()->json(['status' => true, 'event' => $event]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        if ($event->update($request->all())) {
            return response()->json(['status' => true, 'event' => $event]);
        }
        return response()->json(['status' => false, 'message' => 'Event not updated']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        if ($event->delete()) {
            return response()->json(['status' => true, 'message' => 'Event deleted']);
        }
        return response()->json(['status' => false, 'message' => 'Event not deleted']);
    }
}
