<?php

namespace App\Http\Controllers;

use App\Models\VillaEvent;
use Illuminate\Http\Request;

class VillaEventController extends Controller
{
    // Menampilkan daftar semua event
    public function index()
    {
        $events = VillaEvent::all();
        return response()->json($events);
    }

    // Menampilkan detail event
    public function show($id)
    {
        $event = VillaEvent::findOrFail($id);
        return response()->json($event);
    }

    // Menambahkan event baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'villa_id' => 'required|exists:villas,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        $event = VillaEvent::create($validated);
        return response()->json($event, 201);
    }

    // Memperbarui event
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'villa_id' => 'required|exists:villas,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        $event = VillaEvent::findOrFail($id);
        $event->update($validated);
        return response()->json($event);
    }

    // Menghapus event
    public function destroy($id)
    {
        $event = VillaEvent::findOrFail($id);
        $event->delete();
        return response()->json(null, 204);
    }
}
