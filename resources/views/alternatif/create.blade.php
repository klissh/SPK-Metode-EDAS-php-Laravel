@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-8 px-4 sm:px-0">
    <div class="bg-white shadow-xl rounded-2xl overflow-hidden">
        <!-- Header with gradient background -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-8 py-6">
            <h2 class="text-2xl font-bold text-white flex items-center gap-3">
                <div class="bg-white/20 p-2 rounded-lg">
                    <i class="bi bi-plus-circle text-white"></i>
                </div>
                Tambah Alternatif
            </h2>
            <p class="text-blue-100 mt-1">
                Tambahkan data alternatif baru ke dalam sistem
            </p>
        </div>

        <div class="p-8">
            {{-- Notifikasi Sukses --}}
            @if(session('success'))
                <div id="successAlert" class="flex items-center p-4 mb-6 text-blue-800 rounded-lg bg-blue-50 border-l-4 border-blue-500 shadow-md animate-fade-in" role="alert">
                    <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 bg-blue-100 rounded-lg">
                        <i class="bi bi-check-circle-fill text-blue-600"></i>
                    </div>
                    <div class="ms-3 text-sm font-medium">
                        {{ session('success') }}
                    </div>
                    <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-blue-50 text-blue-500 rounded-lg p-1.5 hover:bg-blue-100 inline-flex items-center justify-center h-8 w-8" onclick="this.parentElement.remove()">
                        <span class="sr-only">Tutup</span>
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
            @endif

            {{-- Notifikasi Error --}}
            @if($errors->any())
                <div class="flex p-4 mb-6 text-red-800 rounded-lg bg-red-50 border-l-4 border-red-500 shadow-md" role="alert">
                    <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 bg-red-100 rounded-lg">
                        <i class="bi bi-exclamation-triangle-fill text-red-600"></i>
                    </div>
                    <div class="ms-3 text-sm">
                        <h3 class="font-medium">Terjadi kesalahan:</h3>
                        <ul class="mt-1.5 list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg p-1.5 hover:bg-red-100 inline-flex items-center justify-center h-8 w-8" onclick="this.parentElement.remove()">
                        <span class="sr-only">Tutup</span>
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
            @endif

            {{-- Form --}}
            <form action="{{ route('alternatif.store') }}" method="POST" class="space-y-6">
                @csrf

                {{-- Kode Alternatif --}}
                <div class="space-y-2">
                    <label for="code" class="block text-sm font-medium text-gray-700">Kode Alternatif</label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="bi bi-hash text-gray-400"></i>
                        </div>
                        <input type="text" name="code" id="code"
                            class="block w-full pl-10 pr-4 py-3 border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 @error('code') border-red-300 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500 @enderror"
                            placeholder="Masukkan kode alternatif"
                            value="{{ old('code') }}" required>
                        @error('code')
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <i class="bi bi-exclamation-circle text-red-500"></i>
                            </div>
                        @enderror
                    </div>
                    @error('code')
                        <p class="mt-1 text-sm text-red-600 flex items-center gap-1">
                            <i class="bi bi-info-circle-fill"></i>
                            {{ $message }}
                        </p>
                    @else
                        <p class="mt-1 text-xs text-gray-500">
                            Kode harus unik dan tidak boleh duplikat
                        </p>
                    @enderror
                </div>

                {{-- Nama Alternatif --}}
                <div class="space-y-2">
                    <label for="nama_alternatif" class="block text-sm font-medium text-gray-700">Nama Alternatif</label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="bi bi-card-text text-gray-400"></i>
                        </div>
                        <input type="text" name="nama_alternatif" id="nama_alternatif"
                            class="block w-full pl-10 pr-4 py-3 border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 @error('nama_alternatif') border-red-300 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500 @enderror"
                            placeholder="Masukkan nama alternatif"
                            value="{{ old('nama_alternatif') }}" required>
                        @error('nama_alternatif')
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <i class="bi bi-exclamation-circle text-red-500"></i>
                            </div>
                        @enderror
                    </div>
                    @error('nama_alternatif')
                        <p class="mt-1 text-sm text-red-600 flex items-center gap-1">
                            <i class="bi bi-info-circle-fill"></i>
                            {{ $message }}
                        </p>
                    @else
                        <p class="mt-1 text-xs text-gray-500">
                            Masukkan nama yang deskriptif untuk alternatif ini
                        </p>
                    @enderror
                </div>

                {{-- Divider --}}
                <div class="relative py-3">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-200"></div>
                    </div>
                </div>

                {{-- Tombol Aksi --}}
                <div class="flex flex-col-reverse sm:flex-row sm:justify-between gap-4">
                    <a href="{{ route('alternatif.index') }}"
                        class="inline-flex justify-center items-center px-6 py-3 bg-white hover:bg-gray-50 text-gray-700 font-medium rounded-lg border border-gray-300 shadow-sm transition-all duration-200 text-center">
                        <i class="bi bi-arrow-left-circle mr-2 text-gray-500"></i> Kembali
                    </a>

                    <button type="submit"
                        class="inline-flex justify-center items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-sm transition-all duration-200 transform hover:-translate-y-0.5">
                        <i class="bi bi-check-circle mr-2"></i> Simpan Alternatif
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Tips card -->
    <div class="mt-6 bg-amber-50 border border-amber-200 rounded-xl p-4 flex items-start">
        <div class="flex-shrink-0 bg-amber-100 rounded-lg p-2">
            <i class="bi bi-lightbulb-fill text-amber-600"></i>
        </div>
        <div class="ml-3">
            <h3 class="text-sm font-medium text-amber-800">Tips</h3>
            <div class="mt-1 text-sm text-amber-700">
                <p>Pastikan kode alternatif bersifat unik dan belum pernah digunakan sebelumnya. Nama alternatif sebaiknya deskriptif dan mudah dikenali.</p>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const alert = document.getElementById('successAlert');
        
        if (alert) {
            setTimeout(() => {
                alert.classList.add('opacity-0');
                setTimeout(() => alert.remove(), 500);
            }, 5000);
        }
    });
</script>

<style>
    .animate-fade-in {
        animation: fadeIn 0.5s ease-in-out;
    }
    
    .opacity-0 {
        opacity: 0;
        transition: opacity 0.5s ease-in-out;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endpush
@endsection