@extends('layouts.app')

@section('content')
<div class="space-y-6">

    {{-- Heading --}}
    <div class="text-center">
        <h2 class="text-2xl font-semibold text-blue-600 flex justify-center items-center gap-2">
            <i class="bi bi-pencil-square"></i> Nilai Alternatif
        </h2>
        <p class="text-gray-500 mt-1">
            Jenis Analisis:
            <span class="ml-2 inline-block text-sm font-bold text-blue-800 bg-blue-100 px-3 py-1 rounded-xl shadow"> ({{ $jenis_analisis->nama ?? '' }}) </span>
        </p>
    </div>

    {{-- Notifikasi Sukses --}}
    @if(session('success'))
        <div class="bg-emerald-100 border border-emerald-300 text-emerald-800 px-4 py-3 rounded relative shadow text-center" id="successAlert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
        </div>
    @endif

    {{-- Form Penilaian --}}
    <form action="{{ route('nilai.store') }}" method="POST">
        @csrf

        {{-- Tabel --}}
        <div class="overflow-x-auto bg-white rounded-xl shadow">
            <table class="min-w-full text-sm text-center text-slate-700">
                <thead class="bg-blue-100 uppercase text-xs text-blue-800 ">
                    <tr>
                        <th class="px-4 py-3">No</th>
                        <th class="px-4 py-3">Nama Alternatif</th>
                        @foreach ($kriterias as $kriteria)
                            <th class="px-4 py-3">{{ $kriteria->nama_kriteria }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alternatifs as $i => $alt)
                        <tr class="border-t hover:bg-slate-50">
                            <td class="px-4 py-3">{{ $i + 1 }}</td>
                            <td class="px-4 py-3 text-left">{{ $alt->nama_alternatif }}</td>
                            @foreach ($kriterias as $kriteria)
                                <td class="px-4 py-2">
                                    <select name="nilai[{{ $alt->id }}][{{ $kriteria->id }}]"
                                            class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none"
                                            required>
                                        <option disabled {{ !isset($nilai_terisi[$alt->id][$kriteria->id]) ? 'selected' : '' }}>
                                            -- Pilih --
                                        </option>
                                        @foreach ($kriteria->subKriterias as $sub)
                                            <option value="{{ $sub->id }}"
                                                {{ (isset($nilai_terisi[$alt->id][$kriteria->id]) && $nilai_terisi[$alt->id][$kriteria->id][0]->sub_kriteria_id == $sub->id) ? 'selected' : '' }}>
                                                {{ $sub->nama_sub }} ({{ $sub->nilai }})
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Tombol --}}
        <div class="flex justify-between items-center mt-6">
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg shadow flex items-center gap-2 transition">
                <i class="bi bi-save"></i> Simpan
            </button>
            <a href="{{ route('jenis-analisis.index') }}"
               class="bg-gray-200 hover:bg-gray-300 text-slate-700 font-semibold px-6 py-2 rounded-lg shadow flex items-center gap-2 transition">
                <i class="bi bi-arrow-left-circle"></i> Kembali ke Jenis Analisis
            </a>
        </div>
    </form>
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
