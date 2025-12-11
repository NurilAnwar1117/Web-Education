@extends('layouts.mahasiswa')

@section('title', 'Portal Mahasiswa')

@section('content')
    <div class="glass rounded-2xl p-4 md:p-6 shadow-2xl">

        {{-- Header --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-4">
            <div>
                <h2 class="text-xl font-bold text-white">Mulai Aktivitas Fasilitas</h2>
                <p class="text-[11px] md:text-xs text-blue-100">
                    Pilih fasilitas yang sedang kamu gunakan, sistem akan mencatat waktu mulai otomatis.
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

            {{-- Info identitas otomatis --}}
            <div class="mb-5 p-3 bg-blue-50 border border-blue-200 rounded-xl text-xs md:text-sm text-gray-700">
                Anda login sebagai:
                <span class="font-semibold">
                    {{ auth()->user()->name ?? 'Mahasiswa' }}
                </span>
                @if (auth()->user()->nim ?? false)
                    (NIM: {{ auth()->user()->nim }})
                @endif
            </div>

            {{-- FORM MULAI AKTIVITAS --}}
           <form action="{{ route('mahasiswa.peminjaman.store') }}" method="POST" class="space-y-5">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Pilih fasilitas --}}
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1">
                            Fasilitas yang Digunakan
                        </label>
                        <select name="facility_id"
                                class="w-full border rounded-xl px-3 py-2 text-xs md:text-sm focus:ring-2
                                       focus:ring-blue-500 focus:border-blue-500">
                            <option value="">-- Pilih Fasilitas --</option>
                            @foreach($facilities as $f)
                                <option value="{{ $f->facility_id }}">
                                    {{ $f->facility_name }} ({{ $f->location }})
                                </option>
                            @endforeach
                        </select>
                        @error('facility_id')
                            <p class="text-[11px] text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Jenis aktivitas --}}
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1">
                            Jenis Aktivitas
                        </label>
                        <select name="activity_type"
                                class="w-full border rounded-xl px-3 py-2 text-xs md:text-sm focus:ring-2
                                       focus:ring-blue-500 focus:border-blue-500">
                            <option value="using">Menggunakan</option>
                            <option value="masuk">Masuk</option>
                            <option value="keluar">Keluar</option>
                        </select>
                        @error('activity_type')
                            <p class="text-[11px] text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Keperluan (opsional, kalau kamu mau simpan di kolom lain nanti) --}}
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Keperluan (opsional)</label>
                    <textarea name="purpose" rows="3"
                              class="w-full border rounded-xl px-3 py-2 text-xs md:text-sm focus:ring-2
                                     focus:ring-blue-500 focus:border-blue-500"
                              placeholder="Contoh: praktikum, rapat organisasi, dll."></textarea>
                </div>

                {{-- Tombol --}}
                <div class="flex justify-end gap-3 pt-3">
                    <button type="reset"
                            class="px-4 py-2 rounded-xl border text-xs md:text-sm text-gray-600 hover:bg-gray-100">
                        Reset
                    </button>
                    <button type="submit"
                            class="px-4 py-2 rounded-xl bg-blue-600 text-white text-xs md:text-sm hover:bg-blue-700">
                        Mulai Aktivitas
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
