<!-- resources/views/admin/dashboard.blade.php -->
<x-app-layout>
    <x-slot name="header">
    <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Admin - Manajemen ArenaBook') }}
        </h2>
        
        <div>
            <!-- Tombol Tambah Lapangan -->
            <a href="{{ url('admin/courts/create') }}" class="btn btn-primary btn-sm mr-2">
                + Tambah Lapangan
            </a>
            
        </div>
    </div>
</x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Bagian Statistik -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div class="stat bg-base-100 shadow rounded-lg">
                    <div class="stat-title">Total Lapangan</div>
                    <div class="stat-value">{{ $courts->count() }}</div>
                </div>
                <div class="stat bg-base-100 shadow rounded-lg">
                    <div class="stat-title">Total Reservasi</div>
                    <div class="stat-value">{{ $reservations->count() }}</div>
                </div>
                <div class="stat bg-base-100 shadow rounded-lg">
                    <div class="stat-title">Menunggu Persetujuan</div>
                    <div class="stat-value text-warning">
                        {{ $reservations->where('status', 'pending')->count() }}
                    </div>
                </div>
            </div>

            <!-- Daftar Lapangan yang Telah Ditambahkan -->
            <div class="bg-base-100 overflow-hidden shadow-xl sm:rounded-lg p-6 mb-6">
                <h3 class="text-lg font-bold mb-4">Daftar Lapangan</h3>
                
                <div class="overflow-x-auto">
                    <table class="table table-zebra w-full">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Foto</th>
                                <th>Nama Lapangan</th>
                                <th>Kategori</th>
                                <th>Spesifikasi</th>
                                <th>Harga / Jam</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($courts as $index => $court)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        @if($court->image)
                                            <img src="{{ asset('storage/' . $court->image) }}" alt="{{ $court->name }}" class="w-16 h-16 object-cover rounded shadow-sm" />
                                        @else
                                            <span class="text-xs text-gray-400">Tanpa Foto</span>
                                        @endif
                                    </td>
                                    <td class="font-bold">{{ $court->name }}</td>
                                    <td>
                                        <span class="badge badge-ghost badge-sm">{{ $court->type }}</span>
                                    </td>
                                    <td class="text-sm max-w-xs truncate" title="{{ $court->specification }}">
                                        {{ $court->specification ?? '-' }}
                                    </td>
                                    <td class="text-primary font-semibold">
                                        Rp {{ number_format($court->price_per_hour, 0, ',', '.') }}
                                    </td>
                                    <td>
                                        <div class="flex space-x-2">
                                            <!-- Tombol Edit (Biru) -->
                                            <a href="{{ url('admin/courts/'.$court->id.'/edit') }}" 
                                            style="background-color: #3b82f6; color: #ffffff; padding: 6px 14px; border-radius: 6px; text-decoration: none; font-size: 14px; font-weight: 600;">
                                                Edit
                                            </a>
                                            
                                            <!-- Tombol Hapus (Merah) -->
                                            <form action="{{ url('admin/courts/'.$court->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus lapangan ini?');" style="margin: 0;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                style="background-color: #ef4444; color: #ffffff; padding: 6px 14px; border-radius: 6px; border: none; font-size: 14px; font-weight: 600; cursor: pointer;">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-6 text-gray-500">
                                        Belum ada lapangan yang ditambahkan. Silakan klik tombol "+ Tambah Lapangan" di atas.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Tabel Daftar Reservasi -->
            <div class="bg-base-100 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Daftar Peminjaman Lapangan</h3>
                
                <div class="overflow-x-auto">
                    <table class="table table-zebra w-full">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Pemesan</th>
                                <th>Lapangan</th>
                                <th>Tanggal</th>
                                <th>Jam</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($reservations as $index => $res)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $res->user->name }}</td>
                                    <td>{{ $res->court->name }} ({{ $res->court->type }})</td>
                                    <td>{{ \Carbon\Carbon::parse($res->booking_date)->format('d M Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($res->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($res->end_time)->format('H:i') }}</td>
                                    <td>
                                        @if($res->status == 'pending')
                                            <span class="badge badge-warning">Pending</span>
                                        @elseif($res->status == 'approved')
                                            <span class="badge badge-success">Approved</span>
                                        @else
                                            <span class="badge badge-error">Rejected</span>
                                        @endif
                                    </td>
                                    <td>
                                        <!-- Tombol Aksi untuk menyetujui peminjaman -->
                                        @if($res->status == 'pending')
                                            <form action="{{ url('admin/reservations/'.$res->id.'/approve') }}" method="POST">
                                                @csrf
                                                <!-- Tombol Setujui (Warna Hijau) -->
                                                <button type="submit" class="inline-block bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-md text-sm font-semibold shadow-sm transition duration-200">
                                                    Setujui
                                                </button>
                                            </form>
                                        @else
                                            <!-- Tombol Selesai (Warna Abu-abu mati) -->
                                            <button type="button" class="inline-block bg-gray-400 text-white px-3 py-1 rounded-md text-sm font-semibold shadow-sm cursor-not-allowed" disabled>
                                                Selesai
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-6 text-gray-500">Belum ada data reservasi masuk.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>