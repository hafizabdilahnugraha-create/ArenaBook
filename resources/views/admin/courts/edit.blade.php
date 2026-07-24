<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Data Lapangan') }}
        </h2>
    </x-slot>

    <!-- Membatasi lebar maksimum halaman agar tidak penuh ke ujung layar -->
    <div style="padding-top: 40px; padding-bottom: 40px;">
        <div style="max-width: 900px; margin: 0 auto; padding: 0 20px;">
            
            <!-- Kotak Putih Utama (Memberikan jarak dalam / padding 40px) -->
            <div style="background-color: #ffffff; border-radius: 12px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05); padding: 40px;">
                
                <h3 style="font-size: 24px; font-weight: bold; margin-bottom: 24px; color: #1f2937;">Formulir Edit Lapangan</h3>

                <!-- Menampilkan pesan error validasi jika ada -->
                @if ($errors->any())
                    <div style="background-color: #fee2e2; color: #b91c1c; padding: 16px; border-radius: 8px; margin-bottom: 24px;">
                        <ul style="margin-left: 20px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ url('admin/courts/'.$court->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- GRID: Membagi form menjadi 2 kolom agar kotak input tidak memanjang -->
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 24px;">
                        
                        <!-- Nama Lapangan -->
                        <div>
                            <label style="display: block; font-weight: 600; color: #374151; margin-bottom: 8px;">Nama Lapangan</label>
                            <input type="text" name="name" value="{{ old('name', $court->name) }}" 
                                   style="width: 100%; padding: 12px 16px; border: 1px solid #d1d5db; border-radius: 8px; background-color: #f9fafb; font-size: 15px; outline: none; box-sizing: border-box;" required />
                        </div>

                        <!-- Kategori/Tipe Lapangan -->
                        <div>
                            <label style="display: block; font-weight: 600; color: #374151; margin-bottom: 8px;">Kategori Lapangan</label>
                            <input type="text" name="type" value="{{ old('type', $court->type) }}" 
                                   style="width: 100%; padding: 12px 16px; border: 1px solid #d1d5db; border-radius: 8px; background-color: #f9fafb; font-size: 15px; outline: none; box-sizing: border-box;" required />
                        </div>

                        <!-- Harga per Jam -->
                        <div>
                            <label style="display: block; font-weight: 600; color: #374151; margin-bottom: 8px;">Harga per Jam (Rp)</label>
                            <input type="number" name="price_per_hour" value="{{ old('price_per_hour', $court->price_per_hour) }}" 
                                   style="width: 100%; padding: 12px 16px; border: 1px solid #d1d5db; border-radius: 8px; background-color: #f9fafb; font-size: 15px; outline: none; box-sizing: border-box;" required />
                        </div>

                        <!-- Ganti Foto Lapangan -->
                        <div>
                            <label style="display: block; font-weight: 600; color: #374151; margin-bottom: 8px;">Ganti Foto (Opsional)</label>
                            <input type="file" name="image" accept="image/*" 
                                   style="width: 100%; padding: 8px 16px; border: 1px solid #d1d5db; border-radius: 8px; background-color: #ffffff; font-size: 14px; box-sizing: border-box;" />
                            <span style="display: block; font-size: 12px; color: #6b7280; margin-top: 4px;">Biarkan kosong jika tidak ingin mengganti foto.</span>
                            
                            <!-- Foto Lama -->
                            @if($court->image)
                                <div style="margin-top: 12px;">
                                    <p style="font-size: 13px; color: #4b5563; margin-bottom: 6px;">Foto saat ini:</p>
                                    <img src="{{ asset('storage/' . $court->image) }}" 
                                         style="width: 120px; height: 120px; object-fit: cover; border-radius: 8px; border: 1px solid #d1d5db; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Spesifikasi Lapangan -->
                    <div style="margin-top: 24px;">
                        <label style="display: block; font-weight: 600; color: #374151; margin-bottom: 8px;">Spesifikasi Detail</label>
                        <textarea name="specification" 
                                  style="width: 100%; min-height: 200px; padding: 16px; border: 1px solid #d1d5db; border-radius: 8px; background-color: #f9fafb; font-size: 15px; outline: none; box-sizing: border-box; resize: vertical;">{{ old('specification', $court->specification) }}</textarea>
                    </div>

                    <!-- Garis Pembatas -->
                    <hr style="margin-top: 32px; margin-bottom: 24px; border: none; border-top: 2px solid #e5e7eb;">

                    <!-- Tombol Simpan & Batal -->
                    <a href="{{ route('dashboard') }}" style="background-color: #9ca3af; color: #ffffff; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 14px;">
                    Batal
                    </a>
                        <button type="submit" style="background-color: #3b82f6; color: #ffffff; padding: 10px 20px; border-radius: 8px; border: none; font-weight: 600; font-size: 14px; cursor: pointer;">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>