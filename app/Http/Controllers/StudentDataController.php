<?php

namespace App\Http\Controllers;
use App\Models\Student;

class StudentDataController extends Controller
{
    public function index()
    {
        $students = Student::all();   // ← AMBIL DATA

        return view('data-mahasiswa', compact('students'));
    }
}
