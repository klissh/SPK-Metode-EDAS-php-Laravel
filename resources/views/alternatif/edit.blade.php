@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white shadow-md rounded-xl p-8">
        <h2 class="text-2xl font-semibold text-emerald-600 flex items-center gap-2 mb-6">
            <i class="bi bi-pencil-square"></i>
            {{ isset($alternatif) ? 'Edit Alternatif' : 'Tambah Alternatif' }}
        </h2>

        <form method="POST" action="{{ isset($alternatif) ? route('alternatif.update', $alternatif->id) : route('alternatif.store') }}">
            @csrf
            @if(isset($alternatif))
                @method('PUT')
            @endif

            <!-- Input: Kode -->
            <div class="mb-6">
                <label for="code" class="block text-sm font-semibold text-slate-700 mb-2">Kode Alternatif</label>
                <input type="text" name="code"
                       class="w-full px-4 py-3 rounded-lg border border-slate-300 shadow-sm focus:ring-2 focus:ring-emerald-400 focus:outline-none"
                       value="{{ old('code', $alternatif->code ?? '') }}"
                       {{ isset($alternatif) ? 'readonly' : '' }} required>
            </div>

            <!-- Input: Nama Alternatif -->
            <div class="mb-6">
                <label for="nama_alternatif" class="block text-sm font-semibold text-slate-700 mb-2">Nama Alternatif</label>
                <input type="text" name="nama_alternatif"
                       class="w-full px-4 py-3 rounded-lg border border-slate-300 shadow-sm focus:ring-2 focus:ring-emerald-400 focus:outline-none"
                       value="{{ old('nama_alternatif', $alternatif->nama_alternatif ?? '') }}" required>
            </div>

            <!-- Aksi -->
            <div class="flex justify-between gap-4">
                <button type="submit"
                        class="bg-emerald-500 hover:bg-emerald-600 text-white font-semibold px-6 py-2 rounded-lg shadow flex items-center gap-2 transition">
                    <i class="bi bi-check-circle-fill"></i>
                    {{ isset($alternatif) ? 'Update' : 'Simpan' }}
                </button>

                <a href="{{ route('alternatif.index') }}"
                   class="bg-gray-200 hover:bg-gray-300 text-slate-700 font-semibold px-6 py-2 rounded-lg shadow flex items-center gap-2 transition">
                    <i class="bi bi-arrow-left-circle"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
