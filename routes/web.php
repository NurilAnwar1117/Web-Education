<?php

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\AnalyticController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentDataController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FacilityLoanController;
use App\Http\Controllers\FacilityReportController;
use App\Http\Controllers\StudentAuthController;

// ========================
// ROOT: ARAHKAN KE LOGIN ADMIN
// ========================
Route::get('/', function () {
    return redirect()->route('student.login');
});

// ========================
// AREA ADMIN (HARUS LOGIN LARAVEL)
// ========================
Route::middleware(['auth', 'verified'])->group(function () {

    // DASHBOARD & ANALITIK
    Route::get('/dashboard', [AnalyticController::class, 'index'])
        ->name('dashboard');

    // DATA MAHASISWA
    Route::get('/data-mahasiswa', [StudentDataController::class, 'index'])
        ->name('data-mahasiswa');
    Route::delete('/data-mahasiswa/{student}', [DashboardController::class, 'destroyStudent'])
        ->name('data-mahasiswa.destroy');

    // AKTIVITAS
    Route::get('/aktivitas', [ActivityLogController::class, 'index'])
        ->name('aktivitas');
    Route::delete('/aktivitas/{log}', [DashboardController::class, 'destroyActivity'])
        ->name('aktivitas.destroy');

    // PEMINJAMAN FASILITAS (VIEW ADMIN)
    Route::get('/peminjaman-fasilitas', [FacilityLoanController::class, 'index'])
        ->name('peminjaman.index');

    // LAPORAN FASILITAS
    Route::get('/fasilitas', [FacilityReportController::class, 'index'])
        ->name('fasilitas.index');

    Route::get('/fasilitas/{id}', [FacilityReportController::class, 'show'])
        ->name('fasilitas.show');
});

    // Selesai aktivitas (mahasiswa)
    Route::post('/mahasiswa/selesai', [FacilityLoanController::class, 'finish'])
        ->name('mahasiswa.peminjaman.finish');

    // Logout mahasiswa (session)
    Route::post('/student/logout', [StudentAuthController::class, 'logout'])
        ->name('student.logout');

// ========================
// AUTH MAHASISWA (REGISTER & LOGIN)
// ========================

// FORM REGISTER MAHASISWA
Route::get('/student/register', [StudentAuthController::class, 'showRegisterForm'])
    ->name('student.register');

// PROSES REGISTER MAHASISWA
Route::post('/student/register', [StudentAuthController::class, 'register'])
    ->name('student.register.submit');

// FORM LOGIN MAHASISWA
Route::get('/student/login', [StudentAuthController::class, 'showLoginForm'])
    ->name('student.login');

// PROSES LOGIN MAHASISWA
Route::post('/student/login', [StudentAuthController::class, 'login'])
    ->name('student.login.submit');

// ========================
// PORTAL MAHASISWA (SETELAH LOGIN NIM+PASSWORD)
// ========================

// Halaman form peminjaman fasilitas (blade peminjaman-fasilitas milikmu)
Route::get('/mahasiswa', [FacilityLoanController::class, 'create'])
    ->name('mahasiswa.home');

// Submit: mulai aktivitas / peminjaman → masuk ke activity_logs
Route::post('/mahasiswa/peminjaman', [FacilityLoanController::class, 'store'])
    ->name('mahasiswa.peminjaman.store');

// ========================
// PROFILE (ADMIN) – BAWAAN LARAVEL
// ========================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
