<?php

namespace App\Http\Controllers;

use App\Models\TransportationService;
use Illuminate\Http\Request;

class TransportationServiceController extends Controller
{
    // Menampilkan semua layanan transportasi
    public function index()
    {
        $services = TransportationService::all();
        return response()->json($services);
    }

    // Menampilkan layanan transportasi berdasarkan ID
    public function show($id)
    {
        $service = TransportationService::findOrFail($id);
        return response()->json($service);
    }

    // Menambahkan layanan transportasi baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'villa_id' => 'required|exists:villas,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
        ]);

        $service = TransportationService::create($validated);
        return response()->json($service, 201);
    }

    // Memperbarui layanan transportasi
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'villa_id' => 'required|exists:villas,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
        ]);

        $service = TransportationService::findOrFail($id);
        $service->update($validated);
        return response()->json($service);
    }

    // Menghapus layanan transportasi
    public function destroy($id)
    {
        $service = TransportationService::findOrFail($id);
        $service->delete();
        return response()->json(null, 204);
    }
}
