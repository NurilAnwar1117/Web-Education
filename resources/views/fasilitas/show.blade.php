@extends('layouts.main')

@section('title', 'Laporan Fasilitas')

@section('content')
<div class="glass rounded-2xl p-6 shadow-2xl text-white">

    <h1 class="text-2xl font-bold mb-4">Laporan Fasilitas: {{ $facility->facility_name }}</h1>

    {{-- Filter bulan & tahun --}}
    <form class="mb-6" method="GET">
        <div class="flex gap-3">

            <select name="month" class="text-black p-2 rounded">
                @foreach(range(1,12) as $m)
                    <option value="{{ $m }}" {{ $m == $month ? 'selected' : '' }}>
                        {{ DateTime::createFromFormat('!m', $m)->format('F') }}
                    </option>
                @endforeach
            </select>

            <select name="year" class="text-black p-2 rounded">
                @foreach(range(now()->year - 5, now()->year) as $y)
                    <option value="{{ $y }}" {{ $y == $year ? 'selected' : '' }}>
                        {{ $y }}
                    </option>
                @endforeach
            </select>

            <button class="bg-blue-600 px-4 py-2 rounded">Filter</button>
        </div>
    </form>

    {{-- Statistik --}}
    <div class="grid md:grid-cols-4 gap-6 mb-6">
        <div class="bg-white text-gray-700 p-5 rounded-xl shadow">
            <h3 class="font-semibold">Frekuensi</h3>
            <p class="text-3xl font-bold mt-2">{{ $frequency }}</p>
        </div>

        <div class="bg-white text-gray-700 p-5 rounded-xl shadow">
            <h3 class="font-semibold">Durasi Rata-rata</h3>
            <p class="text-3xl font-bold mt-2">{{ round($avg,1) }} menit</p>
        </div>

        <div class="bg-white text-gray-700 p-5 rounded-xl shadow">
            <h3 class="font-semibold">Total Utilisasi</h3>
            <p class="text-3xl font-bold mt-2">{{ $util }} menit</p>
        </div>

        <div class="bg-white text-gray-700 p-5 rounded-xl shadow">
            <h3 class="font-semibold">Bulan</h3>
            <p class="text-xl font-bold mt-2">{{ $month }}/{{ $year }}</p>
        </div>
    </div>

    {{-- Grafik pola waktu --}}
    <div class="bg-white rounded-xl p-6 shadow text-gray-800">
        <h3 class="font-bold text-gray-700">Pola Waktu (Jam Sibuk)</h3>
        <canvas id="chartHours" class="mt-4"></canvas>
    </div>

</div>
@endsection

@section('scripts')
<script>
    new Chart(document.getElementById('chartHours'), {
        type: 'line',
        data: {
            labels: @json($labelHours),
            datasets: [{
                label: 'Jumlah Aktivitas',
                data: @json($dataHours),
                borderColor: '#2F80ED',
                backgroundColor: 'rgba(47,128,237,0.3)',
                borderWidth: 3,
                tension: 0.4
            }]
        }
    });
</script>
@endsection
