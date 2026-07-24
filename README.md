# **ArenaBook — Sistem Informasi Reservasi Lapangan Olahraga Berbasis Web**

Aplikasi web untuk mengelola reservasi meja restoran secara online. Pelanggan dapat memesan meja dengan memilih tanggal, jam, dan jumlah tamu, sementara admin dapat mengelola data meja, menu, serta mengonfirmasi/menolak reservasi yang masuk. Aplikasi dilengkapi dashboard statistik dan sistem pencegahan bentrok jadwal, sehingga satu meja dapat dipesan oleh banyak pelanggan pada jam yang berbeda di hari yang sama.
Dibuat sebagai pemenuhan tugas Ujian Akhir Semester (UAS) Pemrograman Web Lanjut. 

saya ingin membuat seperti ini namun dengan projek saya pada readme

# **Identitas**
<ul>
    <li>Nama: Hafiz Abdillah Nugraha</li>
    <li>NIM: 230170145</li>
</ul>

# **fitur**
<ul>
    <li><strong>Autentikasi & Hak Akses</strong> — Sistem login dan registrasi menggunakan Laravel Breeze dengan pemisahan peran antara Admin (akses penuh kelola lapangan & konfirmasi reservasi) dan Pelanggan.</li>
    <li><strong>Katalog & Detail Lapangan</strong> — Menampilkan daftar lapangan olahraga lengkap dengan foto, kategori, spesifikasi, dan harga sewa per jam.</li>
    <li><strong>Formulir Pemesanan</strong> — Pelanggan dapat memesan lapangan secara <em>online</em> dengan memilih tanggal, jam mulai, dan jam selesai.</li>
    <li><strong>Riwayat & Status Pesanan</strong> — Pelanggan dapat memantau status pesanan secara <em>real-time</em> (Pending, Approved, atau Rejected).</li>
    <li><strong>Dashboard Statistik Admin</strong> — Menampilkan ringkasan total lapangan, total reservasi, dan jumlah pesanan yang menunggu persetujuan.</li>
    <li><strong>Manajemen Lapangan (CRUD)</strong> — Admin dapat menambah, mengedit (termasuk mengganti foto), dan menghapus data lapangan.</li>
    <li><strong>Konfirmasi Reservasi</strong> — Admin dapat meninjau dan menyetujui peminjaman lapangan yang masuk.</li>
    <li><strong>Pencegahan Bentrok Jadwal</strong> — Validasi sistem backend untuk memastikan satu lapangan tidak dapat dipesan pada tanggal dan jam yang sama.</li>
    <li><strong>Export Bukti Reservasi PDF</strong> — Fitur untuk mengunduh rincian atau bukti pemesanan dalam format PDF.</li>
    <li><strong>Responsive Design</strong> — Tampilan antarmuka yang fleksibel dan rapi diakses baik melalui komputer maupun perangkat <em>mobile</em>.</li>
</ul>

# **Teknologi Yang Digunakan**
<ul>
    <li><strong>Framework Backend:</strong> Laravel 11 (PHP)</li>
    <li><strong>Autentikasi & Verifikasi:</strong> Laravel Breeze (autentikasi + verifikasi email)</li>
    <li><strong>Frontend Templating:</strong> Blade Templating</li>
    <li><strong>Styling / UI:</strong> Tailwind CSS</li>
    <li><strong>Grafik Dashboard:</strong> Chart.js (grafik statistik pemesanan & penyewaan)</li>
    <li><strong>Manajemen Database:</strong> MySQL / SQLite</li>
</ul>

# **Langkah Instalasi**
<h3>Langkah Instalasi</h3>

<p>1. Clone repository</p>
<pre><code>git clone https://github.com/username/arenabook.git
cd arenabook</code></pre>

<p>2. Install dependency PHP</p>
<pre><code>composer install</code></pre>

<p>3. Install dependency JavaScript</p>
<pre><code>npm install</code></pre>

<p>4. Salin file environment</p>
<pre><code>cp .env.example .env</code></pre>

<p>5. Generate application key</p>
<pre><code>php artisan key:generate</code></pre>

<p>6. Buat database</p>
<p>Buat database baru bernama <code>db_arenabook</code> melalui phpMyAdmin (atau nama lain sesuai keinginan).</p>

<p>7. Konfigurasi database di file <code>.env</code></p>
<pre><code>DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_arenabook
DB_USERNAME=root
DB_PASSWORD=</code></pre>

<p>8. Jalankan migrasi dan seeder</p>
<pre><code>php artisan migrate --seed</code></pre>

<p>9. Build asset frontend</p>
<pre><code>npm run build</code></pre>

<p>10. Jalankan server</p>
<pre><code>php artisan serve</code></pre>

<p>Buka browser dan akses <code>http://127.0.0.1:8000</code></p>

# **Akun Demo**
<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>Role</th>
            <th>Email</th>
            <th>Password</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Admin</td>
            <td><a href="mailto:admin@arenabook.com">admin@arenabook.com</a></td>
            <td>password123</td>
        </tr>
        <tr>
            <td>Pelanggan</td>
            <td><a href="mailto:sardi@gmail.com">sardi@gmail.com</a></td>
            <td>12345678</td>
        </tr>
    </tbody>
</table>

<h3>Dokumentasi REST API</h3>

<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>Method</th>
            <th>Endpoint</th>
            <th>Keterangan</th>
            <th>Autentikasi</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><b>POST</b></td>
            <td><code>/login</code></td>
            <td>Login dan mendapatkan token akses</td>
            <td>Tidak</td>
        </tr>
        <tr>
            <td><b>POST</b></td>
            <td><code>/logout</code></td>
            <td>Logout (menghapus token aktif)</td>
            <td>Ya</td>
        </tr>
        <tr>
            <td><b>GET</b></td>
            <td><code>/courts</code></td>
            <td>Menampilkan daftar lapangan olahraga</td>
            <td>Tidak</td>
        </tr>
        <tr>
            <td><b>POST</b></td>
            <td><code>/courts</code></td>
            <td>Menambahkan data lapangan baru</td>
            <td>Ya (Admin)</td>
        </tr>
        <tr>
            <td><b>GET</b></td>
            <td><code>/courts/{id}</code></td>
            <td>Menampilkan detail lapangan tertentu</td>
            <td>Tidak</td>
        </tr>
        <tr>
            <td><b>PUT</b></td>
            <td><code>/courts/{id}</code></td>
            <td>Memperbarui data lapangan</td>
            <td>Ya (Admin)</td>
        </tr>
        <tr>
            <td><b>DELETE</b></td>
            <td><code>/courts/{id}</code></td>
            <td>Menghapus data lapangan</td>
            <td>Ya (Admin)</td>
        </tr>
        <tr>
            <td><b>GET</b></td>
            <td><code>/reservations</code></td>
            <td>Menampilkan riwayat/daftar reservasi</td>
            <td>Ya</td>
        </tr>
        <tr>
            <td><b>POST</b></td>
            <td><code>/reservations</code></td>
            <td>Membuat peminjaman/booking lapangan baru</td>
            <td>Ya</td>
        </tr>
    </tbody>
</table>

<h3>1. Halaman Login & Autentikasi</h3>

<p align="center">
  <img src="screenshots/login.png" alt="Halaman Login" width="800">
</p>
