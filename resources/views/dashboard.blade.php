@extends('layouts.main')

@section('title', 'Dashboard Monitoring Mahasiswa')

@section('content')

        <div class="glass rounded-2xl p-6 shadow-2xl">

            <h1 class="text-2xl font-bold text-white mb-5">Dashboard Monitoring Mahasiswa</h1>

            <!-- STATISTIK -->
            <div class="grid md:grid-cols-4 gap-6">
                <div class="bg-white rounded-xl p-5 shadow-lg text-center">
                    <h3 class="text-gray-600 font-semibold">Total Mahasiswa</h3>
                    <p class="text-3xl font-bold text-blue-600 mt-2">{{ $totalMahasiswa ?? 120 }}</p>
                </div>

                <div class="bg-white rounded-xl p-5 shadow-lg text-center">
                    <h3 class="text-gray-600 font-semibold">Aktif Hari Ini</h3>
                    <p class="text-3xl font-bold text-green-600 mt-2">{{ $aktifHariIni ?? 87 }}</p>
                </div>

                <div class="bg-white rounded-xl p-5 shadow-lg text-center">
                    <h3 class="text-gray-600 font-semibold">Tidak Aktif</h3>
                    <p class="text-3xl font-bold text-red-500 mt-2">{{ $tidakAktif ?? 33 }}</p>
                </div>

                <div class="bg-white rounded-xl p-5 shadow-lg text-center">
                    <h3 class="text-gray-600 font-semibold">Aktivitas Mingguan</h3>
                    <p class="text-3xl font-bold text-purple-600 mt-2">{{ $aktivitasMingguan ?? 240 }}</p>
                </div>
            </div>

            <!-- GRAFIK -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">

                <div class="bg-white rounded-2xl p-6 shadow-lg col-span-2">
                    <h3 class="text-gray-600 font-bold">Grafik Aktivitas Mingguan</h3>
                    <canvas id="chartAktivitas" class="mt-6"></canvas>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-lg">
                    <h3 class="text-gray-600 font-bold">Kalender</h3>
                    <div class="grid grid-cols-7 text-center mt-4 font-semibold text-gray-500">
                        <span>Mo</span><span>Tu</span><span>We</span><span>Th</span><span>Fr</span><span>Sa</span><span>Su</span>
                    </div>

                    <div class="grid grid-cols-7 text-center mt-2 gap-2 text-gray-700">
                        @for ($i = 1; $i <= 31; $i++)
                            <span class="p-2 rounded-full hover:bg-blue-200 cursor-pointer">{{ $i }}</span>
                        @endfor
                    </div>
                </div>
            </div>

           <!-- TABEL DATA DARI DATABASE -->
<div class="bg-white rounded-2xl p-6 shadow-lg mt-6">
    <h3 class="text-gray-700 font-bold mb-4">Aktivitas Terbaru (Database)</h3>

    @if($recentLogs->isEmpty())
        <p class="text-gray-500">Belum ada data aktivitas.</p>
    @else
    <div class="overflow-x-auto">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-3">#</th>
                <th class="p-3">Mahasiswa (NIM)</th>
                <th class="p-3">Fasilitas</th>
                <th class="p-3">Activity</th>
                <th class="p-3">Masuk</th>
                <th class="p-3">Keluar</th>
            </tr>
        </thead>

        <tbody>
            @foreach($recentLogs as $i => $log)
            <tr class="border-b">
                <td class="p-3">{{ $i + 1 }}</td>
                <td class="p-3">
                    {{ optional($log->student)->name ?? '—' }}
                    @if(optional($log->student)->nim)
                        <span class="text-xs text-gray-400">({{ $log->student->nim }})</span>
                    @endif
                </td>
                <td class="p-3">{{ optional($log->facility)->facility_name ?? '—' }}</td>
                <td class="p-3">{{ $log->activity_type ?? '-' }}</td>
                <td class="p-3">{{ $log->timestamp_in ?? '-' }}</td>
                <td class="p-3">{{ $log->timestamp_out ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    @endif
</div>

            <!-- AKTIVITAS TERBARU -->
            <div class="bg-white rounded-2xl p-6 shadow-lg mt-6">
                <h3 class="text-gray-700 font-bold mb-4">Aktivitas Mahasiswa (Static Example)</h3>

                <div class="space-y-3">
                    <div class="flex gap-4 p-3 bg-gray-100 rounded-xl">
                        <i class="fa fa-user text-blue-600 text-xl"></i>
                        <div>
                            <p class="font-semibold">Mahasiswa A</p>
                            <p class="text-sm text-gray-500">Check-in pukul 08:10</p>
                        </div>
                    </div>

                    <div class="flex gap-4 p-3 bg-gray-100 rounded-xl">
                        <i class="fa fa-user text-green-600 text-xl"></i>
                        <div>
                            <p class="font-semibold">Mahasiswa B</p>
                            <p class="text-sm text-gray-500">Upload laporan aktivitas</p>
                        </div>
                    </div>

                    <div class="flex gap-4 p-3 bg-gray-100 rounded-xl">
                        <i class="fa fa-user text-purple-600 text-xl"></i>
                        <div>
                            <p class="font-semibold">Mahasiswa C</p>
                            <p class="text-sm text-gray-500">Tidak ada aktivitas hari ini</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </main>
</div>
@endsection

@section('scripts')
<script>
    new Chart(document.getElementById('chartAktivitas'), {
        type: 'line',
        data: {
            labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
            datasets: [{
                label: 'Aktivitas',
                data: [20, 35, 50, 40, 60, 30, 25],
                borderColor: '#2F80ED',
                backgroundColor: 'rgba(47,128,237,0.3)',
                tension: 0.4,
                borderWidth: 3
            }]
        }
    });
</script>
@endsection

