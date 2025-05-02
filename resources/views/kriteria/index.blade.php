@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <div class="mb-4">
        <h4 class="fw-bold text-primary">
            <i class="bi bi-sliders2-vertical me-2"></i>Data Kriteria
        </h4>
        <p class="text-muted">
            Jenis Analisis:
            <strong>({{ $jenis_analisis->nama ?? '' }})</strong>
            
        </p>
    </div>

    {{-- Notifikasi Sukses --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert" id="successAlert">
            <i class="bi bi-check-circle-fill me-2"></i>
            <strong>Berhasil!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    @endif

    {{-- Notifikasi Error --}}
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            <strong>Terjadi kesalahan:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    @endif

    {{-- Tombol Aksi --}}
    <div class="mb-3 d-flex justify-content-between">
        <a href="{{ route('kriteria.create') }}" class="btn btn-primary shadow-sm">
            <i class="bi bi-plus-circle me-1"></i> Tambah Kriteria
        </a>
        <a href="{{ route('jenis-analisis.index') }}" class="btn btn-outline-secondary shadow-sm">
            <i class="bi bi-arrow-left-circle me-1"></i> Kembali ke Jenis Analisis
        </a>
    </div>

    <div class="table-responsive rounded-3 shadow-sm">
        <table class="table table-hover align-middle table-bordered mb-0 bg-white">
            <thead class="table-primary text-center">
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Nama Kriteria</th>
                    <th>Tipe</th>
                    <th>Bobot</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            @foreach($kriterias as $kriteria)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-center">{{ $kriteria->code }}</td>
                    <td>{{ $kriteria->nama_kriteria }}</td>
                    <td class="text-center">{{ ucfirst($kriteria->tipe) }}</td>
                    <td class="text-center">{{ $kriteria->bobot * 100 }}%</td>
                    <td class="text-center">
                        <a href="{{ route('sub-kriteria.index', ['kriteria_id' => $kriteria->id]) }}" class="btn btn-info btn-sm me-1 shadow-sm">
                            <i class="bi bi-list-ul"></i>
                        </a>
                        <a href="{{ route('kriteria.edit', $kriteria->id) }}" class="btn btn-warning btn-sm me-1 shadow-sm">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <button type="button" class="btn btn-danger btn-sm shadow-sm" data-bs-toggle="modal" data-bs-target="#modalHapus{{ $kriteria->id }}">
                            <i class="bi bi-trash3-fill"></i>
                        </button>
                    </td>
                </tr>

                {{-- Modal Konfirmasi Hapus --}}
                <div class="modal fade" id="modalHapus{{ $kriteria->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $kriteria->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content shadow rounded-4">
                            <div class="modal-header bg-danger text-white">
                                <h5 class="modal-title" id="modalLabel{{ $kriteria->id }}">
                                    <i class="bi bi-exclamation-circle-fill me-2"></i> Konfirmasi Hapus
                                </h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
                            </div>
                            <div class="modal-body">
                                <p class="mb-0">Yakin ingin menghapus kriteria <strong>{{ $kriteria->nama_kriteria }}</strong>?</p>
                            </div>
                            <div class="modal-footer">
                                <form action="{{ route('kriteria.destroy', $kriteria->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i> Hapus</button>
                                </form>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            </tbody>
        </table>
    </div>
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
