<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mahasiswa</title>

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

<body class="min-h-screen flex items-center justify-center mt-7 mb-7">

<div class="glass w-full max-w-lg rounded-3xl shadow-xl p-10 mx-4">

    <h2 class="text-3xl font-bold text-white text-center mb-8">
        Pendaftaran Mahasiswa
    </h2>

    <form action="{{ route('student.register.submit') }}" method="POST">
        @csrf

        <!-- NIM -->
        <div class="mb-5">
            <label class="text-white text-sm font-medium">NIM</label>
            <input type="text" name="nim" required
                   class="w-full mt-1 px-4 py-2 rounded-xl bg-white/20 text-white placeholder-white/70 focus:ring-2 focus:ring-blue-300 outline-none">
        </div>

        <!-- Nama -->
        <div class="mb-5">
            <label class="text-white text-sm font-medium">Nama Lengkap</label>
            <input type="text" name="name" required
                   class="w-full mt-1 px-4 py-2 rounded-xl bg-white/20 text-white placeholder-white/70 focus:ring-2 focus:ring-blue-300 outline-none">
        </div>

        <!-- Program Studi -->
        <div class="mb-5">
            <label class="text-white text-sm font-medium">Program Studi</label>
            <input type="text" name="program_study" required
                   class="w-full mt-1 px-4 py-2 rounded-xl bg-white/20 text-white placeholder-white/70 focus:ring-2 focus:ring-blue-300 outline-none">
        </div>

        <!-- Fakultas -->
        <div class="mb-5">
            <label class="text-white text-sm font-medium">Fakultas</label>
            <input type="text" name="faculty" required
                   class="w-full mt-1 px-4 py-2 rounded-xl bg-white/20 text-white placeholder-white/70 focus:ring-2 focus:ring-blue-300 outline-none">
        </div>

        <!-- Tahun Masuk -->
        <div class="mb-5">
            <label class="text-white text-sm font-medium">Tahun Masuk</label>
            <input type="number" name="year_entry" required
                   min="2000" max="2099"
                   class="w-full mt-1 px-4 py-2 rounded-xl bg-white/20 text-white placeholder-white/70 focus:ring-2 focus:ring-blue-300 outline-none">
        </div>

        <!-- Password -->
        <div class="mb-5">
            <label class="text-white text-sm font-medium">Password</label>
            <input type="password" name="password" required
                   class="w-full mt-1 px-4 py-2 rounded-xl bg-white/20 text-white placeholder-white/70 focus:ring-2 focus:ring-blue-300 outline-none">
        </div>

        <!-- Confirm Password -->
        <div class="mb-5">
            <label class="text-white text-sm font-medium">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" required
                   class="w-full mt-1 px-4 py-2 rounded-xl bg-white/20 text-white placeholder-white/70 focus:ring-2 focus:ring-blue-300 outline-none">
        </div>

        <!-- Tombol Register -->
        <button class="w-full bg-white text-blue-700 font-bold py-2 rounded-xl shadow-lg hover:bg-blue-100 transition-all">
            Daftar
        </button>

        <p class="text-center mt-4">
            <a href="{{ route('student.login') }}" class="text-white/80 hover:text-white underline text-sm">
                Sudah punya akun? Login
            </a>
        </p>

    </form>

</div>

</body>
</html>
