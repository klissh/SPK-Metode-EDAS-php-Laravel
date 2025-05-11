@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-10 space-y-6">

    {{-- Heading --}}
    <div class="text-center">
        <h2 class="text-2xl font-semibold text-blue-600 flex justify-center items-center gap-2">
            <i class="bi bi-search"></i> Pilih Jenis Analisis
        </h2>
    </div>

    {{-- Card Form --}}
    <div class="bg-white rounded-xl shadow p-6 space-y-6">

        {{-- Alert sukses --}}
        @if (session('success'))
            <div class="bg-green-100 border border-green-200 text-green-800 px-4 py-3 rounded-md shadow">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            </div>
        @endif

        {{-- Alert error --}}
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

        {{-- Form --}}
        <form method="POST" action="{{ route('set-jenis-analisis') }}" class="space-y-5">
            @csrf

            <div>
                <label for="jenis_analisis_id" class="block font-medium text-gray-700 mb-1">Pilih Jenis Analisis</label>
                <select name="jenis_analisis_id" id="jenis_analisis_id"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                    <option value="">-- Pilih --</option>
                    @foreach ($data as $item)
                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-between">
                <a href="{{ route('jenis-analisis.index') }}"
                   class="flex items-center gap-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold px-5 py-2 rounded-lg transition shadow">
                    <i class="bi bi-gear-fill"></i> Kelola Jenis Analisis
                </a>

                <button type="submit"
                        class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded-lg transition shadow">
                    <i class="bi bi-sliders"></i> Gunakan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
