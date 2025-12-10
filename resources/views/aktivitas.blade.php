@extends('layouts.main')

@section('title', 'Aktivitas Mahasiswa')

@section('content')
    <div class="glass rounded-2xl p-4 md:p-6 shadow-2xl">

        <h1 class="text-2xl font-bold text-white mb-5">Aktivitas Mahasiswa</h1>

        <div class="bg-white rounded-2xl p-6 shadow-lg">

            {{-- Header tabel + search --}}
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-4">
                <h2 class="text-lg font-semibold text-gray-700">Catatan Aktivitas Mahasiswa</h2>

                <div class="flex flex-col sm:flex-row gap-2 sm:items-center">
                    <input
                        type="text"
                        placeholder="Cari NIM / Nama / Aktivitas"
                        class="border rounded-xl px-3 py-2 text-xs md:text-sm focus:ring-2 focus:ring-blue-500 
                               focus:border-blue-500 w-full sm:w-60"
                    >
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full text-xs md:text-sm">
                    <thead class="bg-gray-50 text-gray-600">
                        <tr>
                            <th class="px-3 py-2 text-left font-semibold">No</th>
                            <th class="px-3 py-2 text-left font-semibold">Mahasiswa (ID)</th>
                            <th class="px-3 py-2 text-left font-semibold">Fasilitas (ID)</th>
                            <th class="px-3 py-2 text-left font-semibold">Jenis Aktivitas</th>
                            <th class="px-3 py-2 text-left font-semibold">Waktu Masuk</th>
                            <th class="px-3 py-2 text-left font-semibold">Waktu Keluar</th>
                            <th class="px-3 py-2 text-left font-semibold">Durasi (menit)</th>
                            <th class="px-3 py-2 text-left font-semibold">Aksi</th>
                        </tr>
                    </thead>

                    <tbody id="activity-body" class="divide-y divide-gray-100"></tbody>

                        @forelse ($logs ?? [] as $index => $log)
                            <tr class="hover:bg-gray-50">
                                <td class="px-3 py-2">{{ $index + 1 }}</td>

                                {{-- Student ID --}}
                                <td class="px-3 py-2">
                                    {{ $log->student_id }}
                                </td>

                                {{-- Facility ID --}}
                                <td class="px-3 py-2">
                                    {{ $log->facility_id }}
                                </td>

                                {{-- Jenis Aktivitas --}}
                                <td class="px-3 py-2 capitalize">
                                    {{ $log->activity_type }}
                                </td>

                                {{-- Waktu masuk --}}
                                <td class="px-3 py-2">
                                    {{ $log->timestamp_in ?? '-' }}
                                </td>

                                {{-- Waktu keluar --}}
                                <td class="px-3 py-2">
                                    {{ $log->timestamp_out ?? '-' }}
                                </td>

                                {{-- Durasi --}}
                                <td class="px-3 py-2">
                                    {{ $log->duration ?? '-' }}
                                </td>

                                {{-- Aksi --}}
                                <td class="px-3 py-2 text-[11px] text-gray-400">
                                    Detail / Edit / Hapus
                                </td>
                            </tr>
                        @empty

                            <tr>
                                <td colspan="8" class="px-3 py-4 text-center text-gray-500 text-sm">
                                    Belum ada catatan aktivitas mahasiswa.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
@section('scripts')
<script>
    // === DUMMY DATA ACTIVITY LOGS ===
    const dummyLogs = [
        {
            log_id: 1,
            student_id: 101,
            facility_id: 1,
            activity_type: "masuk",
            timestamp_in: "2025-02-28 08:00:00",
            timestamp_out: "2025-02-28 09:30:00",
            duration: 90
        },
        {
            log_id: 2,
            student_id: 102,
            facility_id: 2,
            activity_type: "menggunakan",
            timestamp_in: "2025-02-28 10:00:00",
            timestamp_out: null,
            duration: null
        },
        {
            log_id: 3,
            student_id: 103,
            facility_id: 1,
            activity_type: "keluar",
            timestamp_in: "2025-02-27 14:00:00",
            timestamp_out: "2025-02-27 16:45:00",
            duration: 165
        }
    ];

    // === MASUKKAN DATA KE TABEL SECARA DINAMIS ===
    const tbody = document.querySelector("#activity-body");

    dummyLogs.forEach((log, index) => {
        const tr = document.createElement("tr");
        tr.className = "hover:bg-gray-50";

        tr.innerHTML = `
            <td class="px-3 py-2">${index + 1}</td>
            <td class="px-3 py-2">${log.student_id}</td>
            <td class="px-3 py-2">${log.facility_id}</td>
            <td class="px-3 py-2 capitalize">${log.activity_type}</td>
            <td class="px-3 py-2">${log.timestamp_in ?? "-"}</td>
            <td class="px-3 py-2">${log.timestamp_out ?? "-"}</td>
            <td class="px-3 py-2">${log.duration ?? "-"}</td>
            <td class="px-3 py-2 text-[11px] text-gray-400">Detail / Edit / Hapus</td>
        `;

        tbody.appendChild(tr);
    });
</script>
@endsection
