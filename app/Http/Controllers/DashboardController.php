<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Data contoh, nanti bisa diganti dari database
        $data = [
            'total_mahasiswa' => 412,
            'aktif_hari_ini' => 130,
            'tidak_aktif' => 52,
            'laporan_mingguan' => 28,
        ];

        return view('dashboard', compact('data'));
    }
}
