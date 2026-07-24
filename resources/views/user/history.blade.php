<x-app-layout>
    <style>
        .min-h-screen, header { background-color: #043873 !important; }
        header { border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important; box-shadow: none !important; }
    </style>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Riwayat Booking Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white/5 border border-white/10 rounded-3xl p-6 lg:p-10">
                <h3 class="text-2xl font-bold text-white mb-6">Daftar Pesanan Anda</h3>

                <div class="overflow-x-auto">
                    <table class="table w-full text-white">
                        <!-- Head Tabel -->
                        <thead>
                            <tr class="text-blue-200 border-b border-white/20 text-sm">
                                <th class="bg-transparent">No</th>
                                <th class="bg-transparent">Nama Lapangan</th>
                                <th class="bg-transparent">Tanggal Main</th>
                                <th class="bg-transparent">Waktu</th>
                                <th class="bg-transparent">Status</th>
                                <th class="bg-transparent text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($reservations as $index => $book)
                                <tr class="border-b border-white/10 hover:bg-white/5 transition">
                                    <td class="bg-transparent font-medium">{{ $index + 1 }}</td>
                                    <td class="bg-transparent font-bold text-[#FFE492]">{{ $book->court->name ?? 'Lapangan Dihapus' }}</td>
                                    <td class="bg-transparent">{{ \Carbon\Carbon::parse($book->booking_date)->format('d M Y') }}</td>
                                    <td class="bg-transparent">{{ \Carbon\Carbon::parse($book->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($book->end_time)->format('H:i') }}</td>
                                    <td class="bg-transparent">
                                        <!-- Anggap database Anda punya kolom 'status' di tabel reservations ('Pending', 'Approved', dll) -->
                                        @if(($book->status ?? 'Pending') == 'Pending')
                                            <span class="badge bg-yellow-500/20 text-yellow-300 border border-yellow-400/50 p-3">Menunggu</span>
                                        @elseif(($book->status ?? '') == 'Approved')
                                            <span class="badge bg-green-500/20 text-green-300 border border-green-400/50 p-3">Disetujui</span>
                                        @else
                                            <span class="badge bg-blue-500/20 text-blue-300 border border-blue-400/50 p-3">{{ $book->status ?? 'Tercatat' }}</span>
                                        @endif
                                    </td>
                                    <td class="bg-transparent text-center">
                                        <a href="{{ route('user.reservation.pdf', $book->id) }}" target="_blank" class="inline-block bg-[#FFE492] hover:bg-yellow-400 text-[#043873] px-4 py-2 rounded-lg text-sm font-bold shadow-sm transition">
                                            Unduh Tiket
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-8 text-blue-200/50 bg-transparent">
                                        Anda belum pernah melakukan booking lapangan.
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