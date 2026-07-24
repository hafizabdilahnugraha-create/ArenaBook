<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Lapangan Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                
                <form action="{{ url('admin/courts') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <!-- 1. Nama Lapangan -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Nama Lapangan</label>
                        <input type="text" name="name" class="input input-bordered w-full" placeholder="Contoh: Lapangan Futsal VVIP" required>
                    </div>

                    <!-- Jenis / Kategori Lapangan -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Kategori Lapangan</label>
                        <select name="type" class="select select-bordered w-full" required>
                            <option value="Futsal">Futsal</option>
                            <option value="Badminton">Badminton</option>
                        </select>
                    </div>

                    <!-- 2. Harga Per Jam -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Harga per Jam (Rp)</label>
                        <input type="number" name="price_per_hour" class="input input-bordered w-full" placeholder="Contoh: 120000" required>
                    </div>

                    <!-- 3. Spesifikasi Lapangan -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Spesifikasi Lapangan</label>
                        <textarea name="specification" class="textarea textarea-bordered w-full" rows="3" placeholder="Contoh: Rumput sintetis standar FIFA, pencahayaan penerangan LED 400 Watt, termasuk 2 set rompi tim."></textarea>
                    </div>

                    <!-- 4. Foto Lapangan -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Foto Lapangan</label>
                        <input type="file" name="image" class="file-input file-input-bordered w-full" accept="image/*">
                    </div>

                    <!-- Tombol Batal & Simpan -->
                    <div style="display: flex; justify-content: flex-end; gap: 12px; margin-top: 24px;">
                        <!-- Tombol Batal (Abu-abu) -->
                        <a href="{{ url()->previous() }}" style="background-color: #9ca3af; color: #ffffff; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 14px;">
                            Batal
                        </a>
                        
                        <!-- Tombol Simpan (Biru) -->
                        <button type="submit" style="background-color: #3b82f6; color: #ffffff; padding: 10px 20px; border-radius: 8px; border: none; font-weight: 600; font-size: 14px; cursor: pointer;">
                            Simpan Lapangan
                        </button>
                    </div>

                    <!-- Pilihan Status Lapangan -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Status Lapangan</label>
                        <select name="status" class="select select-bordered w-full" required>
                            <option value="Tersedia">Tersedia</option>
                            <option value="Disewa">Sedang Disewa / Dipinjam</option>
                        </select>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>