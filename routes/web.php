<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\Admin\CourtController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    
    // Dashboard User (Memanggil DashboardController fungsi index)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Dashboard Admin (Memanggil DashboardController fungsi adminIndex)
    Route::get('/admin/dashboard', [DashboardController::class, 'adminIndex'])->name('admin.dashboard');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // User Reservation Routes
    Route::get('/riwayat-booking', [ReservationController::class, 'history'])->name('riwayat.booking');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
    Route::post('/user/book', [ReservationController::class, 'store'])->name('book.court');
    Route::get('/reservations/{id}/pdf', [ReservationController::class, 'downloadReceipt'])->name('user.reservation.pdf');

    // Admin Routes
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::resource('courts', CourtController::class);
        Route::post('reservations/{id}/approve', [ReservationController::class, 'approve']);
    });
});

require __DIR__.'/auth.php';