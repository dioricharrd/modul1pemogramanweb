<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Resources\ReservationResource;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with('villa')->get();
        return response()->json($reservations);
    }
    
    public function show($id)
    {
        $reservation = Reservation::with('villa')->findOrFail($id);
        return response()->json($reservation);
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'villa_id' => 'required|exists:villas,id',
            'customer_name' => 'required|string|max:255',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'number_of_guests' => 'required|integer|min:1',
        ]);
    
        $reservation = Reservation::create($validated);
        return response()->json($reservation, 201);
    }
    
    public function update(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);
    
        $validated = $request->validate([
            'villa_id' => 'exists:villas,id',
            'customer_name' => 'string|max:255',
            'check_in' => 'date',
            'check_out' => 'date|after:check_in',
            'number_of_guests' => 'integer|min:1',
        ]);
    
        $reservation->update($validated);
        return response()->json($reservation);
    }
    
    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();
    
        return response()->json(['message' => 'Reservation deleted successfully']);
    }
}    