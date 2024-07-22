<?php

namespace App\Http\Controllers;

use App\Models\EventType;
use Illuminate\Http\Request;

class EventTypeController extends Controller
{
    public function index()
    {
        $eventTypes = EventType::all();
        return response()->json($eventTypes);
    }

    public function show($id)
    {
        $eventType = EventType::findOrFail($id);
        return response()->json($eventType);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $eventType = EventType::create($validated);

        return response()->json($eventType, 201);
    }

    public function update(Request $request, $id)
    {
        $eventType = EventType::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $eventType->update($validated);

        return response()->json($eventType);
    }

    public function destroy($id)
    {
        $eventType = EventType::findOrFail($id);
        $eventType->delete();

        return response()->json(null, 204);
    }
}

