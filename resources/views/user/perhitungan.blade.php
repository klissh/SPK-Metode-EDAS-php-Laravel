@extends('layouts.user')

@section('content')
<div class="container mx-auto py-6 px-4 animate-fadeIn">
    <div class="mb-8 text-center">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Penilaian Alternatif</h2>
        <p class="text-gray-600 dark:text-gray-300 mt-2">Masukkan nilai untuk setiap alternatif berdasarkan kriteria yang telah ditentukan</p>
        <div class="h-1 w-24 bg-gradient-to-r from-blue-600 to-blue-400 rounded mx-auto mt-4"></div>
    </div>

    {{-- Notifikasi sukses dengan animasi dan dismiss button --}}
    @if (session('success'))
        <div id="notification" class="bg-green-50 border-l-4 border-green-500 text-green-800 p-4 mb-6 rounded-md shadow-md relative animate-fadeIn dark:bg-green-900 dark:text-green-100">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium">{{ session('success') }}</p>
                </div>
            </div>
            <button onclick="document.getElementById('notification').remove()" class="absolute top-2 right-2 text-green-600 hover:text-green-800 dark:text-green-300 dark:hover:text-green-100">
                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>
    @endif

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 transition-all duration-300">
        <form action="{{ route('user.simpan-nilai', $jenis_analisis->id) }}" method="POST">
            @csrf

            <div class="mb-4 flex flex-wrap items-center justify-between">
                <div class="text-sm text-gray-600 dark:text-gray-300 mb-2 md:mb-0">
                    <span class="inline-flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Masukkan nilai antara 0-100 untuk setiap kriteria
                    </span>
                </div>
                
                <div class="flex space-x-2">
                    <button type="button" onclick="resetForm()" class="text-gray-600 dark:text-gray-300 hover:text-red-600 dark:hover:text-red-400 text-sm font-medium flex items-center transition-colors duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        Reset
                    </button>
                    <button type="button" onclick="fillRandom()" class="text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 text-sm font-medium flex items-center transition-colors duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122" />
                        </svg>
                        Isi Acak
                    </button>
                </div>
            </div>

            <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead>
                        <tr class="bg-gray-50 dark:bg-gray-700">
                            <th scope="col" class="sticky left-0 z-10 bg-gray-50 dark:bg-gray-700 px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider border-b border-gray-200 dark:border-gray-700">
                                Nama Alternatif
                            </th>
                            @foreach ($kriterias as $kriteria)
                                <th scope="col" class="group px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider border-b border-gray-200 dark:border-gray-700 relative">
                                    <div class="flex flex-col items-center">
                                        <span>{{ $kriteria->nama_kriteria }}</span>
                                        <span class="text-xs font-normal text-gray-400 dark:text-gray-500 mt-1">
                                            @if(isset($kriteria->bobot))
                                                Bobot: {{ $kriteria->bobot }}
                                            @endif
                                            @if(isset($kriteria->jenis))
                                                ({{ $kriteria->jenis == 'benefit' ? 'Benefit' : 'Cost' }})
                                            @endif
                                        </span>
                                    </div>
                                    <div class="absolute bottom-0 left-0 w-0 h-0.5 bg-blue-500 group-hover:w-full transition-all duration-300"></div>
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse ($alternatifs as $index => $alt)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150">
                                <td class="sticky left-0 z-10 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-white border-r border-gray-200 dark:border-gray-700">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-8 w-8 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center text-blue-600 dark:text-blue-300 font-bold text-xs">
                                            {{ $index + 1 }}
                                        </div>
                                        <div class="ml-3">
                                            {{ $alt->nama_alternatif }}
                                        </div>
                                    </div>
                                </td>
                                @foreach ($kriterias as $kriteria)
                                    @php
                                        $nilaiTerisi = $nilai_terisi[$alt->id][$kriteria->id][0]->nilai ?? '';
                                    @endphp
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                        <div class="relative">
                                            <input
                                                type="number"
                                                name="nilai[{{ $alt->id }}][{{ $kriteria->id }}]"
                                                value="{{ $nilaiTerisi }}"
                                                step="0.01"
                                                min="0"
                                                max="100"
                                                class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white transition-all duration-200 text-center"
                                                required
                                                data-alt-id="{{ $alt->id }}"
                                                data-kriteria-id="{{ $kriteria->id }}"
                                            >
                                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none opacity-0 peer-focus:opacity-100 transition-opacity duration-200">
                                                <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </div>
                                    </td>
                                @endforeach
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ 1 + $kriterias->count() }}" class="px-6 py-10 text-center text-gray-500 dark:text-gray-400">
                                    <div class="flex flex-col items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-400 dark:text-gray-500 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <p class="text-lg font-medium">Tidak ada alternatif yang tersedia.</p>
                                        <p class="text-sm mt-1">Silakan tambahkan alternatif terlebih dahulu.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-8 flex justify-between items-center">
                <a href="{{ route('user.select') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali
                </a>
                
                <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Simpan Nilai
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Function to reset all input values
    function resetForm() {
        if (confirm('Apakah Anda yakin ingin mengatur ulang semua nilai?')) {
            const inputs = document.querySelectorAll('input[type="number"]');
            inputs.forEach(input => {
                input.value = '';
            });
        }
    }
    
    // Function to fill random values
    function fillRandom() {
        if (confirm('Apakah Anda yakin ingin mengisi nilai secara acak?')) {
            const inputs = document.querySelectorAll('input[type="number"]');
            inputs.forEach(input => {
                // Generate random number between 0 and 100, with 2 decimal places
                const randomValue = (Math.random() * 100).toFixed(2);
                input.value = randomValue;
                
                // Add animation effect
                input.classList.add('bg-yellow-50', 'dark:bg-yellow-900');
                setTimeout(() => {
                    input.classList.remove('bg-yellow-50', 'dark:bg-yellow-900');
                }, 500);
            });
        }
    }
    
    // Add input validation and visual feedback
    document.addEventListener('DOMContentLoaded', function() {
        const inputs = document.querySelectorAll('input[type="number"]');
        
        inputs.forEach(input => {
            // Validate on input
            input.addEventListener('input', function() {
                const value = parseFloat(this.value);
                
                if (isNaN(value)) {
                    this.classList.add('border-red-500');
                    return;
                }
                
                if (value < 0) {
                    this.value = 0;
                } else if (value > 100) {
                    this.value = 100;
                }
                
                this.classList.remove('border-red-500');
                this.classList.add('border-green-500');
                
                setTimeout(() => {
                    this.classList.remove('border-green-500');
                }, 1000);
            });
            
            // Add focus animation
            input.addEventListener('focus', function() {
                this.classList.add('scale-105');
                this.parentElement.classList.add('z-10');
            });
            
            input.addEventListener('blur', function() {
                this.classList.remove('scale-105');
                this.parentElement.classList.remove('z-10');
            });
        });
        
        // Add staggered animation to table rows
        const rows = document.querySelectorAll('tbody tr');
        rows.forEach((row, index) => {
            row.style.opacity = '0';
            row.style.transform = 'translateY(10px)';
            setTimeout(() => {
                row.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                row.style.opacity = '1';
                row.style.transform = 'translateY(0)';
            }, 50 * index);
        });
    });
</script>

<style>
    /* Add smooth scaling transition for inputs */
    input[type="number"] {
        transition: all 0.2s ease;
    }
    
    /* Hide number input arrows */
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    input[type="number"] {
        -moz-appearance: textfield;
    }
</style>
@endsection