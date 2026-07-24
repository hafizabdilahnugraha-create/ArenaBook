<x-app-layout>
    <!-- Injeksi CSS untuk mengubah background bawaan Laravel -->
    <style>
        .min-h-screen {
            background-color: #043873 !important;
        }
        header {
            background-color: #043873 !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
            box-shadow: none !important;
        }
        header h2 {
            color: white !important;
        }
    </style>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Dashboard Pemesanan Lapangan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Pesan Sukses / Error -->
            @if(session('success'))
                <div class="alert alert-success shadow-lg mb-6">
                    <span>{{ session('success') }}</span>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-error shadow-lg mb-6">
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            <!-- Daftar Lapangan -->
            <div class="flex flex-col gap-12">
                @forelse($courts as $court)
                    
                    <!-- KARTU LAPANGAN (Tema Biru Gelap / Teks Putih) -->
                    <div style="display: flex; flex-direction: row; gap: 2.5rem; align-items: stretch; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 3rem;">
                        
                        <!-- Bagian Kiri: Gambar (Kotak Presisi 320x320) -->
                        <div style="flex: 0 0 320px; width: 320px; height: 320px;">
                            @if($court->image)
                                <img src="{{ asset('storage/' . $court->image) }}" alt="{{ $court->name }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 2rem; box-shadow: 0 4px 15px rgba(0,0,0,0.3);" />
                            @else
                                <img src="https://via.placeholder.com/320x320?text=No+Image" alt="Tanpa Gambar" style="width: 100%; height: 100%; object-fit: cover; border-radius: 2rem; box-shadow: 0 4px 15px rgba(0,0,0,0.3);" />
                            @endif
                        </div>

                        <!-- Bagian Kanan: Teks & Tombol -->
                        <div style="flex: 1; display: flex; flex-direction: column; justify-content: space-between;">
                            
                            <div>
                                <!-- Nama Lapangan & Status -->
                                <div class="mb-2">
                                    <h2 class="text-4xl font-extrabold text-white mb-2">
                                        {{ $court->name }} 
                                        <span class="font-normal text-blue-200 text-2xl ml-2">{{ $court->type }}</span>
                                    </h2>
                                    <!-- Status Lapangan -->
                                    @if($court->status == 'Tersedia')
                                        <span class="inline-block bg-green-500 text-white px-3 py-1 rounded-full text-sm font-bold border border-green-400 shadow-sm">🟢 Tersedia</span>
                                    @else
                                        <span class="inline-block bg-red-500 text-white px-3 py-1 rounded-full text-sm font-bold border border-red-400 shadow-sm">🔴 Sedang Disewa</span>
                                    @endif
                                </div>
                                
                                <!-- Harga (Warna Putih Bersih) -->
                                <p class="text-3xl font-bold mb-6" style="color: #ffffff;">
                                    Rp {{ number_format($court->price_per_hour, 0, ',', '.') }} 
                                    <span class="text-xl font-normal" style="color: #ffffff;">/ Jam</span>
                                </p>

                                <!-- Spesifikasi (Warna Primary & Teks Putih) -->
                                @if($court->specification)
                                    <div class="border border-white rounded-2xl p-5 mb-6 bg-primary">
                                        <p class="text-sm font-medium mb-1" style="color: #ffffff;">Spesifikasi Lapangan:</p>
                                        <p class="text-lg" style="color: #ffffff;">{{ $court->specification }}</p>
                                    </div>
                                @endif
                            </div>

                            <!-- Tombol Booking -->
                            @if($court->status == 'Tersedia')
                                <button class="w-full bg-[#FFE492] hover:bg-yellow-400 text-[#043873] font-bold text-lg py-4 rounded-xl transition shadow-md mt-auto" 
                                        onclick="document.getElementById('modal_booking_{{ $court->id }}').showModal()">
                                    Booking Sekarang
                                </button>
                            @else
                                <button class="w-full bg-white/10 text-white/40 cursor-not-allowed font-semibold text-lg py-4 rounded-xl mt-auto" disabled>
                                    Tidak Dapat Dibooking
                                </button>
                            @endif

                        </div>
                    </div>

                    <!-- MODAL FORM BOOKING (Lebih Cantik & Modern) -->
                    <dialog id="modal_booking_{{ $court->id }}" class="modal backdrop-blur-sm">
                        <div class="modal-box bg-white text-gray-800 p-0 overflow-hidden max-w-md rounded-2xl shadow-2xl">
                            
                            <!-- Bagian Header Modal (Garis Pembatas & Tombol X) -->
                            <div class="flex justify-between items-center px-6 py-4 border-b border-gray-200 bg-white">
                                <h3 class="font-bold text-xl text-[#043873]">Booking {{ $court->name }}</h3>
                                <!-- Tombol Silang (X) untuk menutup -->
                                <form method="dialog">
                                    <button class="text-gray-400 hover:text-gray-700 transition duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                            
                            <!-- Bagian Isi Form -->
                            <div class="px-6 py-6 bg-white">
                                <form action="{{ route('reservations.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="court_id" value="{{ $court->id }}">
                                    
                                    <div class="form-control w-full mb-5">
                                        <label class="label pb-2"><span class="label-text font-semibold text-gray-700 text-sm">Pilih Tanggal Main</span></label>
                                        <input type="date" name="booking_date" class="input input-bordered w-full bg-white border-gray-300 focus:border-[#043873] focus:ring-1 focus:ring-[#043873] rounded-xl text-gray-800 transition" required />
                                    </div>
                                    
                                    <div class="flex gap-4 mb-8">
                                        <div class="form-control w-1/2">
                                            <label class="label pb-2"><span class="label-text font-semibold text-gray-700 text-sm">Jam Mulai</span></label>
                                            <input type="time" name="start_time" class="input input-bordered w-full bg-white border-gray-300 focus:border-[#043873] focus:ring-1 focus:ring-[#043873] rounded-xl text-gray-800 transition" required />
                                        </div>
                                        <div class="form-control w-1/2">
                                            <label class="label pb-2"><span class="label-text font-semibold text-gray-700 text-sm">Jam Selesai</span></label>
                                            <input type="time" name="end_time" class="input input-bordered w-full bg-white border-gray-300 focus:border-[#043873] focus:ring-1 focus:ring-[#043873] rounded-xl text-gray-800 transition" required />
                                        </div>
                                    </div>
                                    
                                    <!-- Bagian Tombol Aksi -->
                                    <div class="flex justify-end gap-3 mt-4">
                                        <!-- Tombol Batal (Tepi Garis) -->
                                        <button type="button" class="btn bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 hover:border-gray-400 rounded-xl px-6 font-semibold shadow-sm transition" onclick="document.getElementById('modal_booking_{{ $court->id }}').close()">
                                            Batal
                                        </button>
                                        <!-- Tombol Konfirmasi (Biru Solid) -->
                                        <button type="submit" class="btn bg-[#043873] hover:bg-blue-900 text-white border-none rounded-xl px-6 font-semibold shadow-md transition">
                                            Konfirmasi Booking
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                        <!-- Area gelap di luar modal (klik untuk menutup) -->
                        <form method="dialog" class="modal-backdrop">
                            <button>Tutup</button>
                        </form>
                    </dialog>

                @empty
                    <div class="text-center py-16 bg-white/5 rounded-2xl border border-white/10">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 mx-auto text-blue-300/50 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                        </svg>
                        <p class="text-blue-100 font-medium text-lg">Belum ada lapangan yang tersedia saat ini.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>