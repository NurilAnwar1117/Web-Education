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
                        </tr>
                    </thead>

                    <tbody id="activity-body" class="divide-y divide-gray-100"></tbody>
                        @foreach ($logs as $i => $log)
                            <tr class="hover:bg-gray-50">
                                <td class="px-3 py-2">{{ $i + 1 }}</td>

                                <td class="px-3 py-2">
                                    {{ $log->student->nim ?? '-' }}
                                </td>

                                <td class="px-3 py-2">
                                    {{ $log->facility->facility_name ?? '-' }}
                                </td>

                                <td class="px-3 py-2">{{ $log->activity_type }}</td>

                                <td class="px-3 py-2">{{ $log->timestamp_in }}</td>

                                <td class="px-3 py-2">{{ $log->timestamp_out ?? '-' }}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
