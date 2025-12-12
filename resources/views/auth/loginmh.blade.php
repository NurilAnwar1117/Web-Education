<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login • Monitoring Mahasiswa</title>

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

        <!-- HEADER -->
        <div class="text-center mb-8">
            <img src="https://i.pravatar.cc/200"
                 class="w-24 h-24 rounded-full mx-auto shadow-xl border-4 border-white/40">
            <h1 class="text-3xl font-bold text-white mt-4 tracking-wide">Monitoring Mahasiswa</h1>
            <p class="text-white/80 text-sm">Silahkan login untuk melanjutkan</p>
        </div>

        <!-- STATUS -->
        <x-auth-session-status class="mb-4 text-white" :status="session('status')" />

        <!-- FORM LOGIN -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="mb-5">
                <label class="text-white text-sm font-medium">Email</label>
                <input type="email" name="email" required autofocus
                       placeholder="name@example.com"
                       class="w-full mt-1 px-4 py-2 rounded-xl bg-white/20 text-white placeholder-white/70 focus:ring-2 focus:ring-blue-300 outline-none">
                <x-input-error :messages="$errors->get('email')" class="mt-1 text-red-200" />
            </div>

            <!-- Password -->
            <div class="mb-5">
                <label class="text-white text-sm font-medium">Password</label>
                <input type="password" name="password" required
                       placeholder="••••••••"
                       class="w-full mt-1 px-4 py-2 rounded-xl bg-white/20 text-white placeholder-white/70 focus:ring-2 focus:ring-blue-300 outline-none">
                <x-input-error :messages="$errors->get('password')" class="mt-1 text-red-200" />
            </div>

            <!-- Remember -->
            <div class="flex items-center mb-6">
                <input type="checkbox" name="remember"
                       class="rounded text-blue-600 bg-white/20 border-white/40 focus:ring-blue-300">
                <span class="ml-2 text-white/90 text-sm">Ingat saya</span>
            </div>

            <!-- Tombol Login -->
            <button
                class="w-full bg-white text-blue-700 font-bold py-2 rounded-xl shadow-lg hover:bg-blue-100 transition-all">
                Login
            </button>

            <!-- Lupa Password -->
           <p class="text-center mt-3">
                <a href="{{ route('student.register') }}" 
                class="text-white/80 hover:text-white underline text-sm">
                    Belum mempunyai akun?
                </a>
            </p>
        </form>

        <!-- Register -->
       

    </div>

</body>
</html>
