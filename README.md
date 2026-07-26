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

<img width="2880" height="1800" alt="Cuplikan layar 2026-07-25 004556" src="https://github.com/user-attachments/assets/291e0ac2-699b-4906-a4d5-1e1a2b12ed58" />

<h3>2. Verifikasi Email</h3>

<img width="2880" height="1800" alt="Cuplikan layar 2026-07-25 005347" src="https://github.com/user-attachments/assets/6afa4c51-5630-45f2-a825-9bc71ea44f92" />
<img width="2880" height="1704" alt="Cuplikan layar 2026-07-25 005534" src="https://github.com/user-attachments/assets/cac9a1bc-9fd5-4102-a615-5c1e29ba7a7b" />

<h3>3. Dashboard</h3>

<img width="2880" height="1800" alt="Cuplikan layar 2026-07-25 010141" src="https://github.com/user-attachments/assets/0249bc90-9356-4ba4-b927-d85f9bf976d1" />

<h3>4. CRUD</h3>

<img width="2880" height="1800" alt="Cuplikan layar 2026-07-25 010321" src="https://github.com/user-attachments/assets/759729e8-16a0-40bd-8352-b64ca4e93993" />

<h3>5 REST API&mdash;Menggunakan Postman</h3>
<img width="2880" height="1800" alt="Cuplikan layar 2026-07-26 070925" src="https://github.com/user-attachments/assets/719b86f6-2b73-40ec-b0c6-86d59cc00854" />
<img width="2880" height="1800" alt="Cuplikan layar 2026-07-26 070936" src="https://github.com/user-attachments/assets/98aa42a5-8ecb-4b97-b73b-936d66806ff7" />
<img width="2880" height="1800" alt="Cuplikan layar 2026-07-26 070405" src="https://github.com/user-attachments/assets/d852e06c-4782-46e3-bed2-f5f0d6118c01" />


<h3>6. Pemisahan Hak Akses Admin dan User</h3>
<h4>dashboard admin</h4>
<img width="2880" height="1800" alt="Cuplikan layar 2026-07-25 010321" src="https://github.com/user-attachments/assets/ac040485-8a34-4efb-aecf-3e7d7d7f0707" />
<img width="2880" height="1800" alt="Cuplikan layar 2026-07-25 010727" src="https://github.com/user-attachments/assets/dea240ac-ff03-43a1-88b7-1737e9bd0cb0" />
<h4>dashboard user</h4>
<img width="2880" height="1800" alt="Cuplikan layar 2026-07-25 175102" src="https://github.com/user-attachments/assets/e14fc54c-3f3f-41e4-82d2-20a55aff2f82" />
<img width="2880" height="1704" alt="Cuplikan layar 2026-07-25 082618" src="https://github.com/user-attachments/assets/6fd0aa90-fc3d-4068-97f7-948d88d7dcf4" />

<h3>7. Tampilan Desktop dan Mobile</h3>
<h4>Deskop</h4>
<img width="2880" height="1800" alt="Cuplikan layar 2026-07-25 175457" src="https://github.com/user-attachments/assets/6bc25efb-4154-4c8d-aba2-c2c9f44edd07" />
<h4>mobile</h4>
<img width="1356" height="1506" alt="Cuplikan layar 2026-07-25 175431" src="https://github.com/user-attachments/assets/929ba570-2b1c-4918-8f01-79a7395f377c" />

<h3>8. Hasil Export PDF</h3>
<img width="1954" height="1490" alt="image" src="https://github.com/user-attachments/assets/d603b9e1-c68c-4ad7-9602-ea1c221cb494" />

# **Struktur ROLE dan Hak Akses**
<div class="overflow-x-auto my-6">
    <table class="table w-full border-collapse border border-gray-300 bg-white shadow-md rounded-lg overflow-hidden text-sm">
        <thead>
            <tr class="bg-[#043873] text-white text-left">
                <th class="p-3 border border-gray-300">Fitur / Aksi</th>
                <th class="p-3 border border-gray-300 text-center w-28">Admin</th>
                <th class="p-3 border border-gray-300 text-center w-28">User / Pelanggan</th>
            </tr>
        </thead>
        <tbody>
            <tr class="hover:bg-gray-50">
                <td class="p-3 border border-gray-300">Lihat data lapangan & ketersediaan</td>
                <td class="p-3 border border-gray-300 text-center text-green-600 font-bold">✅</td>
                <td class="p-3 border border-gray-300 text-center text-green-600 font-bold">✅</td>
            </tr>
            <tr class="hover:bg-gray-50">
                <td class="p-3 border border-gray-300">Tambah / Edit / Hapus data lapangan (Master)</td>
                <td class="p-3 border border-gray-300 text-center text-green-600 font-bold">✅</td>
                <td class="p-3 border border-gray-300 text-center text-red-500 font-bold">❌</td>
            </tr>
            <tr class="hover:bg-gray-50">
                <td class="p-3 border border-gray-300">Lihat riwayat pemesanan / booking</td>
                <td class="p-3 border border-gray-300 text-center text-green-600 font-bold">✅ <span class="text-xs text-gray-500 font-normal">(Semua user)</span></td>
                <td class="p-3 border border-gray-300 text-center text-green-600 font-bold">✅ <span class="text-xs text-gray-500 font-normal">(Pribadi)</span></td>
            </tr>
            <tr class="hover:bg-gray-50">
                <td class="p-3 border border-gray-300">Lakukan pemesanan lapangan (Booking)</td>
                <td class="p-3 border border-gray-300 text-center text-red-500 font-bold">❌</td>
                <td class="p-3 border border-gray-300 text-center text-green-600 font-bold">✅</td>
            </tr>
            <tr class="hover:bg-gray-50">
                <td class="p-3 border border-gray-300">Persetujuan / Validasi pesanan (Approve/Reject)</td>
                <td class="p-3 border border-gray-300 text-center text-green-600 font-bold">✅</td>
                <td class="p-3 border border-gray-300 text-center text-red-500 font-bold">❌</td>
            </tr>
            <tr class="hover:bg-gray-50">
                <td class="p-3 border border-gray-300">Akses halaman Dashboard Utama</td>
                <td class="p-3 border border-gray-300 text-center text-green-600 font-bold">✅ <span class="text-xs text-gray-500 font-normal">(Statistik & Grafik)</span></td>
                <td class="p-3 border border-gray-300 text-center text-green-600 font-bold">✅ <span class="text-xs text-gray-500 font-normal">(Katalog Lapangan)</span></td>
            </tr>
        </tbody>
    </table>
</div>

# **Linsensi**
Project ini dibuat untuk keperluan akademik (Ujian Akhir Semester) dan tidak dimaksudkan untuk penggunaan komersial.

