<?php

namespace App\Http\Controllers;

use App\Models\Court;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CourtController extends Controller
{
    // Menampilkan halaman form tambah lapangan
    public function create()
    {
        return view('admin.courts.create');
    }

    // Menyimpan data lapangan baru (Create)
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'price_per_hour' => 'required|numeric',
            'specification' => 'nullable|string', // Tambahkan validasi ini
            'status' => 'required|in:Tersedia,Disewa',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('courts', 'public');
            $data['image'] = $path;
        }

        Court::create($data);

        return redirect()->route('dashboard')->with('success', 'Lapangan berhasil ditambahkan');
    }

    // Menampilkan form edit lapangan
    public function edit(Court $court)
    {
        return view('admin.courts.edit', compact('court'));
    }

    // Menyimpan perubahan data lapangan (Update)
    public function update(Request $request, Court $court)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'price_per_hour' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($court->image && Storage::disk('public')->exists($court->image)) {
                Storage::disk('public')->delete($court->image);
            }
            $path = $request->file('image')->store('courts', 'public');
            $data['image'] = $path;
        }

        $court->update($data);

        return redirect()->route('dashboard')->with('success', 'Data Lapangan diperbarui');
    }

    // Menghapus data lapangan (Delete)
    public function destroy(Court $court)
    {
        // Hapus file gambar dari storage sebelum menghapus data dari database
        if ($court->image && Storage::disk('public')->exists($court->image)) {
            Storage::disk('public')->delete($court->image);
        }
        
        $court->delete();

        return redirect()->route('dashboard')->with('success', 'Lapangan berhasil dihapus');
    }
}