@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <div class="card shadow rounded-4 border-0">
        <div class="card-body p-5">
            <h4 class="mb-4 fw-bold text-primary">
                <i class="bi bi-plus-circle me-2"></i> Tambah Kriteria
            </h4>

            {{-- Flash Message --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                </div>
            @endif

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

            <form action="{{ route('kriteria.store') }}" method="POST">
                @csrf

                {{-- Kode Kriteria --}}
                <div class="mb-4">
                    <label for="code" class="form-label fw-semibold">Kode Kriteria</label>
                    <input type="text" name="code" class="form-control form-control-lg shadow-sm rounded-3"
                        value="{{ old('code') }}" required>
                    @error('code')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Nama Kriteria --}}
                <div class="mb-4">
                    <label for="nama_kriteria" class="form-label fw-semibold">Nama Kriteria</label>
                    <input type="text" name="nama_kriteria" class="form-control form-control-lg shadow-sm rounded-3"
                        value="{{ old('nama_kriteria') }}" required>
                    @error('nama_kriteria')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Tipe --}}
                <div class="mb-4">
                    <label for="tipe" class="form-label fw-semibold">Tipe</label>
                    <select name="tipe" class="form-select form-select-lg shadow-sm rounded-3" required>
                        <option value="">-- Pilih Tipe --</option>
                        <option value="benefit" {{ old('tipe') == 'benefit' ? 'selected' : '' }}>Benefit</option>
                        <option value="cost" {{ old('tipe') == 'cost' ? 'selected' : '' }}>Cost</option>
                    </select>
                    @error('tipe')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Bobot --}}
                <div class="mb-4">
                    <label for="bobot" class="form-label fw-semibold">Bobot Kriteria (%)</label>
                    <input type="number" step="0.01" min="0.01" max="100"
                        name="bobot" class="form-control form-control-lg shadow-sm rounded-3"
                        value="{{ old('bobot') }}" required>
                    @error('bobot')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Tombol --}}
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary d-flex align-items-center gap-2 px-4 py-2 rounded-3 shadow-sm">
                        <i class="bi bi-check-circle-fill"></i> Simpan
                    </button>
                    <a href="{{ route('kriteria.index') }}" class="btn btn-outline-secondary d-flex align-items-center gap-2 px-4 py-2 rounded-3 shadow-sm">
                        <i class="bi bi-arrow-left-circle"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
