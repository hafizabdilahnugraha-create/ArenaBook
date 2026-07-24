<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Court;
use App\Models\Reservation;

class DashboardController extends Controller
{
    public function index()
    {
        $role = Auth::user()->role;

        if ($role === 'admin') {
            // Dashboard Admin: Mengelola semua lapangan dan melihat seluruh daftar reservasi
            $courts = Court::all();
            $reservations = Reservation::with(['user', 'court'])->latest()->get();
            return view('admin.dashboard', compact('courts', 'reservations'));
        } 
        
        // Dashboard User: Melihat lapangan tersedia dan riwayat booking mandiri
        $courts = Court::all();
        $myReservations = Reservation::with('court')
                            ->where('user_id', Auth::id())
                            ->latest()->get();
        // Mengambil jadwal yang sudah di-booking orang lain untuk disable waktu di UI
        $bookedSchedules = Reservation::where('status', 'approved')->get(); 
        
        return view('user.dashboard', compact('courts', 'myReservations', 'bookedSchedules'));
    }
}
