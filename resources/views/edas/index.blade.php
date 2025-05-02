@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">

    <div class="mb-4">
        <h4 class="fw-bold text-primary text-center mb-2">
            <i class="bi bi-bar-chart-fill me-2"></i>Hasil Perhitungan Metode EDAS
        </h4>
        <p class="text-center text-muted">
            Jenis Analisis:
            <strong>({{ $jenis_analisis->nama ?? '' }})</strong>
        </p>
    </div>

    {{-- 1. Matriks Keputusan --}}
    <x-edas.table 
        title="📊 Matriks Keputusan" 
        :data="$data" 
        :kriterias="$kriterias" 
        :alternatifs="$alternatifs" />

    {{-- 2. Nilai Rata-rata --}}
    <div class="alert alert-info shadow-sm rounded-3">
        <strong><i class="bi bi-calculator me-2"></i>Nilai Rata-rata:</strong><br>
        @foreach ($rata2 as $code => $val)
            @php
                $kriteria = $kriterias->firstWhere('code', $code);
            @endphp
            {{ $kriteria ? $kriteria->nama_kriteria : 'Kriteria tidak ditemukan' }} ({{ $code }}) :
            {{ number_format($val, 3) }} &nbsp;&nbsp;
        @endforeach
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
    <div class="card mb-4 shadow-sm rounded-3">
        <div class="card-header bg-success text-white fw-semibold">
            <i class="bi bi-graph-up-arrow me-2"></i>SP, SN, NSP, NSN, Appraisal Score (AS)
        </div>
        <div class="card-body p-0">
            <table class="table table-hover table-bordered mb-0 align-middle text-center bg-white">
                <thead class="table-success">
                    <tr>
                        <th>Alternatif</th>
                        <th>SP</th>
                        <th>SN</th>
                        <th>NSP</th>
                        <th>NSN</th>
                        <th>AS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alternatifs as $alt)
                        @php $code = $alt->code; @endphp
                        <tr>
                            <td class="text-start">
                                <strong>{{ $code }}</strong><br>
                                <small class="text-muted">{{ $alt->nama_alternatif }}</small>
                            </td>
                            <td>{{ number_format($SP[$code] ?? 0, 3) }}</td>
                            <td>{{ number_format($SN[$code] ?? 0, 3) }}</td>
                            <td>{{ number_format($NSP[$code] ?? 0, 3) }}</td>
                            <td>{{ number_format($NSN[$code] ?? 0, 3) }}</td>
                            <td class="fw-bold text-primary">{{ number_format($AS[$code] ?? 0, 3) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- 7. Ranking --}}
    <div class="card shadow-sm rounded-3">
        <div class="card-header bg-dark text-white fw-semibold">
            <i class="bi bi-trophy-fill me-2"></i>Ranking Alternatif
        </div>
        <div class="card-body">
            <ol class="fs-5">
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
    <div class="mt-4 d-flex justify-content-end">
        <a href="{{ route('jenis-analisis.index') }}" class="btn btn-outline-secondary shadow-sm">
            <i class="bi bi-arrow-left-circle me-1"></i> Kembali ke Jenis Analisis
        </a>
    </div>
</div>
@endsection
