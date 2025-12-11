<?php
namespace App\Http\Controllers;

use App\Services\AnalyticsService;

class AnalyticController extends Controller
{
    public function index(AnalyticsService $service)
    {
        $range = request()->get('range', 'month'); // default bulan

        $days = match ($range) {
            'week'  => 7,
            'month' => 30,
            'year'  => 365,
            default => 30,
        };

        // panggil service dengan parameter hari
        $freq = $service->usageFrequency($days);
        $avg  = $service->averageDuration($days);
        $temp = $service->temporalPattern($days);
        $util = $service->utilization($days);

        // ===== Prepare chart labels & values ===== //
        $labelFrequency = $freq->pluck('facility_name')->toArray();
        $dataFrequency  = $freq->pluck('total_usage')->map(fn($v)=> (int)$v)->toArray();

        $labelAvg = $avg->pluck('facility_name')->toArray();
        $dataAvg  = $avg->pluck('avg_duration')->map(fn($v)=> round((float)$v,1))->toArray();

        $hourCounts = collect(array_fill(0,24,0));
        foreach($temp as $row){
            $hourCounts[$row->hour] = (int)$row->count;
        }
        $labelHours = range(0,23);
        $dataHours  = $hourCounts->values()->toArray();

        $labelUtil = $util->pluck('facility_name')->toArray();
        $dataUtil  = $util->pluck('total_minutes_used')->map(fn($v)=> (int)$v)->toArray();

        // --- DATA UNTUK DASHBOARD ---
        $totalToday = \DB::table('activity_logs')
            ->whereDate('timestamp_in', now()->toDateString())
            ->count();

        $activityWeek = \DB::table('activity_logs')
            ->whereBetween('timestamp_in', [now()->startOfWeek(), now()->endOfWeek()])
            ->count();

        $activityMonth = \DB::table('activity_logs')
            ->whereBetween('timestamp_in', [now()->startOfMonth(), now()->endOfMonth()])
            ->count();

        $activityYear = \DB::table('activity_logs')
            ->whereBetween('timestamp_in', [now()->startOfYear(), now()->endOfYear()])
            ->count();

        return view('dashboard', compact(
            'range',
            'labelFrequency','dataFrequency',
            'labelAvg','dataAvg',
            'labelHours','dataHours',
            'labelUtil','dataUtil',
            'totalToday','activityWeek','activityMonth','activityYear'
        ));
    }
}
