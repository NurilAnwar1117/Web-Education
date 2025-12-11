@extends('layouts.main')
@section('title','Analytics')
@section('content')
<div class="glass rounded-2xl p-6 shadow-2xl">
    
    <h1 class="text-2xl font-bold mb-4 text-white">Dashboard Monitoring Fasilitas</h1>
    <div class="grid grid-cols-4 gap-4 mb-6">
        <div class="bg-white p-4 rounded">Total Hari Ini<br><span class="text-2xl font-bold">{{ $totalToday }}</span></div>
        <div class="bg-white p-4 rounded">Aktivitas Minggu Ini<br><span class="text-2xl font-bold">{{ $activityWeek }}</span></div>
        <div class="bg-white p-4 rounded">Akitivats Bulan Ini<br><span class="text-2xl font-bold">{{ $activityMonth }}</span></div>
        <div class="bg-white p-4 rounded">Akitivats Tahun Ini<br><span class="text-2xl font-bold">{{ $activityYear }}</span></div>
    </div>

    <div class="flex gap-2 mb-4">
        <a href="{{ route('dashboard', ['range' => 'week']) }}"
        class="px-4 py-2 rounded-lg {{ $range=='week'?'bg-blue-600 text-white':'bg-gray-200' }}">
        Mingguan
        </a>

        <a href="{{ route('dashboard', ['range' => 'month']) }}"
        class="px-4 py-2 rounded-lg {{ $range=='month'?'bg-blue-600 text-white':'bg-gray-200' }}">
        Bulanan
        </a>

        <a href="{{ route('dashboard', ['range' => 'year']) }}"
        class="px-4 py-2 rounded-lg {{ $range=='year'?'bg-blue-600 text-white':'bg-gray-200' }}">
        Tahunan
        </a>
    </div>

    <div class="grid md:grid-cols-2 gap-6">
        <div class="bg-white p-4 rounded">
            <h3 class="font-semibold">Frekuensi Penggunaan (Top)</h3>
            <canvas id="chartFrequency"></canvas>
        </div>

        <div class="bg-white p-4 rounded">
            <h3 class="font-semibold">Durasi Rata-rata (menit)</h3>
            <canvas id="chartAvgDuration"></canvas>
        </div>

        <div class="bg-white p-4 rounded md:col-span-2">
            <h3 class="font-semibold">Pola Waktu (per jam)</h3>
            <canvas id="chartHours"></canvas>
        </div>

        <!-- <div class="bg-white p-4 rounded">
            <h3 class="font-semibold">Utilisasi (total menit / 30 hari)</h3>
            <canvas id="chartUtil"></canvas>
        </div> -->
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // ambil data dari server (PHP -> JS)
    const labelFrequency = {!! json_encode($labelFrequency) !!};
    const dataFrequency  = {!! json_encode($dataFrequency) !!};

    const labelAvg = {!! json_encode($labelAvg) !!};
    const dataAvg  = {!! json_encode($dataAvg) !!};

    const labelHours = {!! json_encode($labelHours) !!};
    const dataHours  = {!! json_encode($dataHours) !!};

    const labelUtil = {!! json_encode($labelUtil) !!};
    const dataUtil  = {!! json_encode($dataUtil) !!};

    // Chart: Frequency (bar)
    new Chart(document.getElementById('chartFrequency'), {
        type: 'bar',
        data: {
            labels: labelFrequency,
            datasets: [{ label: 'Jumlah Penggunaan', data: dataFrequency }]
        },
        options: { responsive: true }
    });

    // Chart: Average Duration (horizontal bar)
    new Chart(document.getElementById('chartAvgDuration'), {
        type: 'bar',
        data: {
            labels: labelAvg,
            datasets: [{ label: 'Rata-rata (menit)', data: dataAvg }]
        },
        options: { indexAxis: 'y', responsive: true }
    });

    // Chart: Hours (line)
    new Chart(document.getElementById('chartHours'), {
        type: 'line',
        data: { labels: labelHours, datasets: [{ label: 'Check-ins per jam', data: dataHours, fill: true, tension: 0.3 }] },
        options: { responsive: true }
    });

    // Chart: Utilization (pie)
    new Chart(document.getElementById('chartUtil'), {
        type: 'pie',
        data: { labels: labelUtil, datasets: [{ label: 'Total Menit', data: dataUtil }] },
        options: { responsive: true }
    });
</script>
@endsection
