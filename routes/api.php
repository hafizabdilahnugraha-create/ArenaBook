<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Court; // PENTING: Tambahkan ini agar sistem mengenali model Court

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// --- Tambahkan kode baru di bawah sini ---

Route::get('/courts', function () {
    $courts = Court::all();
    
    return response()->json([
        'message' => 'Data lapangan berhasil diambil',
        'data' => $courts
    ]);
});

// API Endpoint untuk mengirim data reservasi (POST)
Route::post('/reservations', function (Request $request) {
    // Menangkap semua data yang dikirim dari Postman
    $dataYangDikirim = $request->all();
    
    return response()->json([
        'message' => 'Data reservasi berhasil diterima oleh server (POST Sukses!)',
        'data' => $dataYangDikirim
    ]);
});