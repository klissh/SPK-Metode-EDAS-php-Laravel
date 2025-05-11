@extends('layouts.app')

@section('content')
<div class="space-y-6">

    {{-- Heading --}}
    <div class="text-center">
        <h2 class="text-2xl font-semibold text-blue-600 flex justify-center items-center gap-2">
            <i class="bi bi-bar-chart-fill"></i> Hasil Perhitungan Metode EDAS
        </h2>
        <p class="text-gray-500">
            Jenis Analisis: <span class="ml-2 inline-block text-sm font-bold text-blue-600 bg-blue-100 px-3 py-1 rounded-xl shadow"> ({{ $jenis_analisis->nama ?? '' }}) </span>
        </p>
    </div>

    {{-- 1. Matriks Keputusan --}}
    <x-edas.table 
        title="📊 Matriks Keputusan" 
        :data="$data" 
        :kriterias="$kriterias" 
        :alternatifs="$alternatifs" />

    {{-- 2. Nilai Rata-rata --}}
    <div class="bg-blue-50 border border-blue-200 text-blue-800 px-6 py-4 rounded-xl shadow">
        <h3 class="font-semibold mb-2 flex items-center gap-2">
            <i class="bi bi-calculator"></i> Nilai Rata-rata:
        </h3>
        <div class="flex flex-wrap gap-4">
            @foreach ($rata2 as $code => $val)
                @php
                    $kriteria = $kriterias->firstWhere('code', $code);
                @endphp
                <span>
                    {{ $kriteria ? $kriteria->nama_kriteria : 'Kriteria tidak ditemukan' }} ({{ $code }}):
                    <strong>{{ number_format($val, 3) }}</strong>
                </span>
            @endforeach
        </div>
    </div>

    {{-- 3. PDA --}}
    <x-edas.table 
        title="🟢 PDA (Positive Distance from Average)" 
        :data="$pda" 
        :kriterias="$kriterias" 
        :alternatifs="$alternatifs" />

    {{-- 4. NDA --}}
    <x-edas.table 
        title="🔴 NDA (Negative Distance from Average)" 
        :data="$nda" 
        :kriterias="$kriterias" 
        :alternatifs="$alternatifs" />

    {{-- 5-6. Nilai SP, SN, NSP, NSN, AS --}}
    <div class="bg-white rounded-xl shadow">
        <div class="bg-green-600 text-white px-6 py-3 rounded-t-xl font-semibold flex items-center gap-2">
            <i class="bi bi-graph-up-arrow"></i> SP, SN, NSP, NSN, Appraisal Score (AS)
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-center bg-white">
                <thead class="bg-green-100 text-green-800 uppercase text-xs">
                    <tr>
                        <th class="px-4 py-2">Alternatif</th>
                        <th class="px-4 py-2">SP</th>
                        <th class="px-4 py-2">SN</th>
                        <th class="px-4 py-2">NSP</th>
                        <th class="px-4 py-2">NSN</th>
                        <th class="px-4 py-2">AS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alternatifs as $alt)
                        @php $code = $alt->code; @endphp
                        <tr class="border-t hover:bg-slate-50">
                            <td class="text-left px-4 py-2">
                                <strong>{{ $code }}</strong><br>
                                <span class="text-sm text-gray-500">{{ $alt->nama_alternatif }}</span>
                            </td>
                            <td class="px-4 py-2">{{ number_format($SP[$code] ?? 0, 3) }}</td>
                            <td class="px-4 py-2">{{ number_format($SN[$code] ?? 0, 3) }}</td>
                            <td class="px-4 py-2">{{ number_format($NSP[$code] ?? 0, 3) }}</td>
                            <td class="px-4 py-2">{{ number_format($NSN[$code] ?? 0, 3) }}</td>
                            <td class="px-4 py-2 font-bold text-blue-600">{{ number_format($AS[$code] ?? 0, 3) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- 7. Ranking --}}
    <div class="bg-white rounded-xl shadow">
        <div class="bg-gray-800 text-white px-6 py-3 rounded-t-xl font-semibold flex items-center gap-2">
            <i class="bi bi-trophy-fill"></i> Ranking Alternatif
        </div>
        <div class="px-6 py-4">
            <ol class="list-decimal list-inside text-slate-700 space-y-1 text-base">
                @foreach ($ranking as $alt)
                    <li>
                        <strong>{{ $alt['kode'] }} - {{ $alt['nama'] }}</strong>
                        (Skor: {{ number_format($alt['as'], 3) }})
                    </li>
                @endforeach
            </ol>
        </div>
    </div>

    {{-- Tombol Kembali --}}
    <div class="flex justify-end pt-4">
        <a href="{{ route('jenis-analisis.index') }}"
           class="bg-gray-200 hover:bg-gray-300 text-slate-700 font-semibold px-6 py-2 rounded-lg shadow flex items-center gap-2 transition">
            <i class="bi bi-arrow-left-circle"></i> Kembali ke Jenis Analisis
        </a>
    </div>
</div>
@endsection
