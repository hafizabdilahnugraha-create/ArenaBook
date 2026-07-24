<?php

namespace App\Http\Controllers;

use App\Models\Court;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $courts = Court::all();
        $reservations = Reservation::with(['user', 'court'])->get();

        // Logika Data Grafik 7 Hari Terakhir
        $labels = [];
        $dataApproved = [];
        $dataPending = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $labels[] = $date->format('d M'); 
            
            $dataApproved[] = Reservation::whereDate('created_at', $date->toDateString())
                                ->where('status', 'approved')
                                ->count();
                                
            $dataPending[] = Reservation::whereDate('created_at', $date->toDateString())
                                ->where('status', 'pending')
                                ->count();
        }

        return view('admin.dashboard', compact('courts', 'reservations', 'labels', 'dataApproved', 'dataPending'));
    }
}