<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tiket Booking - ArenaBook</title>
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; color: #333; margin: 0; padding: 20px; }
        .receipt-box { max-width: 600px; margin: auto; padding: 30px; border: 1px solid #eee; box-shadow: 0 0 10px rgba(0, 0, 0, 0.15); font-size: 16px; line-height: 24px; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #043873; padding-bottom: 20px; }
        .header h1 { margin: 0; color: #043873; font-size: 28px; letter-spacing: 1px; }
        .header p { margin: 5px 0 0 0; color: #666; font-size: 14px; }
        .info-table { w-full; margin-bottom: 30px; border-collapse: collapse; width: 100%; }
        .info-table td { padding: 8px 0; border-bottom: 1px solid #f2f2f2; }
        .info-table td.label { font-weight: bold; color: #555; width: 40%; }
        .info-table td.value { text-align: right; color: #000; font-weight: bold; }
        .status-badge { display: inline-block; padding: 5px 15px; border-radius: 20px; font-size: 14px; font-weight: bold; color: #fff; text-transform: uppercase; }
        .status-pending { background-color: #f59e0b; }
        .status-approved { background-color: #10b981; }
        .footer { text-align: center; margin-top: 40px; font-size: 12px; color: #888; border-top: 1px solid #eee; padding-top: 20px; }
    </style>
</head>
<body>

    <div class="receipt-box">
        <div class="header">
            <h1>ArenaBook</h1>
            <p>Bukti Pemesanan Lapangan Resmi</p>
        </div>

        <table class="info-table">
            <tr>
                <td class="label">ID Pemesanan</td>
                <td class="value">#ARB-{{ str_pad($reservation->id, 5, '0', STR_PAD_LEFT) }}</td>
            </tr>
            <tr>
                <td class="label">Nama Pemesan</td>
                <td class="value">{{ $reservation->user->name }}</td>
            </tr>
            <tr>
                <td class="label">Nama Lapangan</td>
                <td class="value">{{ $reservation->court->name }} ({{ $reservation->court->type }})</td>
            </tr>
            <tr>
                <td class="label">Tanggal Main</td>
                <td class="value">{{ \Carbon\Carbon::parse($reservation->booking_date)->format('d F Y') }}</td>
            </tr>
            <tr>
                <td class="label">Jam Berlaku</td>
                <td class="value">{{ \Carbon\Carbon::parse($reservation->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($reservation->end_time)->format('H:i') }} WIB</td>
            </tr>
            <tr>
                <td class="label">Tarif Lapangan</td>
                <td class="value">Rp {{ number_format($reservation->court->price_per_hour, 0, ',', '.') }} / Jam</td>
            </tr>
            <tr>
                <td class="label">Status Pesanan</td>
                <td class="value">
                    @if($reservation->status == 'Approved')
                        <span class="status-badge status-approved">Disetujui</span>
                    @else
                        <span class="status-badge status-pending">Menunggu Konfirmasi</span>
                    @endif
                </td>
            </tr>
        </table>

        <div class="footer">
            <p>Terima kasih telah menggunakan ArenaBook.</p>
            <p>Harap tunjukkan bukti ini kepada admin atau penjaga lapangan saat datang.</p>
        </div>
    </div>

</body>
</html>