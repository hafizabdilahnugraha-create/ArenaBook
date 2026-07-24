<!DOCTYPE html>
<html>
<head>
    <title>Laporan Reservasi Lapangan</title>
    <style>
        body { font-family: sans-serif; font-size: 14px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .text-center { text-align: center; }
    </style>
</head>
<body>
    <h2 class="text-center">Laporan Rekapitulasi Penyewaan Lapangan</h2>
    <p>Tanggal Cetak: {{ \Carbon\Carbon::now()->format('d M Y') }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pemesan</th>
                <th>Lapangan</th>
                <th>Tanggal Main</th>
                <th>Jam</th>
                <th>Total Biaya</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reservations as $index => $res)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $res->user->name }}</td>
                <td>{{ $res->court->name }} ({{ $res->court->type }})</td>
                <td>{{ \Carbon\Carbon::parse($res->booking_date)->format('d M Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($res->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($res->end_time)->format('H:i') }}</td>
                <td>
                    <!-- Menghitung durasi jam dikali harga per jam -->
                    @php
                        $start = \Carbon\Carbon::parse($res->start_time);
                        $end = \Carbon\Carbon::parse($res->end_time);
                        $hours = $start->diffInHours($end);
                        $total = $hours * $res->court->price_per_hour;
                    @endphp
                    Rp {{ number_format($total, 0, ',', '.') }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>