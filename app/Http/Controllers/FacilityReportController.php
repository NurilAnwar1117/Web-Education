<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Services\FacilityAnalyticsService;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FacilityReportController extends Controller
{
    public function index()
    {
        $fasilitas = Facility::all();

        return view('fasilitas.index', compact('fasilitas'));
    }

    public function show($id, FacilityAnalyticsService $service, Request $request)
    {
        $facility = Facility::findOrFail($id);

        // Default: bulan & tahun saat ini
        $month = $request->month ?? now()->month;
        $year  = $request->year ?? now()->year;

        // Panggil service
        $frequency = $service->usageFrequency($id, $month, $year);
        $avg       = $service->averageDuration($id, $month, $year);
        $temporal  = $service->temporalPattern($id, $month, $year);
        $util      = $service->utilization($id, $month, $year);

        // Siapkan label jam untuk grafik
        $labelHours = range(0, 23);
        $dataHours  = array_fill(0, 24, 0);

        foreach ($temporal as $row) {
            $dataHours[$row->hour] = (int) $row->count;
        }

        return view('fasilitas.show', compact(
            'facility',
            'month',
            'year',
            'frequency',
            'avg',
            'util',
            'labelHours',
            'dataHours'
        ));
    }
}
