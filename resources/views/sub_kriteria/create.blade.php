@extends('layouts.app')

@section('content')
<div class="container">
    <h4>
        {{ isset($subkriteria) ? 'Edit' : 'Tambah' }} Sub Kriteria untuk: 
        <strong>{{ $kriteria->nama_kriteria }} ({{ $kriteria->code }})</strong>
    </h4>

    <form action="{{ isset($subkriteria) 
                    ? route('sub-kriteria.update', $subkriteria->id) 
                    : route('sub-kriteria.store') }}" method="POST">
        @csrf
        @if(isset($subkriteria))
            @method('PUT')
        @endif

        {{-- ✅ Ganti ke kriteria_id --}}
        <input type="hidden" name="kriteria_id" value="{{ $kriteria->id }}">

        <div class="mb-3">
            <label for="nama_sub" class="form-label">Nama Sub Kriteria</label>
            <input type="text" name="nama_sub" class="form-control" 
                value="{{ old('nama_sub', $subkriteria->nama_sub ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="nilai" class="form-label">Nilai (1-5)</label>
            <input type="number" name="nilai" class="form-control" min="1" max="5" 
                value="{{ old('nilai', $subkriteria->nilai ?? '') }}" required>
        </div>

        <button type="submit" class="btn btn-{{ isset($subkriteria) ? 'success' : 'primary' }}">
            {{ isset($subkriteria) ? 'Update' : 'Simpan' }}
        </button>

        {{-- ✅ Perbaiki tombol kembali --}}
        <a href="{{ route('sub-kriteria.index', ['kriteria_id' => $kriteria->id]) }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
