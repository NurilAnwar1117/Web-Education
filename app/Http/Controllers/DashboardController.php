<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;      
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
        $totalMahasiswa = Student::count();
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
    
    // =======================
    // DATA MAHASISWA (LIST)
    // =======================
    public function mahasiswa(Request $request)
    {
        $query = Student::query();

        // Optional search
        if ($search = $request->q) {
            $query->where(function ($q) use ($search) {
                $q->where('nim', 'like', "%$search%")
                ->orWhere('name', 'like', "%$search%");
            });
        }

        $mahasiswa = $query->orderBy('student_id', 'desc')->get();

        return view('data-mahasiswa', compact('mahasiswa', 'search'));
    }

    public function destroyStudent($student_id)
    {
        // Hapus dulu semua activity_logs terkait
        ActivityLog::where('student_id', $student_id)->delete();

        // Baru hapus mahasiswa
        $student = Student::findOrFail($student_id);
        $student->delete();

        return redirect()
            ->route('data-mahasiswa')
            ->with('success', 'Data mahasiswa dan semua catatan aktivitasnya berhasil dihapus.');
    }
    
    // =======================
    // AKTIVITAS MAHASISWA
    // =======================
    public function aktivitas(Request $request)
    {
        $query = ActivityLog::with(['student', 'facility']);

        // Optional search
        if ($search = $request->q) {
            $query->where(function ($q) use ($search) {
                $q->where('activity_type', 'like', "%$search%")
                ->orWhereHas('student', function ($q2) use ($search) {
                        $q2->where('nim', 'like', "%$search%")
                        ->orWhere('name', 'like', "%$search%");
                });
            });
        }

        $logs = $query->orderBy('log_id', 'desc')->get();

        return view('aktivitas', compact('logs', 'search'));
    }

     public function destroyActivity(ActivityLog $log)
    {
        $log->delete();

        return redirect()
            ->back()
            ->with('success', 'Catatan aktivitas berhasil dihapus.');
    }


}

