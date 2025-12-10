<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Monitoring Mahasiswa</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            background: linear-gradient(135deg, #2F80ED, #56CCF2);
        }
        .glass {
            backdrop-filter: blur(15px);
            background: rgba(255, 255, 255, 0.25);
        }
    </style>
</head>

<body class="min-h-screen p-10">

<div class="flex gap-8">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-[#1E2A38] text-white rounded-2xl p-6 shadow-xl flex flex-col">

        <div class="text-center">
            <img src="https://i.pravatar.cc/150" class="w-20 h-20 rounded-full mx-auto mb-3">
            <h2 class="text-lg font-bold">Admin Monitoring</h2>
            <p class="text-gray-400 text-sm">Monitoring Mahasiswa</p>
        </div>

        <nav class="mt-10 space-y-3">
            <a class="flex items-center gap-3 p-3 hover:bg-[#243447] rounded-xl cursor-pointer">
                <i class="fa fa-home"></i> Dashboard
            </a>
            <a class="flex items-center gap-3 p-3 hover:bg-[#243447] rounded-xl cursor-pointer">
                <i class="fa fa-users"></i> Data Mahasiswa
            </a>
            <a class="flex items-center gap-3 p-3 hover:bg-[#243447] rounded-xl cursor-pointer">
                <i class="fa fa-clock"></i> Aktivitas
            </a>
            <a class="flex items-center gap-3 p-3 hover:bg-[#243447] rounded-xl cursor-pointer">
                <i class="fa fa-chart-line"></i> Laporan
            </a>
            <a class="flex items-center gap-3 p-3 hover:bg-[#243447] rounded-xl cursor-pointer">
                <i class="fa fa-gear"></i> Pengaturan
            </a>
        </nav>

    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1">

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

            <!-- GRAFIK & CALENDAR -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">

                <!-- GRAFIK -->
                <div class="bg-white rounded-2xl p-6 shadow-lg col-span-2">
                    <h3 class="text-gray-600 font-bold">Grafik Aktivitas Mingguan</h3>
                    <canvas id="chartAktivitas" class="mt-6"></canvas>
                </div>

                <!-- CALENDAR -->
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

            <!-- AKTIVITAS TERBARU -->
            <div class="bg-white rounded-2xl p-6 shadow-lg mt-6">
                <h3 class="text-gray-700 font-bold mb-4">Aktivitas Mahasiswa Terbaru</h3>

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

</body>
</html>
