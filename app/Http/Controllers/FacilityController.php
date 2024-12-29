<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    // Menampilkan semua fasilitas untuk villa tertentu
    public function index($villaId)
    {
        $facilities = Facility::where('villa_id', $villaId)->get();
        return response()->json($facilities);
    }

    // Menambahkan fasilitas baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'villa_id' => 'required|exists:villas,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $facility = Facility::create($validated);
        return response()->json($facility, 201);
    }

    // Menampilkan detail fasilitas berdasarkan ID
    public function show($id)
    {
        $facility = Facility::findOrFail($id);
        return response()->json($facility);
    }

    // Memperbarui fasilitas
    public function update(Request $request, $id)
    {
        $facility = Facility::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $facility->update($validated);
        return response()->json($facility);
    }

    // Menghapus fasilitas
    public function destroy($id)
    {
        $facility = Facility::findOrFail($id);
        $facility->delete();

        return response()->json(['message' => 'Facility deleted successfully']);
    }
}
