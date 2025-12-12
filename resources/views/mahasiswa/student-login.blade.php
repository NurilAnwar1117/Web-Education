<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Mahasiswa</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            background: linear-gradient(135deg, #1e3c72, #2a5298);
        }
        .glass {
            background: rgba(255, 255, 255, 0.18);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255,255,255,0.2);
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center">

<div class="glass w-full max-w-md rounded-3xl shadow-xl p-10 mx-4">

    <div class="text-center mb-6">
        <h1 class="text-3xl font-bold text-white tracking-wide">Login Mahasiswa</h1>
        <p class="text-white/80 text-sm">Masuk menggunakan NIM dan password</p>
    </div>

    {{-- TAMPILKAN ERROR GLOBAL (JIKA ADA) --}}
    @if ($errors->any())
        <div class="mb-4 bg-red-500/80 text-white text-sm px-4 py-2 rounded-xl">
            {{ $errors->first() }}
        </div>
    @endif

    {{-- TAMPILKAN STATUS (DARI REGISTER BERHASIL) --}}
    @if (session('status'))
        <div class="mb-4 bg-emerald-500/80 text-white text-sm px-4 py-2 rounded-xl">
            {{ session('status') }}
        </div>
    @endif

    <form action="{{ route('student.login.submit') }}" method="POST">
        @csrf

        <!-- NIM -->
        <div class="mb-5">
            <label class="text-white text-sm font-medium">NIM</label>
            <input type="text" name="nim" required
                   value="{{ old('nim') }}"
                   placeholder="Masukkan NIM"
                   class="w-full mt-1 px-4 py-2 rounded-xl bg-white/20 text-white placeholder-white/70 focus:ring-2 focus:ring-blue-300 outline-none">
        </div>

        <!-- Password -->
        <div class="mb-5">
            <label class="text-white text-sm font-medium">Password</label>
            <input type="password" name="password" required
                   placeholder="••••••••"
                   class="w-full mt-1 px-4 py-2 rounded-xl bg-white/20 text-white placeholder-white/70 focus:ring-2 focus:ring-blue-300 outline-none">
        </div>

        <!-- Tombol Login -->
        <button
            class="w-full bg-white text-blue-700 font-bold py-2 rounded-xl shadow-lg hover:bg-blue-100 transition-all">
            Login
        </button>

        <p class="text-center mt-4 text-sm">
            <a href="{{ route('student.register') }}" class="text-white/80 hover:text-white underline">
                Belum punya akun? Daftar
            </a>
        </p>

        <p class="text-center mt-1 text-xs">
            <a href="{{ route('login') }}" class="text-white/70 hover:text-white underline">
                Login sebagai Admin
            </a>
        </p>
    </form>

</div>

</body>
</html>
