<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index()
    {
        $logs = ActivityLog::with(['student', 'facility'])->get();

        return view('aktivitas', compact('logs'));
    }
}
