<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard Admin - Manajemen ArenaBook') }}
            </h2>
            
            <div>
                <!-- Tombol Menuju Halaman CRUD Lapangan yang Terpisah -->
                <a href="{{ route('admin.courts.index') }}" style="background-color: #3b82f6; color: #ffffff; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-weight: 600; font-size: 14px;">
                    Kelola Data Lapangan ➔
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Bagian Statistik -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div class="stat bg-base-100 shadow rounded-lg p-4">
                    <div class="stat-title">Total Lapangan</div>
                    <div class="stat-value text-2xl font-bold">{{ $courts->count() }}</div>
                </div>
                <div class="stat bg-base-100 shadow rounded-lg p-4">
                    <div class="stat-title">Total Reservasi</div>
                    <div class="stat-value text-2xl font-bold">{{ $reservations->count() }}</div>
                </div>
                <div class="stat bg-base-100 shadow rounded-lg p-4">
                    <div class="stat-title">Menunggu Persetujuan</div>
                    <div class="stat-value text-2xl font-bold text-warning">
                        {{ $reservations->where('status', 'pending')->count() }}
                    </div>
                </div>
            </div>

            <!-- Bagian Grafik Statistik 7 Hari Terakhir -->
            <div class="bg-base-100 overflow-hidden shadow-xl sm:rounded-lg p-6 mb-6">
                <h3 class="text-xs font-bold uppercase tracking-wider text-gray-500 mb-4">
                    RESERVASI MASUK / PENDING — 7 HARI TERAKHIR
                </h3>
                
                <div style="position: relative; height: 300px; width: 100%;">
                    <canvas id="reservationChart"></canvas>
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
                                        @if($res->status == 'pending')
                                            <form action="{{ url('admin/reservations/'.$res->id.'/approve') }}" method="POST">
                                                @csrf
                                                <button type="submit" class="inline-block bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-md text-sm font-semibold shadow-sm transition duration-200">
                                                    Setujui
                                                </button>
                                            </form>
                                        @else
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

    <!-- Script Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('reservationChart').getContext('2d');
        const reservationChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($labels) !!},
                datasets: [
                    {
                        label: 'Disetujui (Masuk)',
                        data: {!! json_encode($dataApproved) !!},
                        backgroundColor: '#111827',
                        borderRadius: 4,
                    },
                    {
                        label: 'Pending (Keluar)',
                        data: {!! json_encode($dataPending) !!},
                        backgroundColor: '#d1d5db',
                        borderRadius: 4,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        },
                        grid: {
                            color: '#f3f4f6'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                },
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            boxWidth: 12,
                            font: {
                                size: 12
                            }
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>