@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white shadow-md rounded-xl p-8">
        <h2 class="text-2xl font-semibold {{ isset($kriteria) ? 'text-yellow-500' : 'text-blue-600' }} flex items-center gap-2 mb-6">
            <i class="bi {{ isset($kriteria) ? 'bi-pencil-square' : 'bi-plus-circle' }}"></i>
            {{ isset($kriteria) ? 'Edit Kriteria' : 'Tambah Kriteria' }}
        </h2>

        <form action="{{ isset($kriteria) ? route('kriteria.update', $kriteria->id) : route('kriteria.store') }}" method="POST">
            @csrf
            @if(isset($kriteria))
                @method('PUT')
            @endif

            {{-- Kode Kriteria (hanya saat tambah) --}}
            @unless(isset($kriteria))
            <div class="mb-6">
                <label for="code" class="block text-sm font-semibold text-slate-700 mb-2">Kode Kriteria</label>
                <input type="text" name="code"
                       class="w-full px-4 py-3 rounded-lg border border-slate-300 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none"
                       value="{{ old('code') }}" required>
                @error('code')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            @endunless

            {{-- Nama Kriteria --}}
            <div class="mb-6">
                <label for="nama_kriteria" class="block text-sm font-semibold text-slate-700 mb-2">Nama Kriteria</label>
                <input type="text" name="nama_kriteria"
                       class="w-full px-4 py-3 rounded-lg border border-slate-300 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none"
                       value="{{ old('nama_kriteria', $kriteria->nama_kriteria ?? '') }}" required>
                @error('nama_kriteria')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tipe --}}
            <div class="mb-6">
                <label for="tipe" class="block text-sm font-semibold text-slate-700 mb-2">Tipe</label>
                <select name="tipe"
                        class="w-full px-4 py-3 rounded-lg border border-slate-300 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none"
                        required>
                    <option value="benefit" {{ old('tipe', $kriteria->tipe ?? '') == 'benefit' ? 'selected' : '' }}>Benefit</option>
                    <option value="cost" {{ old('tipe', $kriteria->tipe ?? '') == 'cost' ? 'selected' : '' }}>Cost</option>
                </select>
                @error('tipe')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Bobot Kriteria --}}
            <div class="mb-6">
                <label for="bobot" class="block text-sm font-semibold text-slate-700 mb-2">Bobot Kriteria (%)</label>
                <input type="number" name="bobot" step="0.01" inputmode="decimal"
                       class="w-full px-4 py-3 rounded-lg border border-slate-300 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none"
                       value="{{ old('bobot', isset($kriteria) ? $kriteria->bobot * 100 : '') }}" required>
                @error('bobot')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tombol Aksi --}}
            <div class="flex justify-between gap-4">
                <button type="submit"
                        class="bg-emerald-500 hover:bg-emerald-600 text-white font-semibold px-6 py-2 rounded-lg shadow flex items-center gap-2 transition">
                    <i class="bi bi-check-circle-fill"></i>
                    {{ isset($kriteria) ? 'Update' : 'Simpan' }}
                </button>

                <a href="{{ route('kriteria.index') }}"
                   class="bg-gray-200 hover:bg-gray-300 text-slate-700 font-semibold px-6 py-2 rounded-lg shadow flex items-center gap-2 transition">
                    <i class="bi bi-arrow-left-circle"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
