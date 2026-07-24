<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CourtController;
use App\Http\Controllers\ReservationController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Tambahkan baris ini di dalam grup middleware 'auth'
    Route::get('/riwayat-booking', [\App\Http\Controllers\ReservationController::class, 'history'])->name('riwayat.booking');
    Route::post('/reservations', [\App\Http\Controllers\ReservationController::class, 'store'])->name('reservations.store');
    Route::get('/reservations/{id}/pdf', [\App\Http\Controllers\ReservationController::class, 'downloadReceipt'])->name('user.reservation.pdf');
});

Route::middleware(['auth'])->group(function () {
    // Rute utama yang mengarahkan ke dashboard masing-masing
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // CRUD khusus Admin
    Route::middleware('admin')->group(function () {
        Route::resource('admin/courts', CourtController::class);
        Route::post('admin/reservations/{id}/approve', [ReservationController::class, 'approve']);
    });

    // Rute khusus User untuk booking lapangan
    Route::post('user/book', [ReservationController::class, 'store'])->name('book.court');

});

require __DIR__.'/auth.php';
