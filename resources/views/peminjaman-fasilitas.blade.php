@extends('layouts.main')

@section('title', 'Peminjaman Fasilitas')

@section('content')
<div class="glass rounded-2xl p-4 md:p-6 shadow-2xl">

    <h1 class="text-2xl font-bold text-white mb-5">Data Peminjaman Fasilitas</h1>

    <div class="bg-white rounded-2xl p-6 shadow-lg">

        {{-- Header + Search --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-4">
            <h2 class="text-lg font-semibold text-gray-700">Tabel Peminjaman</h2>

            <div class="flex flex-col sm:flex-row gap-2 sm:items-center">
                <input type="text"
                       placeholder="Cari NIM / Nama / Fasilitas"
                       class="border rounded-xl px-3 py-2 text-xs md:text-sm
                              focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                              w-full sm:w-60">
            </div>
        </div>

        {{-- Tabel --}}
        <div class="overflow-x-auto">
            <table class="min-w-full text-xs md:text-sm">
                <thead class="bg-gray-50 text-gray-600">
                    <tr>
                        <th class="px-3 py-2 text-left font-semibold">No</th>
                        <th class="px-3 py-2 text-left font-semibold">Tanggal Pengajuan</th>
                        <th class="px-3 py-2 text-left font-semibold">NIM</th>
                        <th class="px-3 py-2 text-left font-semibold">Nama</th>
                        <th class="px-3 py-2 text-left font-semibold">Prodi</th>
                        <th class="px-3 py-2 text-left font-semibold">Fasilitas</th>
                        <th class="px-3 py-2 text-left font-semibold">Jumlah</th>
                        <th class="px-3 py-2 text-left font-semibold">Tgl Pinjam</th>
                        <th class="px-3 py-2 text-left font-semibold">Tgl Kembali</th>
                        <th class="px-3 py-2 text-left font-semibold">Status</th>
                        <th class="px-3 py-2 text-left font-semibold">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                    @forelse ($loans as $index => $loan)
                        <tr class="hover:bg-gray-50">
                            <td class="px-3 py-2">
                                {{ $index + 1 }}
                            </td>

                            <td class="px-3 py-2 text-xs">
                                {{ $loan->created_at?->format('d-m-Y H:i') ?? '-' }}
                            </td>

                            <td class="px-3 py-2">
                                {{ $loan->nim }}
                            </td>

                            <td class="px-3 py-2">
                                {{ $loan->name }}
                            </td>

                            <td class="px-3 py-2">
                                {{ $loan->program_study }}
                            </td>

                            <td class="px-3 py-2">
                                {{ ucfirst($loan->facility) }}
                            </td>

                            <td class="px-3 py-2">
                                {{ $loan->quantity }}
                            </td>

                            <td class="px-3 py-2 text-xs">
                                {{ $loan->date_start ? \Carbon\Carbon::parse($loan->date_start)->format('d-m-Y') : '-' }}
                            </td>

                            <td class="px-3 py-2 text-xs">
                                {{ $loan->date_end ? \Carbon\Carbon::parse($loan->date_end)->format('d-m-Y') : '-' }}
                            </td>

                            {{-- Status sebagai badge --}}
                            <td class="px-3 py-2">
                                @php
                                    $status = $loan->status ?? 'pending';
                                    $statusClass = match ($status) {
                                        'approved' => 'bg-green-100 text-green-700',
                                        'rejected' => 'bg-red-100 text-red-700',
                                        default     => 'bg-yellow-100 text-yellow-700',
                                    };
                                @endphp
                                <span class="inline-flex px-2 py-0.5 rounded-full text-[10px] {{ $statusClass }}">
                                    {{ ucfirst($status) }}
                                </span>
                            </td>

                            {{-- Aksi (belum ada fungsi, hanya placeholder) --}}
                            <td class="px-3 py-2 text-[11px] space-x-1">
                                 {{-- (opsional) Hapus total --}}
                                <form action="{{ route('peminjaman.destroy', $loan->id) }}"
                                    method="POST"
                                    class="inline"
                                    onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        type="submit"
                                        class="px-2 py-1 rounded border text-red-500 border-red-300 hover:bg-red-50 mb-1 inline-block">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="px-3 py-4 text-center text-gray-500 text-sm">
                                Belum ada pengajuan peminjaman fasilitas.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
