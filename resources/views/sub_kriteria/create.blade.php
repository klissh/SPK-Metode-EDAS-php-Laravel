@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto">
    <div class="bg-white shadow-md rounded-xl p-8">
        <h2 class="text-2xl font-semibold text-blue-600 mb-6">
            {{ isset($subkriteria) ? 'Edit' : 'Tambah' }} Sub Kriteria untuk: 
            <span class="text-slate-800">{{ $kriteria->nama_kriteria }} ({{ $kriteria->code }})</span>
        </h2>

        <form action="{{ isset($subkriteria) 
                        ? route('sub-kriteria.update', $subkriteria->id) 
                        : route('sub-kriteria.store') }}" method="POST">
            @csrf
            @if(isset($subkriteria))
                @method('PUT')
            @endif

            {{-- kriteria_id tersembunyi --}}
            <input type="hidden" name="kriteria_id" value="{{ $kriteria->id }}">

            {{-- Nama Sub Kriteria --}}
            <div class="mb-6">
                <label for="nama_sub" class="block text-sm font-semibold text-slate-700 mb-2">Nama Sub Kriteria</label>
                <input type="text" name="nama_sub"
                       class="w-full px-4 py-3 rounded-lg border border-slate-300 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none"
                       value="{{ old('nama_sub', $subkriteria->nama_sub ?? '') }}" required>
                @error('nama_sub')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Nilai --}}
            <div class="mb-6">
                <label for="nilai" class="block text-sm font-semibold text-slate-700 mb-2">Nilai </label>
                <input type="number" name="nilai" min="1"
                       class="w-full px-4 py-3 rounded-lg border border-slate-300 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none"
                       value="{{ old('nilai', $subkriteria->nilai ?? '') }}" required>
                @error('nilai')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tombol Aksi --}}
            <div class="flex justify-between gap-4">
                <button type="submit"
                        class="{{ isset($subkriteria) ? 'bg-emerald-500 hover:bg-emerald-600' : 'bg-blue-600 hover:bg-blue-700' }}
                               text-white font-semibold px-6 py-2 rounded-lg shadow transition">
                    {{ isset($subkriteria) ? 'Update' : 'Simpan' }}
                </button>

                <a href="{{ route('sub-kriteria.index', ['kriteria_id' => $kriteria->id]) }}"
                   class="bg-gray-200 hover:bg-gray-300 text-slate-700 font-semibold px-6 py-2 rounded-lg shadow transition">
                    Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
