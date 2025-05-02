@extends('layouts.app')

@section('content')
<div class="container mt-5">

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">📋 Daftar Jenis Analisis</h4>
            <a href="{{ route('jenis-analisis.create') }}" class="btn btn-light btn-sm">
                ➕ Tambah Jenis Analisis
            </a>
        </div>

        <div class="card-body">

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Nama Jenis Analisis</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>
                                <a href="{{ route('jenis-analisis.edit', $item->id) }}" class="btn btn-sm btn-warning">✏️ Edit</a>

                                <form action="{{ route('jenis-analisis.destroy', $item->id) }}"
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">🗑️ Hapus</button>
                                    {{-- Tombol Pilih --}}
                                </form>
                                <form action="{{ route('set-jenis-analisis') }}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="jenis_analisis_id" value="{{ $item->id }}">
                                    <button type="submit" class="btn btn-sm btn-success">✅ Pilih</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted">Belum ada data.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>

</div>
@endsection
