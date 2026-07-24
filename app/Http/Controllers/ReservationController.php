<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class ReservationController extends Controller
{
    // 1. Fungsi untuk User melakukan booking (Sudah digabung & dirapikan)
    public function store(Request $request)
    {
        $request->validate([
            'court_id' => 'required|exists:courts,id',
            'booking_date' => 'required|date|after_or_equal:today',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        // Algoritma Pengecekan Bentrok Jadwal
        $conflict = Reservation::where('court_id', $request->court_id)
            ->where('booking_date', $request->booking_date)
            ->whereIn('status', ['pending', 'approved', 'Pending', 'Approved']) // Menangani perbedaan huruf kapital
            ->where(function ($query) use ($request) {
                $query->whereBetween('start_time', [$request->start_time, $request->end_time])
                      ->orWhereBetween('end_time', [$request->start_time, $request->end_time])
                      ->orWhere(function ($q) use ($request) {
                          $q->where('start_time', '<=', $request->start_time)
                            ->where('end_time', '>=', $request->end_time);
                      });
            })->exists();

        if ($conflict) {
            return back()->with('error', 'Maaf, lapangan sudah dibooking pada jam tersebut. Silakan pilih jam lain.');
        }

        // Jika tidak bentrok, simpan ke database
        Reservation::create([
            'user_id' => Auth::id(),
            'court_id' => $request->court_id,
            'booking_date' => $request->booking_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'status' => 'Pending', // Menunggu acc admin
        ]);

        // Alihkan user ke halaman riwayat dengan pesan sukses
        return redirect()->route('riwayat.booking')->with('success', 'Booking berhasil diajukan! Menunggu konfirmasi admin.');
    }

    // 2. Fungsi untuk Admin menyetujui booking
    public function approve($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->update(['status' => 'Approved']);

        return back()->with('success', 'Booking lapangan berhasil disetujui.');
    }

    // 4. Fungsi untuk melihat Riwayat Booking
    public function history()
    {
        // Mengambil data booking milik user yang sedang login, diurutkan dari yang terbaru
        $reservations = Reservation::with('court') 
                            ->where('user_id', Auth::id())
                            ->orderBy('created_at', 'desc')
                            ->get();

        return view('user.history', compact('reservations'));
    }

    // 5. Fungsi untuk User mengunduh tiket/struk PDF
    public function downloadReceipt($id)
    {
        // Cari data booking berdasarkan ID, dan pastikan itu milik user yang sedang login
        $reservation = Reservation::with(['user', 'court'])
            ->where('id', $id)
            ->where('user_id', Auth::id()) 
            ->firstOrFail();

        // Memuat tampilan (view) struk PDF
        $pdf = Pdf::loadView('user.receipt_pdf', compact('reservation'));

        // Format nama file saat diunduh
        $fileName = 'Tiket_ArenaBook_' . date('dmY', strtotime($reservation->booking_date)) . '.pdf';

        return $pdf->download($fileName);
    }
}