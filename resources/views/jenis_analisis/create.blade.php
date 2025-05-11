@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-10 space-y-6">

    {{-- Header --}}
    <div class="bg-blue-600 text-white px-6 py-4 rounded-xl shadow flex items-center gap-2">
        <i class="bi bi-plus-circle-fill"></i>
        <h2 class="text-lg font-semibold">Tambah Jenis Analisis</h2>
    </div>

    {{-- Form Card --}}
    <div class="bg-white rounded-xl shadow p-6 space-y-6">

        {{-- Validasi --}}
        @if ($errors->any())
            <div class="bg-red-100 border border-red-200 text-red-800 px-4 py-3 rounded-md shadow">
                <div class="font-semibold flex items-center gap-2 mb-2">
                    <i class="bi bi-exclamation-triangle-fill"></i> Terjadi kesalahan:
                </div>
                <ul class="list-disc list-inside text-sm space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('jenis-analisis.store') }}" class="space-y-5">
            @csrf

            {{-- Input Nama --}}
            <div>
                <label for="nama" class="block font-medium text-gray-700 mb-1">Nama Jenis Analisis</label>
                <input type="text" id="nama" name="nama"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="Contoh: Laptop" required>
            </div>

            {{-- Tombol Aksi --}}
            <div class="flex justify-between">
                <a href="{{ route('jenis-analisis.index') }}"
                   class="bg-gray-200 hover:bg-gray-300 text-slate-700 font-semibold px-5 py-2 rounded-lg shadow flex items-center gap-2 transition">
                    <i class="bi bi-arrow-left-circle"></i> Kembali
                </a>

                <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white font-semibold px-5 py-2 rounded-lg shadow flex items-center gap-2 transition">
                    <i class="bi bi-save-fill"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
