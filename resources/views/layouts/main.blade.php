<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Monitoring Mahasiswa')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            background: linear-gradient(135deg, #2F80ED, #56CCF2);
        }
        .glass {
            backdrop-filter: blur(15px);
            background: rgba(255, 255, 255, 0.25);
        }
    </style>
</head>

<body class="min-h-screen p-4 md:p-10">

<div class="flex flex-col md:flex-row gap-6 md:gap-8">

    {{-- SIDEBAR GLOBAL --}}
    <aside class="md:w-64 bg-[#1E2A38] text-white rounded-2xl p-6 shadow-xl flex flex-col">

        <div class="text-center">
            <img src="https://i.pravatar.cc/150" class="w-20 h-20 rounded-full mx-auto mb-3">
            <h2 class="text-lg font-bold">Admin Monitoring</h2>
            <p class="text-gray-400 text-sm">Monitoring Mahasiswa</p>
        </div>

        <nav class="mt-10 space-y-3">
            {{-- Dashboard --}}
            <a href="{{ route('dashboard') }}"
               class="flex items-center gap-3 p-3 rounded-xl cursor-pointer hover:bg-[#243447]
                      {{ Route::is('dashboard') ? 'bg-[#243447]' : '' }}">
                <i class="fa fa-home"></i> Dashboard
            </a>

            {{-- Data Mahasiswa --}}
            <a href="{{ route('data-mahasiswa') }}"
               class="flex items-center gap-3 p-3 rounded-xl cursor-pointer hover:bg-[#243447]
                      {{ Route::is('data-mahasiswa') ? 'bg-[#243447]' : '' }}">
                <i class="fa fa-users"></i> Data Mahasiswa
            </a>

            {{-- Menu dummy lain (belum ada route) --}}
            <a href="{{ route('aktivitas') }}"
                class="flex items-center gap-3 p-3 rounded-xl cursor-pointer hover:bg-[#243447]
                    {{ Route::is('aktivitas') ? 'bg-[#243447]' : '' }}">
                <i class="fa fa-clock"></i> Aktivitas
            </a>

            <!-- <a href="{{ route('peminjaman.index') }}"
                class="flex items-center gap-3 p-3 hover:bg-[#243447] rounded-xl cursor-pointer">
                <i class="fa fa-hand-holding-heart"></i>
                Peminjaman Fasilitas
            </a> -->
            
            <a href="{{ route('laporan') }}"
                class="flex items-center gap-3 p-3 hover:bg-[#243447] 
                    {{ Route::is('laporan') ? 'bg-[#243447]' : '' }}">
                <i class="fa fa-chart-line"></i> Laporan
            </a>
        </nav>
        
<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button class="flex items-center gap-3 p-3 mt-auto bg-red-600 hover:bg-red-700 rounded-xl w-full text-left">
        <i class="fa fa-sign-out-alt"></i> Logout
    </button>
</form>
     
    </aside>

    {{-- AREA KONTEN HALAMAN --}}
    <main class="flex-1">
        @yield('content')
    </main>

</div>

@yield('scripts')

</body>
</html>
