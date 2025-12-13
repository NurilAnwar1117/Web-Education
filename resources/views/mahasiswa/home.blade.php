@extends('layouts.mahasiswa')

@section('title', 'Portal Mahasiswa')

@section('content')
<div class="glass rounded-2xl p-4 md:p-6 shadow-2xl">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-4">
        <div>
            <h2 class="text-xl font-bold text-white">Aktivitas Fasilitas</h2>
            <p class="text-[11px] md:text-xs text-blue-100">
                Mulai aktivitas akan mengisi waktu masuk otomatis. Selesai aktivitas akan mengisi waktu keluar otomatis.
            </p>
        </div>
    </div>

    <div class="bg-white rounded-2xl p-6 shadow-lg">

        {{-- Flash message --}}
        @if (session('success'))
            <div class="mb-4 px-4 py-2 rounded-xl bg-green-50 border border-green-200 text-xs md:text-sm text-green-700">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-4 px-4 py-2 rounded-xl bg-red-50 border border-red-200 text-xs md:text-sm text-red-700">
                {{ session('error') }}
            </div>
        @endif

        {{-- Info identitas --}}
        <div class="mb-5 p-3 bg-blue-50 border border-blue-200 rounded-xl text-xs md:text-sm text-gray-700">
            Anda login sebagai:
            <span class="font-semibold">{{ session('student_name', 'Mahasiswa') }}</span>
            (NIM: {{ session('student_nim', '-') }})
        </div>

        {{-- PANEL AKTIVITAS BERJALAN --}}
        @if(!empty($activeLog))
            <div class="mb-6 p-4 rounded-2xl border border-amber-200 bg-amber-50">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                    <div class="text-xs md:text-sm text-gray-700">
                        <div class="font-semibold text-gray-900">Aktivitas sedang berjalan</div>
                        <div class="mt-1">
                            <span class="font-medium">Fasilitas:</span>
                            {{ $activeLog->facility->facility_name ?? '—' }}
                            ({{ $activeLog->facility->location ?? '—' }})
                        </div>
                        <div>
                            <span class="font-medium">Jenis Aktivitas:</span>
                            {{ $activeLog->activity_type }}
                        </div>
                        <div>
                            <span class="font-medium">Waktu Masuk:</span>
                            {{ \Carbon\Carbon::parse($activeLog->timestamp_in)->format('d-m-Y H:i:s') }}
                        </div>
                        <div class="text-[11px] text-gray-500 mt-1">
                            *Waktu keluar akan terisi saat klik “Selesai Aktivitas”.
                        </div>
                    </div>

                    <form action="{{ route('mahasiswa.peminjaman.finish') }}" method="POST">
                        @csrf
                        <button type="submit"
                                class="px-4 py-2 rounded-xl bg-emerald-600 text-white text-xs md:text-sm hover:bg-emerald-700">
                            Selesai Aktivitas
                        </button>
                    </form>
                </div>
            </div>
        @endif

        {{-- FORM MULAI AKTIVITAS (DISABLE JIKA ADA AKTIF) --}}
        <form action="{{ route('mahasiswa.peminjaman.store') }}" method="POST" class="space-y-5">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                {{-- Fasilitas --}}
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">
                        Fasilitas yang Digunakan
                    </label>
                    <select name="facility_id"
                            {{ !empty($activeLog) ? 'disabled' : '' }}
                            class="w-full border rounded-xl px-3 py-2 text-xs md:text-sm focus:ring-2
                                   focus:ring-blue-500 focus:border-blue-500">
                        <option value="">-- Pilih Fasilitas --</option>
                        @foreach($facilities as $f)
                            <option value="{{ $f->facility_id }}" {{ old('facility_id') == $f->facility_id ? 'selected' : '' }}>
                                {{ $f->facility_name }} ({{ $f->location }})
                            </option>
                        @endforeach
                    </select>
                    @error('facility_id')
                        <p class="text-[11px] text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                    @if(!empty($activeLog))
                        <p class="text-[11px] text-amber-700 mt-1">Tidak bisa mulai aktivitas baru sebelum menyelesaikan aktivitas yang berjalan.</p>
                    @endif
                </div>

                {{-- Jenis aktivitas --}}
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">
                        Jenis Aktivitas
                    </label>
                    <input type="text"
                           name="activity_type"
                           value="{{ old('activity_type') }}"
                           {{ !empty($activeLog) ? 'disabled' : '' }}
                           maxlength="255"
                           placeholder="Contoh: Membaca buku referensi / Praktikum / Rapat organisasi"
                           class="w-full border rounded-xl px-3 py-2 text-xs md:text-sm focus:ring-2
                                  focus:ring-blue-500 focus:border-blue-500">
                    @error('activity_type')
                        <p class="text-[11px] text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Tombol --}}
            <div class="flex justify-end gap-3 pt-3">
                <button type="reset"
                        {{ !empty($activeLog) ? 'disabled' : '' }}
                        class="px-4 py-2 rounded-xl border text-xs md:text-sm text-gray-600 hover:bg-gray-100 disabled:opacity-50">
                    Reset
                </button>
                <button type="submit"
                        {{ !empty($activeLog) ? 'disabled' : '' }}
                        class="px-4 py-2 rounded-xl bg-blue-600 text-white text-xs md:text-sm hover:bg-blue-700 disabled:opacity-50">
                    Mulai Aktivitas
                </button>
            </div>
        </form>

    </div>
</div>
@endsection
