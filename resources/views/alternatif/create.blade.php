@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <div class="card shadow rounded-4 border-0">
        <div class="card-body p-5">
            <h4 class="mb-4 fw-bold text-primary">
                <i class="bi bi-plus-circle me-2"></i> Tambah Alternatif
            </h4>

            {{-- Notifikasi Sukses --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Notifikasi Error --}}
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                    <strong><i class="bi bi-exclamation-triangle-fill me-2"></i>Terjadi kesalahan:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Form --}}
            <form action="{{ route('alternatif.store') }}" method="POST">
                @csrf

                {{-- Kode Alternatif --}}
                <div class="mb-4">
                    <label class="form-label fw-semibold">Kode Alternatif</label>
                    <input type="text" name="code" class="form-control form-control-lg shadow-sm rounded-3" 
                        value="{{ old('code') }}" required>
                    @error('code')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Nama Alternatif --}}
                <div class="mb-4">
                    <label class="form-label fw-semibold">Nama Alternatif</label>
                    <input type="text" name="nama_alternatif" class="form-control form-control-lg shadow-sm rounded-3" 
                        value="{{ old('nama_alternatif') }}" required>
                    @error('nama_alternatif')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Tombol Aksi --}}
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary d-flex align-items-center gap-2 px-4 py-2 rounded-3 shadow-sm">
                        <i class="bi bi-check-circle"></i> Simpan
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
