<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VillaController;
use App\Http\Controllers\ReservationController;

// User Autentikasi
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Group Routes untuk Villas
Route::prefix('villas')->group(function () {
    Route::get('/', [VillaController::class, 'index']);         // List semua villa
    Route::get('/{id}', [VillaController::class, 'show']);      // Detail villa berdasarkan ID
    Route::post('/', [VillaController::class, 'store']);        // Tambah villa baru
    Route::put('/{id}', [VillaController::class, 'update']);    // Update villa (PUT menggantikan PATCH)
    Route::delete('/{id}', [VillaController::class, 'destroy']); // Hapus villa
});

// Group Routes untuk Reservations
Route::prefix('reservations')->group(function () {
    Route::get('/', [ReservationController::class, 'index']);       // List semua reservation
    Route::get('/{id}', [ReservationController::class, 'show']);    // Detail reservation berdasarkan ID
    Route::post('/', [ReservationController::class, 'store']);      // Tambah reservation baru
    Route::put('/{id}', [ReservationController::class, 'update']);  // Update reservation
    Route::delete('/{id}', [ReservationController::class, 'destroy']); // Hapus reservation
});
