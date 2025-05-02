@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <div class="card shadow rounded-4 border-0">
        <div class="card-body p-5">
            <h4 class="mb-4 fw-bold text-success">
                <i class="bi bi-pencil-square me-2"></i>
                {{ isset($alternatif) ? 'Edit Alternatif' : 'Tambah Alternatif' }}
            </h4>

            <form method="POST" action="{{ isset($alternatif) ? route('alternatif.update', $alternatif->id) : route('alternatif.store') }}">
                @csrf
                @if(isset($alternatif))
                    @method('PUT')
                @endif

                <div class="mb-4">
                    <label for="code" class="form-label fw-semibold">Kode Alternatif</label>
                    <input type="text" name="code" class="form-control form-control-lg shadow-sm rounded-3"
                           value="{{ old('code', $alternatif->code ?? '') }}"
                           {{ isset($alternatif) ? 'readonly' : '' }} required>
                </div>

                <div class="mb-4">
                    <label for="nama_alternatif" class="form-label fw-semibold">Nama Alternatif</label>
                    <input type="text" name="nama_alternatif" class="form-control form-control-lg shadow-sm rounded-3"
                           value="{{ old('nama_alternatif', $alternatif->nama_alternatif ?? '') }}" required>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success d-flex align-items-center gap-2 px-4 py-2 rounded-3 shadow-sm">
                        <i class="bi bi-check-circle-fill"></i>
                        {{ isset($alternatif) ? 'Update' : 'Simpan' }}
                    </button>
                    <a href="{{ route('alternatif.index') }}" class="btn btn-outline-secondary d-flex align-items-center gap-2 px-4 py-2 rounded-3 shadow-sm">
                        <i class="bi bi-arrow-left-circle"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
