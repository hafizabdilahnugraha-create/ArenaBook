<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Court;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon; // Tambahkan Carbon untuk memproses tanggal grafik

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $role = strtolower(trim($user->role));

        if ($role === 'admin' || $role === 'administrator' || $user->role == 1) {
            return redirect()->route('admin.dashboard');
        }

        $courts = Court::all();
        return view('dashboard', compact('courts'));
    }

    public function adminIndex(Request $request)
    {
        $user = Auth::user();

        $role = strtolower(trim($user->role));

        if ($role !== 'admin' && $role !== 'administrator' && $user->role != 1) {
            return redirect()->route('dashboard');
        }

        // 1. Ambil data Lapangan dan Reservasi
        $courts = Court::all();
        
        // Mengambil semua reservasi beserta data user dan lapangannya, diurutkan dari yang terbaru
        $reservations = Reservation::with(['user', 'court'])->orderBy('created_at', 'desc')->get();

        // 2. Siapkan data untuk Grafik (Chart.js) 7 Hari Terakhir
        $labels = [];
        $dataApproved = [];
        $dataPending = [];

        for ($i = 6; $i >= 0; $i--) {
            // Ambil tanggal mundur dari 6 hari lalu sampai hari ini
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $labels[] = Carbon::now()->subDays($i)->format('d M');

            // Hitung jumlah reservasi disetujui (approved) pada tanggal tersebut
            $dataApproved[] = Reservation::whereDate('created_at', $date)
                                         ->where('status', 'approved')
                                         ->count();

            // Hitung jumlah reservasi pending pada tanggal tersebut
            $dataPending[] = Reservation::whereDate('created_at', $date)
                                        ->where('status', 'pending')
                                        ->count();
        }

        // 3. Kirim semua variabel ke tampilan (view) admin
        return view('admin.dashboard', compact(
            'courts', 
            'reservations', 
            'labels', 
            'dataApproved', 
            'dataPending'
        ));
    }
}