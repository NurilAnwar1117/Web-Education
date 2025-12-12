<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class StudentAuthController extends Controller
{
    // =======================
    // FORM REGISTER MAHASISWA
    // =======================
    public function showRegisterForm()
    {
        return view('mahasiswa.student-register');
    }

    // PROSES REGISTER
    public function register(Request $request)
    {
        $request->validate([
            'nim'           => 'required|string|max:50|unique:students,nim',
            'name'          => 'required|string|max:255',
            'program_study' => 'required|string|max:255',
            'faculty'       => 'required|string|max:255',
            'year_entry'    => 'required|integer|min:2000|max:2099',
            'password'      => 'required|string|min:6|confirmed',
        ]);

        Student::create([
            'nim'           => $request->nim,
            'name'          => $request->name,
            'program_study' => $request->program_study,
            'faculty'       => $request->faculty,
            'year_entry'    => $request->year_entry,
            'password'      => Hash::make($request->password),
        ]);

        return redirect()->route('student.login')
            ->with('status', 'Pendaftaran berhasil! Silakan login.');
    }

    // =======================
    // FORM LOGIN MAHASISWA
    // =======================
    public function showLoginForm()
    {
        return view('mahasiswa.student-login');
    }

    // PROSES LOGIN (NIM + PASSWORD)
    public function login(Request $request)
    {
        $request->validate([
            'nim'      => 'required|string',
            'password' => 'required|string',
        ]);

        // CARI MAHASISWA
        $student = Student::where('nim', $request->nim)->first();

        // CEK PASSWORD
        if (! $student || ! Hash::check($request->password, $student->password)) {
            return back()->withErrors([
                'nim' => 'NIM atau password salah.',
            ])->withInput();
        }

        // SIMPAN DATA MAHASISWA DI SESSION
        Session::put('student_id', $student->student_id);
        Session::put('student_nim', $student->nim);
        Session::put('student_name', $student->name);

        // ARAHKAN KE MENU PEMINJAMAN FASILITAS
        return redirect()->route('mahasiswa.home');
    }
}
