<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Facility;
use App\Models\Student;    
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class FacilityLoanController extends Controller
{
    // Tampilkan form mahasiswa
    public function create()
    {
        $facilities = Facility::orderBy('facility_name')->get();

        $activeLog = null;
        if (session()->has('student_id')) {
            $activeLog = ActivityLog::with('facility')
                ->where('student_id', session('student_id'))
                ->whereNull('timestamp_out')
                ->latest('timestamp_in')
                ->first();
        }

        return view('mahasiswa.home', [
            'facilities' => $facilities,
            'activeLog'  => $activeLog,
        ]);
    }

    // Mulai aktivitas / peminjaman → masuk ke activity_logs
    public function store(Request $request)
    {
        // Pastikan mahasiswa login (pakai session, bukan Auth)
        if (!session()->has('student_id')) {
            return redirect()->route('student.login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        $request->validate([
            'facility_id'   => 'required|exists:facilities,facility_id',
            'activity_type' => 'required|string|max:255',
        ]);

        $studentId = session('student_id');

        // Cek aktivitas aktif
        $hasActive = ActivityLog::where('student_id', $studentId)
            ->whereNull('timestamp_out')
            ->exists();

        if ($hasActive) {
            return back()->with('error', 'Selesaikan aktivitas sebelumnya terlebih dahulu.');
        }

        ActivityLog::create([
            'student_id'    => $studentId,
            'facility_id'   => $request->facility_id,
            'activity_type' => $request->activity_type, // TEKS MANUAL
            'timestamp_in'  => now(),
            'timestamp_out' => null,
        ]);

        return back()->with('success', 'Aktivitas berhasil dicatat.');
    }

    public function finish(Request $request)
    {
        if (!session()->has('student_id')) {
            return redirect()->route('student.login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        $studentId = session('student_id');

        $activeLog = ActivityLog::where('student_id', $studentId)
            ->whereNull('timestamp_out')
            ->latest('timestamp_in')
            ->first();

        if (! $activeLog) {
            return back()->with('error', 'Tidak ada aktivitas yang sedang berjalan.');
        }

        $activeLog->update([
            'timestamp_out' => now(),
        ]);

        return back()->with('success', 'Aktivitas berhasil diselesaikan.');
    }


}
