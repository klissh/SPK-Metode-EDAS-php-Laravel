@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-8 px-4 sm:px-0">
    <div class="bg-white shadow-lg rounded-2xl overflow-hidden">
        <!-- Header with gradient background -->
        <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 px-8 py-6">
            <h2 class="text-2xl font-bold text-white flex items-center gap-3">
                <div class="bg-white/20 p-2 rounded-lg">
                    <i class="bi {{ isset($alternatif) ? 'bi-pencil-square' : 'bi-plus-square' }} text-white"></i>
                </div>
                {{ isset($alternatif) ? 'Edit Alternatif' : 'Tambah Alternatif' }}
            </h2>
            <p class="text-emerald-100 mt-1">
                {{ isset($alternatif) ? 'Perbarui informasi alternatif yang sudah ada' : 'Tambahkan alternatif baru ke dalam sistem' }}
            </p>
        </div>

        <!-- Form content -->
        <div class="p-8">
            <form method="POST" action="{{ isset($alternatif) ? route('alternatif.update', $alternatif->id) : route('alternatif.store') }}">
                @csrf
                @if(isset($alternatif))
                    @method('PUT')
                @endif

                <!-- Input: Kode -->
                <div class="mb-6">
                    <label for="code" class="block text-sm font-medium text-gray-700 mb-1">Kode Alternatif</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="bi bi-hash text-gray-400"></i>
                        </div>
                        <input type="text" name="code" id="code"
                            class="w-full pl-10 px-4 py-3 rounded-lg border border-gray-300 shadow-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none transition-all duration-200"
                            value="{{ old('code', $alternatif->code ?? '') }}"
                            placeholder="Masukkan kode alternatif"
                            {{ isset($alternatif) ? 'readonly' : '' }} required>
                    </div>
                    @if(isset($alternatif))
                        <p class="mt-1 text-xs text-gray-500">Kode tidak dapat diubah setelah dibuat</p>
                    @endif
                </div>

                <!-- Input: Nama Alternatif -->
                <div class="mb-8">
                    <label for="nama_alternatif" class="block text-sm font-medium text-gray-700 mb-1">Nama Alternatif</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="bi bi-card-text text-gray-400"></i>
                        </div>
                        <input type="text" name="nama_alternatif" id="nama_alternatif"
                            class="w-full pl-10 px-4 py-3 rounded-lg border border-gray-300 shadow-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none transition-all duration-200"
                            value="{{ old('nama_alternatif', $alternatif->nama_alternatif ?? '') }}" 
                            placeholder="Masukkan nama alternatif"
                            required>
                    </div>
                </div>

                <!-- Divider -->
                <div class="relative my-8">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-200"></div>
                    </div>
                </div>

                <!-- Aksi -->
                <div class="flex flex-col-reverse sm:flex-row sm:justify-between gap-4">
                    <a href="{{ route('alternatif.index') }}"
                        class="inline-flex justify-center items-center px-6 py-3 bg-white hover:bg-gray-50 text-gray-700 font-medium rounded-lg border border-gray-300 shadow-sm transition-all duration-200 text-center">
                        <i class="bi bi-arrow-left-circle mr-2 text-gray-500"></i> Kembali
                    </a>

                    <button type="submit"
                        class="inline-flex justify-center items-center px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-lg shadow-sm transition-all duration-200 transform hover:-translate-y-0.5">
                        <i class="bi bi-check-circle-fill mr-2"></i>
                        {{ isset($alternatif) ? 'Update Alternatif' : 'Simpan Alternatif' }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Help card -->
    <div class="mt-6 bg-blue-50 border border-blue-200 rounded-xl p-4 flex items-start">
        <div class="flex-shrink-0 bg-blue-100 rounded-lg p-2">
            <i class="bi bi-info-circle-fill text-blue-600"></i>
        </div>
        <div class="ml-3">
            <h3 class="text-sm font-medium text-blue-800">Informasi</h3>
            <div class="mt-1 text-sm text-blue-700">
                <p>{{ isset($alternatif) ? 'Perubahan yang Anda lakukan akan langsung tersimpan setelah menekan tombol Update.' : 'Pastikan kode alternatif bersifat unik dan belum pernah digunakan sebelumnya.' }}</p>
            </div>
        </div>
    </div>
</div>
@endsection