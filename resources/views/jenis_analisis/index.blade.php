@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto mt-10 space-y-6">

    {{-- Header --}}
    <div class="bg-blue-600 text-white rounded-xl shadow px-6 py-4 flex justify-between items-center">
        <h2 class="text-lg font-semibold flex items-center gap-2">
            <i class="bi bi-clipboard-data-fill"></i> Daftar Jenis Analisis
        </h2>
        <a href="{{ route('jenis-analisis.create') }}"
           class="bg-white text-blue-600 hover:bg-blue-100 font-medium px-4 py-2 rounded-lg shadow text-sm flex items-center gap-2">
            <i class="bi bi-plus-circle-fill"></i> Tambah Jenis Analisis
        </a>
    </div>

    {{-- Alert Success --}}
    @if (session('success'))
        <div class="bg-green-100 border border-green-200 text-green-800 px-4 py-3 rounded-md shadow">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        </div>
    @endif

    {{-- Alert Error --}}
    @if (session('error'))
        <div class="bg-red-100 border border-red-200 text-red-800 px-4 py-3 rounded-md shadow">
            <i class="bi bi-exclamation-circle-fill me-2"></i> {{ session('error') }}
        </div>
    @endif

    {{-- Tabel --}}
    <div class="bg-white rounded-xl shadow overflow-x-auto">
        <table class="min-w-full text-sm text-slate-700 text-center">
            <thead class="bg-slate-100 text-slate-600 uppercase text-xs">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3 text-left">Nama Jenis Analisis</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $item)
                    <tr class="border-t hover:bg-slate-50">
                        <td class="px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="text-left px-4 py-2">{{ $item->nama }}</td>
                        <td class="px-4 py-2 space-x-1">
                            <a href="{{ route('jenis-analisis.edit', $item->id) }}"
                               class="inline-flex items-center gap-1 px-3 py-1 bg-yellow-400 hover:bg-yellow-500 text-white text-xs font-semibold rounded shadow transition">
                                <i class="bi bi-pencil-fill"></i> Edit
                            </a>
                            <form action="{{ route('jenis-analisis.destroy', $item->id) }}" method="POST" class="inline-block"
                                  onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="inline-flex items-center gap-1 px-3 py-1 bg-red-600 hover:bg-red-700 text-white text-xs font-semibold rounded shadow transition">
                                    <i class="bi bi-trash-fill"></i> Hapus
                                </button>
                            </form>
                            <form action="{{ route('set-jenis-analisis') }}" method="POST" class="inline-block">
                                @csrf
                                <input type="hidden" name="jenis_analisis_id" value="{{ $item->id }}">
                                <button type="submit"
                                    class="inline-flex items-center gap-1 px-3 py-1 bg-green-600 hover:bg-green-700 text-white text-xs font-semibold rounded shadow transition">
                                    <i class="bi bi-check-circle-fill"></i> Pilih
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center px-4 py-3 text-slate-500">Belum ada data.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
