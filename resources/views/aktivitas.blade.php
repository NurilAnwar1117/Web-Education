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
                                <td class="px-3 py-2 text-[11px] text-gray-400 space-x-1">
                                    <form action="{{ route('aktivitas.destroy', $log->log_id) }}"
                                        method="POST"
                                        class="inline"
                                        onsubmit="return confirm('Yakin ingin menghapus catatan aktivitas ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            type="submit"
                                            class="px-2 py-1 rounded border border-red-300 text-red-600 hover:bg-red-50">
                                            Hapus
                                        </button>
                                    </form>
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

