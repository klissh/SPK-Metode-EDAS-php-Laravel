@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <div class="card shadow rounded-4 border-0">
        <div class="card-body p-5">
            <h4 class="mb-4 fw-bold {{ isset($kriteria) ? 'text-warning' : 'text-primary' }}">
                <i class="bi {{ isset($kriteria) ? 'bi-pencil-square' : 'bi-plus-circle' }} me-2"></i>
                {{ isset($kriteria) ? 'Edit Kriteria' : 'Tambah Kriteria' }}
            </h4>

            <form action="{{ isset($kriteria) ? route('kriteria.update', $kriteria->id) : route('kriteria.store') }}" method="POST">
                @csrf
                @if(isset($kriteria))
                    @method('PUT')
                @endif

                {{-- Kode Kriteria hanya saat tambah --}}
                @unless(isset($kriteria))
                <div class="mb-4">
                    <label for="code" class="form-label fw-semibold">Kode Kriteria</label>
                    <input type="text" name="code" class="form-control form-control-lg shadow-sm rounded-3" value="{{ old('code') }}" required>
                    @error('code') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                @endunless

                {{-- Nama Kriteria --}}
                <div class="mb-4">
                    <label for="nama_kriteria" class="form-label fw-semibold">Nama Kriteria</label>
                    <input type="text" name="nama_kriteria" class="form-control form-control-lg shadow-sm rounded-3"
                        value="{{ old('nama_kriteria', $kriteria->nama_kriteria ?? '') }}" required>
                    @error('nama_kriteria') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- Tipe Kriteria --}}
                <div class="mb-4">
                    <label for="tipe" class="form-label fw-semibold">Tipe</label>
                    <select name="tipe" class="form-select form-select-lg shadow-sm rounded-3" required>
                        <option value="benefit" {{ old('tipe', $kriteria->tipe ?? '') == 'benefit' ? 'selected' : '' }}>Benefit</option>
                        <option value="cost" {{ old('tipe', $kriteria->tipe ?? '') == 'cost' ? 'selected' : '' }}>Cost</option>
                    </select>
                    @error('tipe') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- Bobot Kriteria --}}
                <div class="mb-4">
                    <label for="bobot" class="form-label fw-semibold">Bobot Kriteria (%)</label>
                    <input type="number" name="bobot" step="0.01" inputmode="decimal"
                        class="form-control form-control-lg shadow-sm rounded-3"
                        value="{{ old('bobot', isset($kriteria) ? $kriteria->bobot * 100 : '') }}" required>
                    @error('bobot') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- Tombol Aksi --}}
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success d-flex align-items-center gap-2 px-4 py-2 rounded-3 shadow-sm">
                        <i class="bi bi-check-circle-fill"></i>
                        {{ isset($kriteria) ? 'Update' : 'Simpan' }}
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
