<?php

namespace App\Http\Controllers;

use App\Models\Camera;
use Illuminate\Http\Request;

class CameraController extends Controller
{
    public function index()
    {
        $cameras = Camera::all();
        return response()->json($cameras);
    }

    public function show($id)
    {
        $camera = Camera::findOrFail($id);
        return response()->json($camera);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $camera = Camera::create($validated);

        return response()->json($camera, 201);
    }

    public function update(Request $request, $id)
    {
        $camera = Camera::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        if ($camera->update($validated)) return response()->json($camera);

        return response()->json($camera);
    }

    public function destroy($id)
    {
        $camera = Camera::findOrFail($id);
        $camera->delete();

        return response()->json(null, 204);
    }
}
