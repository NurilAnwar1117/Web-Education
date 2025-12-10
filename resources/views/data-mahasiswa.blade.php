@extends('layouts.main')

@section('title', 'Data Mahasiswa - Monitoring')

@section('content')
    <div class="glass rounded-2xl p-4 md:p-6 shadow-2xl">

        <h1 class="text-2xl font-bold text-white mb-5">Data Mahasiswa</h1>

        <div class="bg-white rounded-2xl p-6 shadow-lg">

            {{-- Header tabel + search + tombol --}}
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-4">
                <h2 class="text-lg font-semibold text-gray-700">Tabel Data Mahasiswa</h2>
                <div class="flex flex-col sm:flex-row gap-2 sm:items-center">
                    <input
                        type="text"
                        placeholder="Cari NIM / Nama"
                        class="border rounded-xl px-3 py-2 text-xs md:text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 w-full sm:w-52"
                    >
                    {{-- Tombol masih dummy, karena backend belum dibuat --}}
                    <button
                        type="button"
                        class="px-3 py-2 rounded-xl bg-gray-400 text-white text-xs md:text-sm opacity-70 cursor-not-allowed"
                    >
                        + Tambah Data
                    </button>
                </div>
            </div>

            {{-- Tabel data mahasiswa --}}
            <div class="overflow-x-auto">
                <table class="min-w-full text-xs md:text-sm">
                    <thead class="bg-gray-50 text-gray-600">
                        <tr>
                            <th class="px-3 py-2 text-left font-semibold">No</th>
                            <th class="px-3 py-2 text-left font-semibold">NIM</th>
                            <th class="px-3 py-2 text-left font-semibold">Nama</th>
                            <th class="px-3 py-2 text-left font-semibold">Program Studi</th>
                            <th class="px-3 py-2 text-left font-semibold">Fakultas</th>
                            <th class="px-3 py-2 text-left font-semibold">Tahun</th>
                            <th class="px-3 py-2 text-left font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="student-body" class="divide-y divide-gray-100">
                        @forelse ($mahasiswa ?? [] as $index => $m)
                            <tr class="hover:bg-gray-50">
                                <td class="px-3 py-2">{{ $index + 1 }}</td>
                                <td class="px-3 py-2">{{ $m->nim }}</td>
                                <td class="px-3 py-2">{{ $m->name }}</td>
                                <td class="px-3 py-2">{{ $m->program_study }}</td>
                                <td class="px-3 py-2">{{ $m->faculty }}</td>
                                <td class="px-3 py-2">{{ $m->year_entry}}</td>
                                <td class="px-3 py-2 text-[11px] text-gray-400">
                                    Detail / Edit / Hapus
                                    <span class="italic">(belum aktif)</span>
                                </td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
@section('scripts')
<script>
    // === DUMMY DATA STUDENTS ===
    const dummyStudents = [
        {
            student_id: 101,
            nim: "2141720001",
            name: "Ahmad Fauzan",
            program_study: "Teknik Informatika",
            faculty: "FT",
            year_entry: 2021
        },
        {
            student_id: 102,
            nim: "2141720002",
            name: "Siti Rahmawati",
            program_study: "Sistem Informasi",
            faculty: "FT",
            year_entry: 2020
        },
        {
            student_id: 103,
            nim: "2141720003",
            name: "Budi Prasetyo",
            program_study: "Manajemen",
            faculty: "FEB",
            year_entry: 2022
        },
        {
            student_id: 104,
            nim: "2141720004",
            name: "Maya Kartika",
            program_study: "Ilmu Komunikasi",
            faculty: "FISIP",
            year_entry: 2019
        }
    ];

    // === MASUKKAN DATA KE TABEL SECARA DINAMIS ===
    const tbody = document.querySelector("#student-body");

    dummyStudents.forEach((mhs, index) => {
        const tr = document.createElement("tr");
        tr.className = "hover:bg-gray-50";

        tr.innerHTML = `
            <td class="px-3 py-2">${index + 1}</td>
            <td class="px-3 py-2">${mhs.nim}</td>
            <td class="px-3 py-2">${mhs.name}</td>
            <td class="px-3 py-2">${mhs.program_study}</td>
            <td class="px-3 py-2">${mhs.faculty}</td>
            <td class="px-3 py-2">${mhs.year_entry}</td>
            <td class="px-3 py-2 text-[11px] text-gray-400">
                Detail / Edit / Hapus
            </td>
        `;

        tbody.appendChild(tr);
    });
</script>
@endsection

