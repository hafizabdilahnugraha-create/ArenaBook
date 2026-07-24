<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manajemen Data Lapangan') }}
            </h2>
            <div>
                <!-- Tombol Kembali ke Dasbor -->
                <a href="{{ route('admin.dashboard') }}" style="background-color: #6b7280; color: #ffffff; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-weight: 600; font-size: 14px; margin-right: 8px;">
                    ← Kembali ke Dashboard
                </a>
                <!-- Tombol Tambah Lapangan -->
                <a href="{{ url('admin/courts/create') }}" style="background-color: #10b981; color: #ffffff; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-weight: 600; font-size: 14px;">
                    + Tambah Lapangan
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Daftar Lapangan yang Telah Ditambahkan -->
            <div class="bg-base-100 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Daftar Seluruh Lapangan</h3>
                
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

        </div>
    </div>
</x-app-layout>