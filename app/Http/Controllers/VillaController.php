<?php

namespace App\Http\Controllers;

use App\Models\Villa;
use Illuminate\Http\Request;

class VillaController extends Controller
{
    // Menampilkan semua villa
    public function index()
    {
        // Mengambil semua data villa dan mengembalikan dalam format JSON
        $villas = Villa::all();
        return response()->json($villas);
    }

    // Menampilkan detail villa berdasarkan ID
    public function show($id)
    {
        // Mencari villa berdasarkan ID
        $villa = Villa::findOrFail($id);
    
        // Mengembalikan data villa dalam format JSON dengan struktur 'data'
        return response()->json(['data' => $villa]);
    }
    

    // Menyimpan data villa baru
    public function store(Request $request)
    {
        // Validasi data yang dikirim
        $validated = $this->validateVilla($request);

        // Membuat villa baru berdasarkan data yang telah divalidasi
        $villa = Villa::create($validated);

        // Mengembalikan response dengan data villa yang baru dibuat
        return response()->json($villa, 201); // HTTP status 201 artinya berhasil membuat resource baru
    }

    // Memperbarui data villa
// app/Http/Controllers/VillaController.php

public function update(Request $request, $id)
{
    // Validasi data yang diterima
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string|max:1000',
        'price' => 'required|numeric',
        'capacity' => 'required|numeric',
    ]);

    // Temukan villa berdasarkan ID
    $villa = Villa::find($id);
    
    // Jika villa tidak ditemukan
    if (!$villa) {
        return response()->json(['message' => 'Villa not found'], 404);
    }

    // Update data villa
    $villa->name = $request->name;
    $villa->description = $request->description;
    $villa->price = $request->price;
    $villa->capacity = $request->capacity;

    // Simpan perubahan
    $villa->save();

    return response()->json(['message' => 'Villa updated successfully', 'data' => $villa]);
}

    // Menghapus villa berdasarkan ID
    public function destroy($id)
    {
        try {
            // Mencari villa berdasarkan ID
            $villa = Villa::findOrFail($id);

            // Menghapus villa
            $villa->delete();

            // Mengembalikan pesan sukses
            return response()->json(['message' => 'Villa berhasil dihapus!']);
        } catch (\Exception $e) {
            // Menangani error jika villa tidak ditemukan
            return response()->json(['error' => 'Villa not found'], 404);
        }
    }

    // Fungsi untuk validasi data villa yang digunakan untuk store dan update
    private function validateVilla(Request $request)
    {
        // Validasi data yang diterima oleh request
        return $request->validate([
            'name' => 'required|string|max:255',       // Validasi untuk nama villa
            'description' => 'required|string',        // Validasi untuk deskripsi
            'price' => 'required|numeric|min:0',       // Validasi untuk harga villa
            'capacity' => 'required|integer|min:1',    // Validasi untuk kapasitas
        ]);
    }
}
