<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActivityLog;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil 50 aktivitas terbaru beserta relasinya (mahasiswa & fasilitas)
        $recentLogs = ActivityLog::with(['student', 'facility'])
                        ->orderBy('log_id', 'desc')
                        ->limit(50)
                        ->get();

        // Statistik sederhana (opsional) untuk ditampilkan jika mau
        $totalMahasiswa = \App\Models\Student::count();
        $aktifHariIni = ActivityLog::whereDate('timestamp_in', Carbon::today())->count();
        $tidakAktif = $totalMahasiswa - $aktifHariIni;
        $aktivitasMingguan = ActivityLog::where('timestamp_in', '>=', Carbon::now()->subDays(7))->count();

        // Kirim ke view
        return view('dashboard', compact(
            'recentLogs',
            'totalMahasiswa',
            'aktifHariIni',
            'tidakAktif',
            'aktivitasMingguan'
        ));
    }
}

