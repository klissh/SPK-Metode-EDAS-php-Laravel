@extends('layouts.app')

@section('content')
<div class="container mt-5">

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">➕ Tambah Jenis Analisis</h4>
        </div>

        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('jenis-analisis.store') }}">
                @csrf

                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Jenis Analisis</label>
                    <input type="text" id="nama" name="nama" class="form-control" placeholder="Contoh: Laptop" required>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('jenis-analisis.index') }}" class="btn btn-secondary">⬅️ Kembali</a>
                    <button type="submit" class="btn btn-success">💾 Simpan</button>
                </div>
            </form>

        </div>
    </div>

</div>
@endsection
