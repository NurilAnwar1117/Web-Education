<?php
namespace App\Services;

use Illuminate\Support\Facades\DB;

class AnalyticsService
{
    // 1. Frekuensi Penggunaan Fasilitas (nama fasilitas + total)
    public function usageFrequency($days = 30)
    {
        return DB::table('activity_logs AS a')
            ->join('facilities AS f', 'a.facility_id', '=', 'f.facility_id')
            ->select('a.facility_id', 'f.facility_name', DB::raw('COUNT(*) as total_usage'))
            ->where('a.timestamp_in', '>=', now()->subDays($days))
            ->groupBy('a.facility_id', 'f.facility_name')
            ->orderByDesc('total_usage')
            ->get();
    }

    // 2. Durasi Rata-Rata Penggunaan (menit)
    public function averageDuration($days = 30)
    {
        return DB::table('activity_logs AS a')
            ->join('facilities AS f', 'a.facility_id', '=', 'f.facility_id')
            ->select(
                'a.facility_id',
                'f.facility_name',
                DB::raw('AVG(TIMESTAMPDIFF(MINUTE, timestamp_in, timestamp_out)) AS avg_duration')
            )
            ->whereNotNull('timestamp_out')
            ->where('timestamp_in', '>=', now()->subDays($days))
            ->groupBy('a.facility_id', 'f.facility_name')
            ->get();
    }

    // 3. Pola Waktu — hitung jumlah check-in per jam pada rentang tertentu (default 7 hari)
    public function temporalPattern($days = 7)
    {
        return DB::table('activity_logs')
            ->select(
                DB::raw('HOUR(timestamp_in) AS hour'),
                DB::raw('COUNT(*) AS count')
            )
            ->where('timestamp_in', '>=', now()->subDays($days))
            ->groupBy(DB::raw('HOUR(timestamp_in)'))
            ->orderBy('hour')
            ->get();
    }

    // 4. Utilisasi Fasilitas = total menit penggunaan per fasilitas dalam periode (default 30 hari)
    public function utilization($days = 30)
    {
        return DB::table('activity_logs AS a')
            ->join('facilities AS f', 'a.facility_id', '=', 'f.facility_id')
            ->select(
                'a.facility_id',
                'f.facility_name',
                DB::raw('SUM(TIMESTAMPDIFF(MINUTE, timestamp_in, timestamp_out)) AS total_minutes_used')
            )
            ->whereNotNull('timestamp_out')
            ->where('timestamp_in', '>=', now()->subDays($days))
            ->groupBy('a.facility_id', 'f.facility_name')
            ->get();
    }
}
