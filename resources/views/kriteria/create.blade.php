@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white shadow-md rounded-xl p-8">
        <h2 class="text-2xl font-semibold text-blue-600 flex items-center gap-2 mb-6">
            <i class="bi bi-plus-circle"></i> Tambah Kriteria
        </h2>

        {{-- Notifikasi Sukses --}}
        @if(session('success'))
            <div class="bg-blue-100 border border-blue-300 text-blue-800 px-4 py-3 rounded relative shadow mb-4">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            </div>
        @endif

        {{-- Notifikasi Error --}}
        @if($errors->any())
            <div class="bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded relative shadow mb-4">
                <strong><i class="bi bi-exclamation-triangle-fill me-2"></i>Terjadi kesalahan:</strong>
                <ul class="list-disc pl-6 mt-2 text-sm">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('kriteria.store') }}" method="POST">
            @csrf

            {{-- Kode Kriteria --}}
            <div class="mb-6">
                <label for="code" class="block text-sm font-semibold text-slate-700 mb-2">Kode Kriteria</label>
                <input type="text" name="code"
                       class="w-full px-4 py-3 rounded-lg border border-slate-300 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none"
                       value="{{ old('code') }}" required>
                @error('code')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Nama Kriteria --}}
            <div class="mb-6">
                <label for="nama_kriteria" class="block text-sm font-semibold text-slate-700 mb-2">Nama Kriteria</label>
                <input type="text" name="nama_kriteria"
                       class="w-full px-4 py-3 rounded-lg border border-slate-300 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none"
                       value="{{ old('nama_kriteria') }}" required>
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
                    <option value="">-- Pilih Tipe --</option>
                    <option value="benefit" {{ old('tipe') == 'benefit' ? 'selected' : '' }}>Benefit</option>
                    <option value="cost" {{ old('tipe') == 'cost' ? 'selected' : '' }}>Cost</option>
                </select>
                @error('tipe')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Bobot Kriteria --}}
            <div class="mb-6">
                <label for="bobot" class="block text-sm font-semibold text-slate-700 mb-2">Bobot Kriteria (%)</label>
                <input type="number" name="bobot" step="0.01" min="0.01" max="100"
                       class="w-full px-4 py-3 rounded-lg border border-slate-300 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none"
                       value="{{ old('bobot') }}" required>
                @error('bobot')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tombol --}}
            <div class="flex justify-between gap-4">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg shadow flex items-center gap-2 transition">
                    <i class="bi bi-check-circle-fill"></i> Simpan
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
