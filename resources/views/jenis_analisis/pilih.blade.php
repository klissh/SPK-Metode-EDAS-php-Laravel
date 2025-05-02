@extends('layouts.app')

@section('content')
<div class="container mt-5">

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">🔍 Pilih Jenis Analisis</h4>
        </div>

        <div class="card-body">

            {{-- Alert sukses --}}
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Alert error --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Form pemilihan --}}
            <form method="POST" action="{{ route('set-jenis-analisis') }}">
                @csrf

                <div class="mb-3">
                    <label for="jenis_analisis_id" class="form-label">Pilih Jenis Analisis:</label>
                    <select name="jenis_analisis_id" id="jenis_analisis_id" class="form-select" required>
                        <option value="">-- Pilih --</option>
                        @foreach ($data as $item)
                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('jenis-analisis.index') }}" class="btn btn-secondary">⚙️ Kelola Jenis Analisis</a>
                    <button type="submit" class="btn btn-primary">🔧 Gunakan</button>
                </div>
            </form>

        </div>
    </div>

</div>
@endsection
