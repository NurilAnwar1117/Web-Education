<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FacilityAnalyticsService
{
    // Frekuensi penggunaan per bulan
    public function usageFrequency($facilityId, $month, $year)
    {
        return DB::table('activity_logs')
            ->where('facility_id', $facilityId)
            ->whereMonth('timestamp_in', $month)
            ->whereYear('timestamp_in', $year)
            ->count();
    }

    // Durasi rata-rata
    public function averageDuration($facilityId, $month, $year)
    {
        return DB::table('activity_logs')
            ->where('facility_id', $facilityId)
            ->whereNotNull('timestamp_out')
            ->whereMonth('timestamp_in', $month)
            ->whereYear('timestamp_in', $year)
            ->select(DB::raw('AVG(TIMESTAMPDIFF(MINUTE, timestamp_in, timestamp_out)) AS avg_duration'))
            ->value('avg_duration');
    }

    // Pola waktu (jam sibuk)
    public function temporalPattern($facilityId, $month, $year)
    {
        return DB::table('activity_logs')
            ->select(DB::raw('HOUR(timestamp_in) AS hour'), DB::raw('COUNT(*) AS count'))
            ->where('facility_id', $facilityId)
            ->whereMonth('timestamp_in', $month)
            ->whereYear('timestamp_in', $year)
            ->groupBy(DB::raw('HOUR(timestamp_in)'))
            ->orderBy('hour')
            ->get();
    }

    // Total pemakaian (utilisasi)
    public function utilization($facilityId, $month, $year)
    {
        return DB::table('activity_logs')
            ->where('facility_id', $facilityId)
            ->whereNotNull('timestamp_out')
            ->whereMonth('timestamp_in', $month)
            ->whereYear('timestamp_in', $year)
            ->select(DB::raw('SUM(TIMESTAMPDIFF(MINUTE, timestamp_in, timestamp_out)) AS total_minutes'))
            ->value('total_minutes');
    }
}
