<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Court; // Pastikan model Court sudah di-use
use Illuminate\Http\Request;

class CourtController extends Controller
{
    public function index()
    {
        // Ambil semua data lapangan dari database
        $courts = Court::all(); 

        // Kirim variabel $courts ke view index
        return view('admin.courts.index', compact('courts'));
    }

    // ... fungsi lainnya (create, store, edit, update, destroy)
}