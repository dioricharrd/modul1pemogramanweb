<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    // Menampilkan semua reservation
    public function index()
    {
        // Mengambil semua data reservation dan mengembalikan dalam format JSON
        $reservations = Reservation::all();
        return response()->json($reservations);
    }

    // Menampilkan detail reservation berdasarkan ID
    public function show($id)
    {
        // Menemukan reservation berdasarkan ID, jika tidak ditemukan akan mengembalikan error 404
        $reservation = Reservation::findOrFail($id);
        return response()->json($reservation);
    }

    // Menyimpan data reservation baru
    public function store(Request $request)
    {
        // Validasi data yang dikirim
        $validated = $this->validateReservation($request);

        // Membuat reservation baru berdasarkan data yang telah divalidasi
        $reservation = Reservation::create($validated);

        // Mengembalikan response dengan data reservation yang baru dibuat
        return response()->json($reservation, 201); // HTTP status 201 artinya berhasil membuat resource baru
    }

    // Memperbarui data reservation
    public function update(Request $request, $id)
    {
        // Mencari reservation berdasarkan ID
        $reservation = Reservation::findOrFail($id);

        // Validasi data yang dikirim
        $validated = $this->validateReservation($request);

        // Memperbarui data reservation berdasarkan data yang telah divalidasi
        $reservation->update($validated);

        // Mengembalikan data reservation yang telah diperbarui
        return response()->json($reservation);
    }

    // Menghapus reservation berdasarkan ID
    public function destroy($id)
    {
        // Mencari reservation berdasarkan ID
        $reservation = Reservation::findOrFail($id);

        // Menghapus reservation
        $reservation->delete();

        // Mengembalikan pesan sukses
        return response()->json(['message' => 'Reservation berhasil dihapus!']);
    }

    // Fungsi untuk validasi data reservation yang digunakan untuk store dan update
    private function validateReservation(Request $request)
    {
        // Validasi data yang diterima oleh request
        return $request->validate([
            'villa_id' => 'required|exists:villas,id', // Validasi untuk villa_id, harus ada di tabel villas
            'customer_name' => 'required|string|max:255', // Validasi untuk nama pelanggan
            'check_in' => 'required|date', // Validasi untuk tanggal check-in
            'check_out' => 'required|date|after:check_in', // Validasi untuk tanggal check-out
            'number_of_guests' => 'required|integer|min:1', // Validasi untuk jumlah tamu
        ]);
    }
}
