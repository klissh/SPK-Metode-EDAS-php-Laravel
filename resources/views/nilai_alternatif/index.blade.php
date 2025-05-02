@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <div class="mb-4">
        <h4 class="fw-bold text-primary text-center">
            <i class="bi bi-pencil-square me-2"></i>Nilai Alternatif
        </h4>
        <p class="text-center text-muted">
            Jenis Analisis:
            <strong>({{ $jenis_analisis->nama ?? '' }})</strong>
        </p>
    </div>

    {{-- Notifikasi Sukses --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm text-center" role="alert" id="successAlert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    @endif

    {{-- Form Penilaian --}}
    <form action="{{ route('nilai.store') }}" method="POST">
        @csrf

        <div class="table-responsive shadow-sm rounded-3">
            <table class="table table-bordered align-middle text-center bg-white">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Alternatif</th>
                        @foreach ($kriterias as $kriteria)
                            <th>{{ $kriteria->nama_kriteria }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alternatifs as $i => $alt)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $alt->nama_alternatif }}</td>
                            @foreach ($kriterias as $kriteria)
                                <td>
                                    <select name="nilai[{{ $alt->id }}][{{ $kriteria->id }}]" class="form-select" required>
                                        <option disabled {{ !isset($nilai_terisi[$alt->id][$kriteria->id]) ? 'selected' : '' }}>-- Pilih --</option>
                                        @foreach ($kriteria->subKriterias as $sub)
                                            <option value="{{ $sub->id }}"
                                                {{ (isset($nilai_terisi[$alt->id][$kriteria->id]) && $nilai_terisi[$alt->id][$kriteria->id][0]->sub_kriteria_id == $sub->id) ? 'selected' : '' }}>
                                                {{ $sub->nama_sub }}
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

        {{-- Tombol Simpan dan Kembali --}}
        <div class="d-flex justify-content-between align-items-center mt-4">
            <button type="submit" class="btn btn-primary px-5 shadow-sm">
                <i class="bi bi-save me-1"></i> Simpan
            </button>
            <a href="{{ route('jenis-analisis.index') }}" class="btn btn-outline-secondary shadow-sm">
                <i class="bi bi-arrow-left-circle me-1"></i> Kembali ke Jenis Analisis
            </a>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const alert = document.getElementById('successAlert');
        if (alert) {
            setTimeout(() => {
                if (window.bootstrap && bootstrap.Alert) {
                    const bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
                    bsAlert.close();
                } else {
                    alert.classList.remove('show');
                    alert.classList.add('fade');
                    setTimeout(() => alert.remove(), 300);
                }
            }, 5000);
        }
    });
</script>
@endpush
