<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VillaController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\VillaEventController;
use App\Http\Controllers\TransportationServiceController;
use App\Http\Controllers\RestaurantMenuController; 
use App\Http\Controllers\VillaStaffController;

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

Route::prefix('reviews')->group(function () {
    Route::get('/', [ReviewController::class, 'index']);
    Route::get('/{id}', [ReviewController::class, 'show']);
    Route::post('/', [ReviewController::class, 'store']);
    Route::put('/{id}', [ReviewController::class, 'update']);
    Route::delete('/{id}', [ReviewController::class, 'destroy']);
});

Route::prefix('facilities')->group(function () {
    Route::get('/{villaId}', [FacilityController::class, 'index']);    // Daftar fasilitas untuk villa tertentu
    Route::post('/', [FacilityController::class, 'store']);           // Tambah fasilitas
    Route::get('/detail/{id}', [FacilityController::class, 'show']);   // Detail fasilitas berdasarkan ID
    Route::put('/{id}', [FacilityController::class, 'update']);       // Update fasilitas
    Route::delete('/{id}', [FacilityController::class, 'destroy']);   // Hapus fasilitas
});

Route::prefix('promotions')->group(function () {
    Route::get('/{villaId}', [PromotionController::class, 'index']);    // Daftar promosi untuk villa tertentu
    Route::post('/', [PromotionController::class, 'store']);           // Tambah promosi
    Route::get('/detail/{id}', [PromotionController::class, 'show']);   // Detail promosi berdasarkan ID
    Route::put('/{id}', [PromotionController::class, 'update']);       // Update promosi
    Route::delete('/{id}', [PromotionController::class, 'destroy']);   // Hapus promosi
});

Route::prefix('galleries')->group(function () {
    Route::get('/{villaId}', [GalleryController::class, 'index']);    // Daftar gambar untuk villa tertentu
    Route::post('/', [GalleryController::class, 'store']);           // Tambah gambar ke galeri
    Route::get('/detail/{id}', [GalleryController::class, 'show']);  // Detail gambar berdasarkan ID
    Route::put('/{id}', [GalleryController::class, 'update']);       // Update gambar di galeri
    Route::delete('/{id}', [GalleryController::class, 'destroy']);   // Hapus gambar dari galeri
});

Route::prefix('events')->group(function () {
    Route::get('/', [VillaEventController::class, 'index']);      // Daftar semua event
    Route::get('/{id}', [VillaEventController::class, 'show']);    // Detail event
    Route::post('/', [VillaEventController::class, 'store']);      // Tambah event baru
    Route::put('/{id}', [VillaEventController::class, 'update']);  // Update event
    Route::delete('/{id}', [VillaEventController::class, 'destroy']); // Hapus event
});

// Group Routes untuk Transportation Services (Layanan Transportasi)
Route::prefix('transportation-services')->group(function () {
    Route::get('/', [TransportationServiceController::class, 'index']);       // List semua layanan transportasi
    Route::get('/{id}', [TransportationServiceController::class, 'show']);    // Detail layanan transportasi berdasarkan ID
    Route::post('/', [TransportationServiceController::class, 'store']);      // Tambah layanan transportasi baru
    Route::put('/{id}', [TransportationServiceController::class, 'update']);  // Update layanan transportasi
    Route::delete('/{id}', [TransportationServiceController::class, 'destroy']); // Hapus layanan transportasi
});

Route::prefix('restaurant-menus')->group(function () {
    Route::get('/', [RestaurantMenuController::class, 'index']);       // List semua menu restoran
    Route::get('/{id}', [RestaurantMenuController::class, 'show']);    // Detail menu restoran berdasarkan ID
    Route::post('/', [RestaurantMenuController::class, 'store']);      // Tambah menu restoran baru
    Route::put('/{id}', [RestaurantMenuController::class, 'update']);  // Update menu restoran
    Route::delete('/{id}', [RestaurantMenuController::class, 'destroy']); // Hapus menu restoran
});

Route::prefix('villa-staff')->group(function () {
    Route::get('/', [VillaStaffController::class, 'index']);        // List semua staf villa
    Route::get('/{id}', [VillaStaffController::class, 'show']);      // Detail staf berdasarkan ID
    Route::post('/', [VillaStaffController::class, 'store']);        // Tambah staf villa baru
    Route::put('/{id}', [VillaStaffController::class, 'update']);    // Update data staf villa
    Route::delete('/{id}', [VillaStaffController::class, 'destroy']); // Hapus data staf villa
});