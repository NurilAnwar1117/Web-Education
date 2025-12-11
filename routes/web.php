<?php

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentDataController;
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

    Route::get('/data-mahasiswa', [StudentDataController::class, 'index']
    )->name('data-mahasiswa');

    Route::get('/aktivitas', [ActivityLogController::class, 'index']
    )->name('aktivitas');
});

// Routes untuk profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


