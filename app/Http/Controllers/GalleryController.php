<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    // Menampilkan semua gambar untuk villa tertentu
    public function index($villaId)
    {
        $galleries = Gallery::where('villa_id', $villaId)->get();
        return response()->json($galleries);
    }

    // Menambahkan gambar ke galeri
    public function store(Request $request)
    {
        $validated = $request->validate([
            'villa_id' => 'required|exists:villas,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'caption' => 'nullable|string|max:255',
        ]);

        // Simpan file gambar ke storage
        $imagePath = $request->file('image')->store('villa_galleries', 'public');

        // Simpan data ke database
        $gallery = Gallery::create([
            'villa_id' => $validated['villa_id'],
            'image_path' => $imagePath,
            'caption' => $validated['caption'],
        ]);

        return response()->json($gallery, 201);
    }

    // Menampilkan detail gambar berdasarkan ID
    public function show($id)
    {
        $gallery = Gallery::findOrFail($id);
        return response()->json($gallery);
    }

    // Memperbarui data galeri
    public function update(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);

        $validated = $request->validate([
            'caption' => 'nullable|string|max:255',
        ]);

        // Jika ada gambar baru, hapus gambar lama dan simpan yang baru
        if ($request->hasFile('image')) {
            $validated = $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            // Hapus gambar lama dari storage
            if ($gallery->image_path) {
                Storage::disk('public')->delete($gallery->image_path);
            }

            // Simpan gambar baru
            $imagePath = $request->file('image')->store('villa_galleries', 'public');
            $gallery->image_path = $imagePath;
        }

        $gallery->caption = $validated['caption'] ?? $gallery->caption;
        $gallery->save();

        return response()->json($gallery);
    }

    // Menghapus gambar dari galeri
    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);

        // Hapus gambar dari storage
        if ($gallery->image_path) {
            Storage::disk('public')->delete($gallery->image_path);
        }

        $gallery->delete();

        return response()->json(['message' => 'Gallery image deleted successfully']);
    }
}
