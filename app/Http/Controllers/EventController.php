<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return response()->json($events);
    }

    public function show($id)
    {
        $event = Event::with('camera', 'eventType')->findOrFail($id);
        return response()->json($event);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'camera_id' => 'required|exists:cameras,id',
            'event_type_id' => 'required|exists:event_types,id',
            'frame_url' => 'required|string|max:255',
        ]);

        $event = Event::create($validated);

        return response()->json($event, 201);
    }

    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $validated = $request->validate([
            'camera_id' => 'required|exists:cameras,id',
            'event_type_id' => 'required|exists:event_types,id',
            'frame_url' => 'required|string|max:255',
        ]);

        $event->update($validated);

        return response()->json($event);
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return response()->json(null, 204);
    }

    public function getEventsByCameraAndPeriod(Request $request, $id)
    {
        $validated = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        $events = Event::where('camera_id', $id)
            ->whereBetween('created_at', [$validated['start_date'], $validated['end_date']])
            ->get();

        return response()->json($events);
    }
}

