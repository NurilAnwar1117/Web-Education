<?php

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\AnalyticController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentDataController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FacilityLoanController;
use App\Http\Controllers\FacilityReportController;

// Arahkan root "/" langsung ke halaman login
Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // ADMIN
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/data-mahasiswa', [DashboardController::class, 'mahasiswa'])->name('data-mahasiswa');
    Route::delete('/data-mahasiswa/{student}', [DashboardController::class, 'destroyStudent'])->name('data-mahasiswa.destroy');
    Route::get('/aktivitas', [DashboardController::class, 'aktivitas'])->name('aktivitas');
    Route::delete('/aktivitas/{log}', [DashboardController::class, 'destroyActivity'])->name('aktivitas.destroy');
    Route::get('/peminjaman-fasilitas', [FacilityLoanController::class, 'index'])->name('peminjaman.index');

    // Dashboard (home)
    Route::get('/dashboard', [AnalyticController::class, 'index'])
        ->name('dashboard');

    Route::get('/data-mahasiswa', [StudentDataController::class, 'index']
    )->name('data-mahasiswa');

    Route::get('/aktivitas', [ActivityLogController::class, 'index']
    )->name('aktivitas');

    // Halaman daftar fasilitas
    Route::get('/fasilitas', [FacilityReportController::class, 'index'])
        ->name('fasilitas.index');

    // Halaman laporan per fasilitas
    Route::get('/fasilitas/{id}', [FacilityReportController::class, 'show'])
        ->name('fasilitas.show');

    // MAHASISWA
    Route::get('/mahasiswa', [FacilityLoanController::class, 'create'])->name('mahasiswa.home');
    Route::post('/mahasiswa/peminjaman', [FacilityLoanController::class, 'store'])->name('mahasiswa.peminjaman.store');
});

// ========================
// ROUTE PORTAL MAHASISWA
// ========================
    Route::get('/mahasiswa', [FacilityLoanController::class, 'create'])
        ->name('mahasiswa.home');

    // Submit: mulai aktivitas / peminjaman → masuk ke activity_logs
    Route::post('/mahasiswa/peminjaman', [FacilityLoanController::class, 'store'])
        ->name('mahasiswa.peminjaman.store');

// Routes untuk profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
