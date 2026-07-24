<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\Admin\CourtController;

Route::get('/', function () {
    return view('welcome');
});

// Route yang membutuhkan autentikasi
Route::middleware(['auth'])->group(function () {
    
    // Dashboard Utama
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // User Reservation Routes
    Route::get('/riwayat-booking', [ReservationController::class, 'history'])->name('riwayat.booking');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
    Route::post('/user/book', [ReservationController::class, 'store'])->name('book.court');
    Route::get('/reservations/{id}/pdf', [ReservationController::class, 'downloadReceipt'])->name('user.reservation.pdf');

    // Admin Routes (CRUD Lapangan & Approve Reservasi)
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::resource('courts', CourtController::class);
        Route::post('reservations/{id}/approve', [ReservationController::class, 'approve']);
    });

});

require __DIR__.'/auth.php';