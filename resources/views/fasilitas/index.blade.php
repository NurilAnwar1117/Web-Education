@extends('layouts.main')

@section('title', 'Daftar Fasilitas')

@section('content')
<div class="glass rounded-2xl p-6 shadow-2xl text-white">
    
    <h1 class="text-2xl font-bold mb-4">Daftar Fasilitas</h1>

    <div class="bg-white p-5 rounded-xl shadow-lg text-gray-700">
        <table class="w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3">#</th>
                    <th class="p-3">Nama Fasilitas</th>
                    <th class="p-3">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($fasilitas as $i => $f)
                <tr class="border-b">
                    <td class="p-3 text-center">{{ $i + 1 }}</td>
                    <td class="p-3 text-center">{{ $f->facility_name }}</td>
                    <td class="p-3 text-center">
                        <a href="{{ route('fasilitas.show', $f->facility_id) }}"
                           class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                           Lihat Laporan
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
