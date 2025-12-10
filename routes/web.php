<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

// Arahkan root "/" langsung ke halaman login
Route::get('/', function () {
    return redirect()->route('login');
});

// Semua halaman utama yang butuh login & verifikasi
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard (home)
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // ✅ Halaman Data Mahasiswa (frontend + dummy JS)
    Route::get('/data-mahasiswa', function () {
        // saat ini kita tidak kirim data dari backend,
        // tabel diisi oleh JavaScript dummy di Blade
        return view('data-mahasiswa');
    })->name('data-mahasiswa');

    // ✅ Halaman Aktivitas Mahasiswa (frontend + dummy JS)
    Route::get('/aktivitas', function () {
        // sama seperti di atas, dummy di-handle di file Blade
        return view('aktivitas');
    })->name('aktivitas');
});

// Routes untuk profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


