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

        return view('mahasiswa.home', [
            'facilities' => $facilities
        ]);
    }

    // Mulai aktivitas / peminjaman → masuk ke activity_logs
    public function store(Request $request)
    {
        $request->validate([
            'facility_id'   => 'required|exists:facilities,facility_id',
            'activity_type' => 'required|in:masuk,keluar,menggunakan,using',
        ]);

        // 1. Cari student berdasarkan NIM user yang login
        //    -> pastikan users punya field 'nim' dan students juga punya 'nim'
        $user = Auth::user();

        $student = Student::where('nim', $user->nim ?? null)->first();

        if (! $student) {
            return back()->with('error', 'Data mahasiswa tidak ditemukan di tabel students. Hubungi admin.');
        }

        $studentId = $student->student_id;

        // 2. Cek apakah masih ada aktivitas aktif
        $hasActive = ActivityLog::where('student_id', $studentId)
            ->whereNull('timestamp_out')
            ->exists();

        if ($hasActive) {
            return back()->with('error', 'Selesaikan aktivitas sebelumnya terlebih dahulu sebelum memulai yang baru.');
        }

        // 3. Buat log aktivitas baru
        ActivityLog::create([
            'student_id'    => $studentId,
            'facility_id'   => $request->facility_id,
            'activity_type' => $request->activity_type ?? 'menggunakan',
            'timestamp_in'  => now(),
            'timestamp_out' => null,
            'duration'      => null,
        ]);

        return back()->with('success', 'Aktivitas fasilitas berhasil dicatat.');
    }
}
