<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    // Menampilkan semua review
    public function index()
    {
        $reviews = Review::with('villa')->get();
        return response()->json($reviews);
    }

    // Menampilkan review berdasarkan ID
    public function show($id)
    {
        $review = Review::with('villa')->findOrFail($id);
        return response()->json($review);
    }

    // Menambahkan review baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'villa_id' => 'required|exists:villas,id',
            'customer_name' => 'required|string|max:255',
            'review' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $review = Review::create($validated);
        return response()->json($review, 201);
    }

    // Memperbarui review
    public function update(Request $request, $id)
    {
        $review = Review::findOrFail($id);

        $validated = $request->validate([
            'villa_id' => 'sometimes|exists:villas,id',
            'customer_name' => 'sometimes|string|max:255',
            'review' => 'sometimes|string',
            'rating' => 'sometimes|integer|min:1|max:5',
        ]);

        $review->update($validated);
        return response()->json($review);
    }

    // Menghapus review
    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();
        return response()->json(['message' => 'Review berhasil dihapus']);
    }
}
