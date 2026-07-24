<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ArenaBook - Reservasi Lapangan Olahraga</title>
    
    <!-- Memanggil Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-[#043873] text-white min-h-screen flex flex-col font-sans relative overflow-x-hidden">

    <!-- Ornamen Garis Lengkung Latar Belakang (Opsional/Sederhana) -->
    <div class="absolute inset-0 opacity-10 pointer-events-none" 
         style="background-image: repeating-radial-gradient(circle at 0 0, transparent 0, #043873 40px), repeating-linear-gradient(#ffffff55, #ffffff55);">
    </div>

    <!-- NAVBAR -->
    <nav class="w-full flex items-center justify-between px-6 lg:px-16 py-6 relative z-10">
        
        <!-- Bagian Kiri (Logo) -->
        <div>
            <a href="/" class="text-3xl font-bold flex items-center gap-2 tracking-tight">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M14.707 2.293a1 1 0 010 1.414l-9 9a1 1 0 01-1.414-1.414l9-9a1 1 0 011.414 0zm-10.6 5.6a1 1 0 11-1.414-1.414l2-2a1 1 0 111.414 1.414l-2 2zm10.2 6.2a1 1 0 11-1.414-1.414l2-2a1 1 0 111.414 1.414l-2 2z" clip-rule="evenodd" />
                </svg>
                ArenaBook
            </a>
        </div>
        
        <!-- Bagian Kanan (Tombol) -->
        <div class="flex items-center gap-2 sm:gap-4">
            @if (Route::has('login'))
                @auth
                    <!-- Jika sudah login, tampilkan tombol ke Dashboard -->
                    <a href="{{ url('/dashboard') }}" class="btn bg-[#FFE492] text-[#043873] hover:bg-yellow-300 border-none font-bold px-6">
                        Dashboard
                    </a>
                @else
                    <!-- Tombol Login -->
                    <a href="{{ route('login') }}" class="btn bg-[#FFE492] text-[#043873] hover:bg-yellow-300 border-none font-bold px-4 sm:px-6">
                        Login
                    </a>
                    
                    <!-- Tombol Register -->
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn bg-[#4F9CF9] text-white hover:bg-blue-500 border-none px-4 sm:px-6">
                            Daftar ArenaBook &rarr;
                        </a>
                    @endif
                @endauth
            @endif
        </div>
        
    </nav>

    <!-- HERO SECTION -->
    <main class="flex-grow flex items-center relative z-10 pb-20 pt-8 lg:pt-0">
        <div class="flex flex-col lg:flex-row w-full items-center justify-between px-6 lg:px-16 mx-auto max-w-screen-2xl gap-12 lg:gap-8">
            
            <!-- Bagian Teks Kiri -->
            <div class="w-full lg:w-1/2 text-left">
                <h1 class="text-5xl lg:text-7xl font-extrabold leading-tight tracking-tight mb-6">
                    Pesan Lapangan Olahraga Tanpa Ribet
                </h1>
                <p class="py-4 text-lg lg:text-xl font-light mb-8 text-blue-100 max-w-xl">
                    Sistem reservasi terpadu yang memungkinkan tim Anda melihat jadwal, mengamankan jam bermain, dan mengelola aktivitas olahraga sehari-hari dengan mudah.
                </p>
                <a href="{{ route('register') }}" class="btn bg-[#4F9CF9] text-white hover:bg-blue-500 border-none btn-lg px-8 rounded-lg shadow-lg">
                    Coba ArenaBook Sekarang &rarr;
                </a>
            </div>

            <img src="{{ asset('images/ilustrasi-lapangan.png') }}" 
     alt="Ilustrasi ArenaBook" 
     style="width: 100%; max-width: 580px; height: 420px; object-fit: cover; border-radius: 20px; box-shadow: 0 15px 35px rgba(0,0,0,0.4); border: 2px solid rgba(255,255,255,0.2); display: block; margin: 0 auto;">
            
        </div>
    </main>
</body>
</html>