<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Portal Mahasiswa')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            background: linear-gradient(135deg, #2F80ED, #56CCF2); /* sama seperti admin */
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Inter", sans-serif;
        }
        .glass {
            backdrop-filter: blur(15px);
            background: rgba(255, 255, 255, 0.25);
        }
    </style>
</head>
<body class="min-h-screen p-4 md:p-8">

    {{-- HEADER / TOP BAR UNTUK MAHASISWA --}}
    <header class="glass rounded-2xl px-4 py-3 md:px-6 md:py-4 mb-4 md:mb-6 flex items-center justify-between shadow-xl">

        {{-- KIRI --}}
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 md:w-12 md:h-12 rounded-full bg-white/80 flex items-center justify-center shadow">
                <i class="fa fa-user-graduate text-blue-600 text-lg md:text-xl"></i>
            </div>
            <div>
                <h1 class="text-base md:text-lg font-bold text-white">Portal Mahasiswa</h1>
                <p class="text-[11px] md:text-xs text-blue-100">peminjaman fasilitas kampus</p>
            </div>
        </div>

        {{-- KANAN --}}
        <form method="POST" action="{{ route('student.logout') }}">
            @csrf
            <button type="submit"
                class="px-4 py-2 rounded-xl bg-red-600 text-white text-xs md:text-sm hover:bg-red-700">
                Logout
            </button>
        </form>

    </header>

    {{-- KONTEN UTAMA MAHASISWA --}}
    <main class="px-4 md:px-8 lg:px-12 xl:px-20">
        @yield('content')
    </main>


    @yield('scripts')
</body>
</html>
