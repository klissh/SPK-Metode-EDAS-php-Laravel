@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">
    {{-- Heading --}}
    <div class="border-b border-gray-200 pb-5">
        <div class="flex items-center">
            <div class="bg-emerald-100 p-3 rounded-full">
                <i class="bi bi-calculator-fill text-emerald-600 text-xl"></i>
            </div>
            <h2 class="ml-4 text-2xl font-bold text-gray-900">Data Alternatif</h2>
        </div>
        <p class="mt-3 text-gray-600 flex items-center flex-wrap">
            <span class="font-medium">Jenis Analisis:</span> 
            <span class="ml-2 inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-emerald-100 text-emerald-800 shadow-sm">
                {{ $jenis_analisis->nama ?? 'Tidak tersedia' }}
            </span>
        </p>
    </div>

    {{-- Notifikasi Sukses --}}
    @if(session('success'))
        <div id="successAlert" 
             class="relative flex items-center p-4 mb-4 text-emerald-800 rounded-lg bg-emerald-50 border-l-4 border-emerald-500 shadow-md transition-all duration-500 ease-in-out"
             role="alert">
            <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 bg-emerald-100 rounded-lg">
                <i class="bi bi-check-circle-fill text-emerald-600"></i>
            </div>
            <div class="ml-3 text-sm font-medium">
                <strong class="font-bold">Berhasil!</strong> {{ session('success') }}
            </div>
            <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-emerald-50 text-emerald-500 rounded-lg p-1.5 hover:bg-emerald-100 inline-flex h-8 w-8 items-center justify-center" onclick="this.parentElement.remove()">
                <span class="sr-only">Tutup</span>
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
    @endif

    {{-- Notifikasi Error --}}
    @if($errors->any())
        <div class="relative flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 border-l-4 border-red-500 shadow-md">
            <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 bg-red-100 rounded-lg">
                <i class="bi bi-exclamation-triangle-fill text-red-600"></i>
            </div>
            <div class="ml-3 text-sm">
                <strong class="font-bold">Terjadi kesalahan:</strong>
                <ul class="mt-1.5 ml-4 list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg p-1.5 hover:bg-red-100 inline-flex h-8 w-8 items-center justify-center" onclick="this.parentElement.remove()">
                <span class="sr-only">Tutup</span>
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
    @endif

    {{-- Tombol --}}
    <div class="flex flex-col sm:flex-row justify-between gap-4">
        <a href="{{ route('alternatif.create') }}"
           class="inline-flex items-center justify-center px-5 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-lg shadow-sm transition-all duration-200 ease-in-out transform hover:-translate-y-0.5">
            <i class="bi bi-plus-circle me-2 text-emerald-200"></i> 
            <span>Tambah Alternatif</span>
        </a>
        <a href="{{ route('jenis-analisis.index') }}"
           class="inline-flex items-center justify-center px-5 py-3 bg-white hover:bg-gray-100 text-gray-700 font-medium rounded-lg border border-gray-300 shadow-sm transition-all duration-200 ease-in-out">
            <i class="bi bi-arrow-left-circle me-2 text-gray-500"></i> 
            <span>Kembali ke Jenis Analisis</span>
        </a>
    </div>

    {{-- Tabel --}}
    <div class="overflow-hidden bg-white shadow-md rounded-xl">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-emerald-50">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-center text-xs font-semibold text-emerald-800 uppercase tracking-wider">No</th>
                        <th scope="col" class="px-6 py-4 text-center text-xs font-semibold text-emerald-800 uppercase tracking-wider">Kode</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-emerald-800 uppercase tracking-wider">Nama Alternatif</th>
                        <th scope="col" class="px-6 py-4 text-center text-xs font-semibold text-emerald-800 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($alternatifs as $alt)
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-600">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-emerald-100 text-emerald-800">
                                    {{ $alt->code }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">{{ $alt->nama_alternatif }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                <div class="flex justify-center space-x-3">
                                    <a href="{{ route('alternatif.edit', $alt->id) }}"
                                       class="inline-flex items-center px-3 py-1.5 bg-amber-500 hover:bg-amber-600 text-white text-sm font-medium rounded-md shadow-sm transition-colors duration-200">
                                        <i class="bi bi-pencil-fill mr-1.5"></i> Edit
                                    </a>
                                    <button type="button"
                                            onclick="document.getElementById('modalHapus{{ $alt->id }}').showModal();"
                                            class="inline-flex items-center px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-md shadow-sm transition-colors duration-200">
                                            <i class="bi bi-trash-fill mr-1.5"></i> Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>

                        {{-- Modal konfirmasi --}}
                        <dialog id="modalHapus{{ $alt->id }}" class="rounded-xl p-0 backdrop:bg-black/60 w-full max-w-md shadow-2xl">
                            <div class="bg-white rounded-xl overflow-hidden">
                                <div class="bg-gradient-to-r from-red-600 to-red-700 text-white px-6 py-4 rounded-t-xl flex justify-between items-center">
                                    <h3 class="text-lg font-semibold flex items-center">
                                        <i class="bi bi-exclamation-circle-fill mr-2"></i> Konfirmasi Hapus
                                    </h3>
                                    <form method="dialog">
                                        <button type="submit" class="text-white hover:text-red-100 text-2xl leading-none transition-colors">&times;</button>
                                    </form>
                                </div>
                                <div class="px-6 py-6">
                                    <div class="flex items-center mb-4 text-red-600">
                                        <div class="bg-red-100 p-2 rounded-full mr-3">
                                            <i class="bi bi-trash text-xl"></i>
                                        </div>
                                        <p class="text-gray-700">
                                            Yakin ingin menghapus <strong class="font-semibold">{{ $alt->nama_alternatif }}</strong>?
                                        </p>
                                    </div>
                                    <p class="text-sm text-gray-500 mb-4">
                                        Tindakan ini tidak dapat dibatalkan dan semua data terkait akan dihapus secara permanen.
                                    </p>
                                </div>
                                <div class="px-6 py-4 flex justify-end gap-3 border-t bg-gray-50">
                                    <form method="dialog">
                                        <button class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium rounded-lg transition-colors duration-200">
                                            <i class="bi bi-x-circle mr-1.5"></i> Batal
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('alternatif.destroy', $alt->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg shadow-sm transition-colors duration-200">
                                            <i class="bi bi-trash mr-1.5"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </dialog>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-10 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="bg-gray-100 p-4 rounded-full mb-3">
                                        <i class="bi bi-inbox text-3xl text-gray-400"></i>
                                    </div>
                                    <p class="text-gray-500 font-medium">Belum ada alternatif.</p>
                                    <p class="text-gray-400 text-sm mt-1">Klik tombol "Tambah Alternatif" untuk menambahkan data baru.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

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
    /* Add these styles to your CSS */
    .opacity-0 {
        opacity: 0;
    }
    
    dialog::backdrop {
        background-color: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(2px);
    }
</style>
@endpush