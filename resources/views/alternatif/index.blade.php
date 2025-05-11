@extends('layouts.app')

@section('content')
<div class="space-y-6">

    {{-- Heading --}}
    <div>
        <h2 class="text-2xl font-semibold text-slate-800 flex items-center gap-2">
            <i class="bi bi-calculator-fill text-emerald-500"></i> Data Alternatif
        </h2>
        <p class="text-gray-600 mt-1">
            Jenis Analisis: <span class="ml-2 inline-block text-sm font-bold text-emerald-700 bg-emerald-100 px-3 py-1 rounded-xl shadow"> ({{ $jenis_analisis->nama ?? '' }}) </span>
        </p>
    </div>

    {{-- Notifikasi Sukses --}}
    @if(session('success'))
        <div id="successAlert"
           class="bg-emerald-100 border border-emerald-300 text-emerald-800 px-4 py-3 rounded relative shadow transition-opacity"
           role="alert">
          <strong class="font-bold">Berhasil!</strong> <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif



    {{-- Notifikasi Error --}}
    @if($errors->any())
        <div class="bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded shadow relative">
            <strong class="font-bold">Terjadi kesalahan:</strong>
            <ul class="list-disc pl-6 mt-2 text-sm">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Tombol --}}
    <div class="flex justify-between gap-3 flex-wrap">
        <a href="{{ route('alternatif.create') }}"
           class="bg-emerald-500 hover:bg-emerald-600 text-white font-semibold py-2 px-4 rounded-lg shadow transition">
            <i class="bi bi-plus-circle me-1"></i> Tambah Alternatif
        </a>
        <a href="{{ route('jenis-analisis.index') }}"
           class="bg-gray-200 hover:bg-gray-300 text-slate-700 font-semibold py-2 px-4 rounded-lg transition">
            <i class="bi bi-arrow-left-circle me-1"></i> Kembali ke Jenis Analisis
        </a>
    </div>

    {{-- Tabel --}}
    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full text-sm text-left text-slate-600">
            <thead class="bg-emerald-100 text-emerald-700 uppercase text-xs">
                <tr>
                    <th class="px-6 py-3 text-center">No</th>
                    <th class="px-6 py-3 text-center">Kode</th>
                    <th class="px-6 py-3">Nama Alternatif</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($alternatifs as $alt)
                    <tr class="border-t hover:bg-slate-50">
                        <td class="px-6 py-4 text-center">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 text-center">{{ $alt->code }}</td>
                        <td class="px-6 py-4">{{ $alt->nama_alternatif }}</td>
                        <td class="px-6 py-4 text-center space-x-2">
                            <a href="{{ route('alternatif.edit', $alt->id) }}"
                               class="inline-flex items-center gap-1 px-3 py-1 bg-yellow-400 hover:bg-yellow-500 text-white text-xs font-semibold rounded shadow transition">
                                <i class="bi bi-pencil-fill"></i> Edit
                            </a>
                            <button type="button"
                                    onclick="document.getElementById('modalHapus{{ $alt->id }}').showModal();"
                                    class="inline-flex items-center gap-1 px-3 py-1 bg-red-600 hover:bg-red-700 text-white text-xs font-semibold rounded shadow transition">
                                    <i class="bi bi-trash-fill"></i> Hapus
                            </button>
                        </td>
                    </tr>

                    {{-- Modal konfirmasi --}}
                    <dialog id="modalHapus{{ $alt->id }}" class="rounded-xl p-0 backdrop:bg-black/50 w-full max-w-md">
                        <div class="bg-white rounded-xl shadow-lg">
                            <div class="bg-red-600 text-white px-6 py-3 rounded-t-xl flex justify-between items-center">
                                <h3 class="text-lg font-semibold">
                                    <i class="bi bi-exclamation-circle-fill me-2"></i> Konfirmasi Hapus
                                </h3>
                                <form method="dialog">
                                    <button type="submit" class="text-white text-2xl leading-none">&times;</button>
                                </form>
                            </div>
                            <div class="px-6 py-4">
                                <p class="text-sm text-slate-700">
                                    Yakin ingin menghapus <strong>{{ $alt->nama_alternatif }}</strong>?
                                </p>
                            </div>
                            <div class="px-6 py-4 flex justify-end gap-2 border-t">
                                <form method="POST" action="{{ route('alternatif.destroy', $alt->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="bg-red-600 hover:bg-red-700 text-white font-semibold px-4 py-2 rounded transition">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                                <form method="dialog">
                                    <button class="bg-gray-200 hover:bg-gray-300 text-slate-700 font-semibold px-4 py-2 rounded transition">
                                        Batal
                                    </button>
                                </form>
                            </div>
                        </div>
                    </dialog>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">Belum ada alternatif.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const alert = document.getElementById('successAlert');
        console.log("Script jalan, alert =", alert); // Tambahan log

        if (alert) {
            setTimeout(() => {
                console.log("Success alert fade-out triggered");
                alert.classList.add('animate-fade-out');
                setTimeout(() => alert.remove(), 800);
            }, 5000);
        } else {
            console.log("Element #successAlert TIDAK ditemukan!");
        }
    });
</script>
@endpush






