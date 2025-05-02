@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <div class="mb-4">
        <h4 class="fw-bold text-info">
            <i class="bi bi-list-ul me-2"></i>Sub Kriteria untuk:
            <span class="text-dark">{{ $kriteria->nama_kriteria }} ({{ $kriteria->code }})</span>
        </h4>
    </div>

    {{-- Notifikasi Sukses --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert" id="successAlert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    @endif

    {{-- Tombol tambah --}}
    <div class="mb-3 d-flex justify-content-between">
        <a href="{{ route('sub-kriteria.create', ['kriteria_id' => $kriteria->id]) }}" class="btn btn-primary shadow-sm">
            <i class="bi bi-plus-circle me-1"></i> Tambah Sub Kriteria
        </a>
        <a href="{{ route('kriteria.index') }}" class="btn btn-outline-secondary shadow-sm">
            <i class="bi bi-arrow-left-circle me-1"></i> Kembali ke Kriteria
        </a>
    </div>

    {{-- Tabel --}}
    <div class="table-responsive rounded-3 shadow-sm">
        <table class="table table-hover align-middle table-bordered mb-0 bg-white">
            <thead class="table-info text-center">
                <tr>
                    <th>No</th>
                    <th>Nama Sub</th>
                    <th>Nilai</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($subkriterias as $sub)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $sub->nama_sub }}</td>
                        <td class="text-center">{{ $sub->nilai }}</td>
                        <td class="text-center">
                            <button type="button" class="btn btn-sm btn-danger shadow-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalHapus{{ $sub->id }}">
                                <i class="bi bi-trash3-fill"></i>
                            </button>
                        </td>
                    </tr>

                    {{-- Modal Konfirmasi Hapus --}}
                    <div class="modal fade" id="modalHapus{{ $sub->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $sub->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content shadow rounded-4">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title" id="modalLabel{{ $sub->id }}">
                                        <i class="bi bi-exclamation-circle-fill me-2"></i> Konfirmasi Hapus
                                    </h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                </div>
                                <div class="modal-body">
                                    <p class="mb-0">Yakin ingin menghapus sub kriteria <strong>{{ $sub->nama_sub }}</strong>?</p>
                                </div>
                                <div class="modal-footer">
                                    <form action="{{ route('sub-kriteria.destroy', $sub->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">Belum ada sub kriteria</td>
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
