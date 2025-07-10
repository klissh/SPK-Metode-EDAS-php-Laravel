@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">
    {{-- Header Section with Enhanced Animation --}}
    <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center p-4 bg-gradient-to-br from-blue-100 to-blue-50 rounded-full mb-4 transform hover:scale-110 hover:rotate-3 transition-all duration-300 shadow-md hover:shadow-lg">
           <i class="bi bi-bar-chart-fill text-blue-600 text-3xl animate-pulse"></i>
        </div>
        <h1 class="text-5xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-700 to-blue-500 mb-3 leading-normal">
        Hasil Perhitungan Metode EDAS
        </h1>
        <div class="mt-4 flex items-center justify-center flex-wrap gap-2">
             <span class="font-medium text-gray-700 text-base">Jenis Analisis:</span>
             <span class="inline-flex items-center px-5 py-2 rounded-full text-sm font-medium bg-blue-100 text-blue-800 shadow-sm border border-blue-200 hover:shadow-md hover:border-blue-300 transition-all duration-300 leading-tight min-h-[2.5rem]">
               {{ $jenis_analisis->nama ?? 'Tidak tersedia' }}
            </span>
        </div>
    </div>

    {{-- Enhanced Tab Navigation with Animations --}}
    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200 transform transition-all duration-300 hover:shadow-xl">
        <div class="relative">
            {{-- Mobile Dropdown --}}
            <div class="flex justify-between items-center border-b border-gray-200 bg-gradient-to-r from-gray-50 to-white px-4 md:hidden">
                <span class="py-3 font-medium text-blue-600 flex items-center">
                    <i class="bi bi-list mr-2 animate-bounce"></i> Navigasi
                </span>
                <button id="mobile-tab-dropdown" class="p-2 rounded-md hover:bg-gray-200 focus:outline-none transition-colors duration-200 hover:rotate-180 transform transition-transform">
                    <i class="bi bi-chevron-down text-gray-600"></i>
                </button>
            </div>

            {{-- Desktop Tabs with Enhanced Icons and Animations --}}
            <nav class="hidden md:flex border-b border-gray-200 bg-gradient-to-r from-blue-50 to-white" aria-label="Tabs">
                <div class="w-full flex overflow-x-auto scrollbar-hide">
                    <button class="group tab-btn flex items-center gap-2 px-6 py-4 text-sm font-medium border-b-2 border-transparent text-gray-600 hover:text-blue-600 whitespace-nowrap transition-all duration-200 hover:bg-blue-50" data-target="matriks">
                        <div class="tab-icon p-1.5 rounded-md bg-blue-100 text-blue-600 group-hover:bg-blue-200 transition-colors duration-200 flex items-center justify-center group-hover:rotate-12 transform transition-transform">
                            <i class="bi bi-grid-3x3 text-lg"></i>
                        </div>
                        <span class="tab-text relative">
                            Matriks Keputusan
                            <span class="tab-underline absolute -bottom-1 left-0 w-full h-0.5 bg-blue-600 transform scale-x-0 transition-transform origin-left"></span>
                        </span>
                    </button>
                    <button class="group tab-btn flex items-center gap-2 px-6 py-4 text-sm font-medium border-b-2 border-transparent text-gray-600 hover:text-blue-600 whitespace-nowrap transition-all duration-200 hover:bg-blue-50" data-target="pda-nda">
                        <div class="tab-icon p-1.5 rounded-md bg-green-100 text-green-600 group-hover:bg-green-200 transition-colors duration-200 flex items-center justify-center group-hover:rotate-12 transform transition-transform">
                            <i class="bi bi-arrow-left-right text-lg"></i>
                        </div>
                        <span class="tab-text relative">
                            PDA & NDA
                            <span class="tab-underline absolute -bottom-1 left-0 w-full h-0.5 bg-blue-600 transform scale-x-0 transition-transform origin-left"></span>
                        </span>
                    </button>
                    <button class="group tab-btn flex items-center gap-2 px-6 py-4 text-sm font-medium border-b-2 border-transparent text-gray-600 hover:text-blue-600 whitespace-nowrap transition-all duration-200 hover:bg-blue-50" data-target="scores">
                        <div class="tab-icon p-1.5 rounded-md bg-purple-100 text-purple-600 group-hover:bg-purple-200 transition-colors duration-200 flex items-center justify-center group-hover:rotate-12 transform transition-transform">
                            <i class="bi bi-calculator text-lg"></i>
                        </div>
                        <span class="tab-text relative">
                            Skor Penilaian
                            <span class="tab-underline absolute -bottom-1 left-0 w-full h-0.5 bg-blue-600 transform scale-x-0 transition-transform origin-left"></span>
                        </span>
                    </button>
                    <button class="group tab-btn flex items-center gap-2 px-6 py-4 text-sm font-medium border-b-2 border-transparent text-gray-600 hover:text-blue-600 whitespace-nowrap transition-all duration-200 hover:bg-blue-50" data-target="ranking">
                        <div class="tab-icon p-1.5 rounded-md bg-amber-100 text-amber-600 group-hover:bg-amber-200 transition-colors duration-200 flex items-center justify-center group-hover:rotate-12 transform transition-transform">
                            <i class="bi bi-trophy text-lg"></i>
                        </div>
                        <span class="tab-text relative">
                            Ranking
                            <span class="tab-underline absolute -bottom-1 left-0 w-full h-0.5 bg-blue-600 transform scale-x-0 transition-transform origin-left"></span>
                        </span>
                    </button>
                </div>
            </nav>

            {{-- Enhanced Mobile Tabs with Animations --}}
            <div id="mobile-tab-menu" class="hidden md:hidden absolute z-10 w-full bg-white border-b border-gray-200 shadow-md divide-y divide-gray-100 transform transition-all duration-300 origin-top scale-y-95 opacity-0" style="transform-origin: top center;">
                <button class="mobile-tab-btn w-full text-left px-4 py-3 flex items-center gap-2 text-gray-600 hover:bg-gray-50 transition-colors duration-200" data-target="matriks">
                    <i class="bi bi-grid-3x3 text-blue-600"></i> 
                    <span class="mobile-tab-text relative">
                        Matriks Keputusan
                        <span class="mobile-tab-underline absolute -bottom-1 left-0 w-0 h-0.5 bg-blue-600 transform scale-x-0 transition-transform origin-left"></span>
                    </span>
                </button>
                <button class="mobile-tab-btn w-full text-left px-4 py-3 flex items-center gap-2 text-gray-600 hover:bg-gray-50 transition-colors duration-200" data-target="pda-nda">
                    <i class="bi bi-arrow-left-right text-green-600"></i> 
                    <span class="mobile-tab-text relative">
                        PDA & NDA
                        <span class="mobile-tab-underline absolute -bottom-1 left-0 w-0 h-0.5 bg-blue-600 transform scale-x-0 transition-transform origin-left"></span>
                    </span>
                </button>
                <button class="mobile-tab-btn w-full text-left px-4 py-3 flex items-center gap-2 text-gray-600 hover:bg-gray-50 transition-colors duration-200" data-target="scores">
                    <i class="bi bi-calculator text-purple-600"></i> 
                    <span class="mobile-tab-text relative">
                        Skor Penilaian
                        <span class="mobile-tab-underline absolute -bottom-1 left-0 w-0 h-0.5 bg-blue-600 transform scale-x-0 transition-transform origin-left"></span>
                    </span>
                </button>
                <button class="mobile-tab-btn w-full text-left px-4 py-3 flex items-center gap-2 text-gray-600 hover:bg-gray-50 transition-colors duration-200" data-target="ranking">
                    <i class="bi bi-trophy text-amber-600"></i> 
                    <span class="mobile-tab-text relative">
                        Ranking
                        <span class="mobile-tab-underline absolute -bottom-1 left-0 w-0 h-0.5 bg-blue-600 transform scale-x-0 transition-transform origin-left"></span>
                    </span>
                </button>
            </div>

            {{-- Enhanced Step Progress with Animations --}}
            <div class="hidden md:flex justify-between items-center px-6 py-3 bg-gradient-to-r from-blue-50 to-white border-b border-gray-200">
                <div class="flex items-center space-x-2">
                    <div class="flex items-center">
                        <div class="h-3 w-3 rounded-full bg-blue-600 shadow-md shadow-blue-200 pulse-animation"></div>
                        <div class="h-[2px] w-14 bg-gradient-to-r from-blue-500 to-gray-300"></div>
                    </div>
                    <div class="flex items-center">
                        <div class="h-3 w-3 rounded-full bg-gray-300 tab-progress shadow-sm hover:shadow-md transition-shadow duration-200 hover:scale-125 transform transition-transform" data-for="pda-nda"></div>
                        <div class="h-[2px] w-14 bg-gray-300"></div>
                    </div>
                    <div class="flex items-center">
                        <div class="h-3 w-3 rounded-full bg-gray-300 tab-progress shadow-sm hover:shadow-md transition-shadow duration-200 hover:scale-125 transform transition-transform" data-for="scores"></div>
                        <div class="h-[2px] w-14 bg-gray-300"></div>
                    </div>
                    <div class="flex items-center">
                        <div class="h-3 w-3 rounded-full bg-gray-300 tab-progress shadow-sm hover:shadow-md transition-shadow duration-200 hover:scale-125 transform transition-transform" data-for="ranking"></div>
                    </div>
                </div>
                <div class="text-sm font-medium text-gray-700 bg-white px-3 py-1 rounded-full shadow-sm border border-gray-200 flex items-center hover:shadow-md hover:border-blue-200 transition-all duration-200 transform hover:-translate-y-1" id="tab-indicator">
                    <i class="bi bi-shoe-prints text-blue-600 mr-1 text-sm"></i> Langkah 1 dari 4
                </div>
            </div>
        </div>

        {{-- Tab Content with Enhanced Animations --}}
        <div class="p-6">
            {{-- 1. Matriks Keputusan Tab --}}
            <div id="matriks" class="tab-content active">
                <div class="mb-6">
                    <h2 class="text-xl font-semibold text-gray-800 flex items-center gap-2 mb-4">
                        <div class="p-1.5 bg-blue-100 rounded-md hover:bg-blue-200 transition-colors duration-200 transform hover:rotate-6 transition-transform">
                            <i class="bi bi-grid-3x3 text-blue-600"></i>
                        </div>
                        Matriks Keputusan
                    </h2>
                    <p class="text-gray-600 mb-4">
                        Matriks keputusan menampilkan nilai dari setiap alternatif terhadap setiap kriteria yang digunakan dalam analisis.
                    </p>
                    <div class="bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-md transition-shadow duration-300">
                        <x-edas.table 
                            title="Matriks Keputusan"
                            :data="$data" 
                            :kriterias="$kriterias" 
                            :alternatifs="$alternatifs" />
                    </div>
                </div>

                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 hover:shadow-md transition-shadow duration-300 transform hover:scale-[1.01] transition-transform">
                    <h3 class="font-semibold text-blue-800 mb-3 flex items-center gap-2">
                        <i class="bi bi-calculator text-blue-600"></i> Nilai Rata-rata Setiap Kriteria
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
                        @foreach ($rata2 as $code => $val)
                            @php
                                $kriteria = $kriterias->firstWhere('code', $code);
                            @endphp
                            <div class="bg-white rounded-lg p-3 border border-blue-100 shadow-sm hover:shadow-md hover:border-blue-300 transition-all duration-200 transform hover:-translate-y-1">
                                <div class="text-sm text-gray-500">{{ $kriteria ? $kriteria->nama_kriteria : 'Kriteria tidak ditemukan' }}</div>
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-700 font-medium">{{ $code }}</span>
                                    <span class="text-blue-700 font-bold">{{ number_format($val, 3) }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                
                {{-- Enhanced Navigation Buttons --}}
                <div class="mt-8 flex justify-end">
                    <button class="next-tab-btn px-5 py-2.5 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white font-medium rounded-lg shadow-sm hover:shadow-md transition-all duration-200 flex items-center transform hover:-translate-y-1 hover:scale-105" data-target="pda-nda">
                        Lanjut ke PDA & NDA 
                        <i class="bi bi-arrow-right ml-2 animate-bounce-x"></i>
                    </button>
                </div>
            </div>

            {{-- 2. PDA & NDA Tab --}}
            <div id="pda-nda" class="tab-content hidden">
                <div class="space-y-8">
                    {{-- PDA Section --}}
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800 flex items-center gap-2 mb-4">
                            <div class="p-1.5 bg-green-100 rounded-md hover:bg-green-200 transition-colors duration-200 transform hover:rotate-6 transition-transform">
                                <i class="bi bi-plus-circle-fill text-green-600"></i>
                            </div>
                            PDA (Positive Distance from Average)
                        </h2>
                        <p class="text-gray-600 mb-4">
                            PDA menunjukkan jarak positif dari nilai rata-rata untuk setiap alternatif terhadap setiap kriteria.
                        </p>
                        <div class="bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-md transition-shadow duration-300">
                            <x-edas.table 
                                title="PDA"
                                :data="$pda" 
                                :kriterias="$kriterias" 
                                :alternatifs="$alternatifs" />
                        </div>
                    </div>

                    {{-- NDA Section --}}
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800 flex items-center gap-2 mb-4">
                            <div class="p-1.5 bg-red-100 rounded-md hover:bg-red-200 transition-colors duration-200 transform hover:rotate-6 transition-transform">
                                <i class="bi bi-dash-circle-fill text-red-600"></i>
                            </div>
                            NDA (Negative Distance from Average)
                        </h2>
                        <p class="text-gray-600 mb-4">
                            NDA menunjukkan jarak negatif dari nilai rata-rata untuk setiap alternatif terhadap setiap kriteria.
                        </p>
                        <div class="bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-md transition-shadow duration-300">
                            <x-edas.table
                                title="NDA" 
                                :data="$nda" 
                                :kriterias="$kriterias" 
                                :alternatifs="$alternatifs" />
                        </div>
                    </div>
                    
                    {{-- Enhanced Navigation Buttons --}}
                    <div class="mt-8 flex justify-between">
                        <button class="prev-tab-btn px-5 py-2.5 bg-white hover:bg-gray-50 text-gray-700 font-medium rounded-lg border border-gray-300 shadow-sm hover:shadow-md transition-all duration-200 flex items-center transform hover:-translate-y-1" data-target="matriks">
                            <i class="bi bi-arrow-left mr-2 animate-bounce-x-reverse"></i> Kembali ke Matriks
                        </button>
                        <button class="next-tab-btn px-5 py-2.5 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white font-medium rounded-lg shadow-sm hover:shadow-md transition-all duration-200 flex items-center transform hover:-translate-y-1 hover:scale-105" data-target="scores">
                            Lanjut ke Skor Penilaian 
                            <i class="bi bi-arrow-right ml-2 animate-bounce-x"></i>
                        </button>
                    </div>
                </div>
            </div>

            {{-- 3. Scores Tab --}}
            <div id="scores" class="tab-content hidden">
                <h2 class="text-xl font-semibold text-gray-800 flex items-center gap-2 mb-4">
                    <div class="p-1.5 bg-purple-100 rounded-md hover:bg-purple-200 transition-colors duration-200 transform hover:rotate-6 transition-transform">
                        <i class="bi bi-graph-up text-purple-600"></i>
                    </div>
                    Skor Penilaian (SP, SN, NSP, NSN, AS)
                </h2>
                <p class="text-gray-600 mb-4">
                    Tabel ini menampilkan nilai SP (Sum of Positive), SN (Sum of Negative), NSP (Normalized SP), NSN (Normalized SN), dan AS (Appraisal Score) untuk setiap alternatif.
                </p>
                
                <div class="bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-md transition-shadow duration-300">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr class="bg-gradient-to-r from-gray-50 to-white">
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alternatif</th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">SP</th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">SN</th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">NSP</th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">NSN</th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">AS</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($alternatifs as $alt)
                                    @php $code = $alt->code; @endphp
                                    <tr class="hover:bg-blue-50 transition-colors duration-200">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10 flex items-center justify-center bg-blue-100 text-blue-600 rounded-full transform hover:scale-110 transition-transform duration-200">
                                                    {{ substr($code, 0, 1) }}
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">{{ $code }}</div>
                                                    <div class="text-sm text-gray-500">{{ $alt->nama_alternatif }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <span class="px-2 py-1 text-sm text-green-800 bg-green-100 rounded-md hover:bg-green-200 transition-colors duration-200 inline-flex items-center justify-center">
                                                <i class="bi bi-plus text-green-600 mr-1 text-xs"></i>
                                                {{ number_format($SP[$code] ?? 0, 3) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <span class="px-2 py-1 text-sm text-red-800 bg-red-100 rounded-md hover:bg-red-200 transition-colors duration-200 inline-flex items-center justify-center">
                                                <i class="bi bi-dash text-red-600 mr-1 text-xs"></i>
                                                {{ number_format($SN[$code] ?? 0, 3) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <span class="px-2 py-1 text-sm text-green-800 bg-green-50 rounded-md hover:bg-green-100 transition-colors duration-200 inline-flex items-center justify-center">
                                                <i class="bi bi-arrows-collapse text-green-600 mr-1 text-xs"></i>
                                                {{ number_format($NSP[$code] ?? 0, 3) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <span class="px-2 py-1 text-sm text-red-800 bg-red-50 rounded-md hover:bg-red-100 transition-colors duration-200 inline-flex items-center justify-center">
                                                <i class="bi bi-arrows-collapse text-red-600 mr-1 text-xs"></i>
                                                {{ number_format($NSN[$code] ?? 0, 3) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <span class="px-3 py-1.5 text-sm font-medium text-blue-800 bg-blue-100 rounded-lg hover:bg-blue-200 transition-colors duration-200 inline-flex items-center justify-center transform hover:scale-110 transition-transform">
                                                <i class="bi bi-star-fill text-blue-600 mr-1 text-xs"></i>
                                                {{ number_format($AS[$code] ?? 0, 3) }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <div class="mt-4 bg-gray-50 border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow duration-300">
                    <h3 class="font-medium text-gray-700 mb-2 flex items-center">
                        <i class="bi bi-info-circle text-gray-600 mr-2"></i> Keterangan:
                    </h3>
                    <ul class="space-y-1 text-sm text-gray-600">
                        <li class="flex items-center hover:bg-gray-100 px-2 py-1 rounded-md transition-colors duration-200">
                            <i class="bi bi-plus-circle-fill text-green-600 mr-2 text-sm"></i>
                            <span class="font-medium">SP</span> - Sum of Positive (Jumlah jarak positif)
                        </li>
                        <li class="flex items-center hover:bg-gray-100 px-2 py-1 rounded-md transition-colors duration-200">
                            <i class="bi bi-dash-circle-fill text-red-600 mr-2 text-sm"></i>
                            <span class="font-medium">SN</span> - Sum of Negative (Jumlah jarak negatif)
                        </li>
                        <li class="flex items-center hover:bg-gray-100 px-2 py-1 rounded-md transition-colors duration-200">
                            <i class="bi bi-arrows-collapse text-green-600 mr-2 text-sm"></i>
                            <span class="font-medium">NSP</span> - Normalized SP (SP yang dinormalisasi)
                        </li>
                        <li class="flex items-center hover:bg-gray-100 px-2 py-1 rounded-md transition-colors duration-200">
                            <i class="bi bi-arrows-collapse text-red-600 mr-2 text-sm"></i>
                            <span class="font-medium">NSN</span> - Normalized SN (SN yang dinormalisasi)
                        </li>
                        <li class="flex items-center hover:bg-gray-100 px-2 py-1 rounded-md transition-colors duration-200">
                            <i class="bi bi-star-fill text-blue-600 mr-2 text-sm"></i>
                            <span class="font-medium">AS</span> - Appraisal Score (Skor penilaian akhir)
                        </li>
                    </ul>
                </div>
                
                {{-- Enhanced Navigation Buttons --}}
                <div class="mt-8 flex justify-between">
                    <button class="prev-tab-btn px-5 py-2.5 bg-white hover:bg-gray-50 text-gray-700 font-medium rounded-lg border border-gray-300 shadow-sm hover:shadow-md transition-all duration-200 flex items-center transform hover:-translate-y-1" data-target="pda-nda">
                        <i class="bi bi-arrow-left mr-2 animate-bounce-x-reverse"></i> Kembali ke PDA & NDA
                    </button>
                    <button class="next-tab-btn px-5 py-2.5 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white font-medium rounded-lg shadow-sm hover:shadow-md transition-all duration-200 flex items-center transform hover:-translate-y-1 hover:scale-105" data-target="ranking">
                        Lanjut ke Ranking 
                        <i class="bi bi-arrow-right ml-2 animate-bounce-x"></i>
                    </button>
                </div>
            </div>

            {{-- 4. Ranking Tab with Enhanced Animations --}}
            <div id="ranking" class="tab-content hidden">
                <h2 class="text-xl font-semibold text-gray-800 flex items-center gap-2 mb-4">
                    <div class="p-1.5 bg-amber-100 rounded-md hover:bg-amber-200 transition-colors duration-200 transform hover:rotate-6 transition-transform">
                        <i class="bi bi-trophy-fill text-amber-600"></i>
                    </div>
                    Ranking Alternatif
                </h2>
                <p class="text-gray-600 mb-4">
                    Berikut adalah ranking alternatif berdasarkan nilai Appraisal Score (AS) dari tertinggi ke terendah.
                </p>
                
                <div class="space-y-4">
                    @foreach ($ranking as $index => $alt)
                        <div class="bg-white border border-gray-200 rounded-lg p-4 flex items-center shadow-sm hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 hover:border-blue-200 {{ $index == 0 ? 'animate-pulse-subtle' : '' }}">
                            <div class="flex-shrink-0 mr-4">
                                @if($index == 0)
                                    <div class="h-12 w-12 flex items-center justify-center bg-gradient-to-br from-amber-200 to-amber-100 text-amber-600 rounded-full transform hover:scale-110 transition-transform duration-300 animate-pulse-slow">
                                        <i class="bi bi-trophy-fill text-2xl"></i>
                                    </div>
                                @elseif($index == 1)
                                    <div class="h-12 w-12 flex items-center justify-center bg-gradient-to-br from-gray-300 to-gray-200 text-gray-600 rounded-full transform hover:scale-110 transition-transform duration-300">
                                        <i class="bi bi-award-fill text-xl"></i>
                                    </div>
                                @elseif($index == 2)
                                    <div class="h-12 w-12 flex items-center justify-center bg-gradient-to-br from-amber-100 to-amber-50 text-amber-700 rounded-full transform hover:scale-110 transition-transform duration-300">
                                        <i class="bi bi-award text-xl"></i>
                                    </div>
                                @else
                                    <div class="h-12 w-12 flex items-center justify-center bg-gray-100 text-gray-500 rounded-full font-bold text-lg transform hover:scale-110 transition-transform duration-300">
                                        {{ $index + 1 }}
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                                            {{ $alt['kode'] }} - {{ $alt['nama'] }}
                                            @if($index == 0)
                                                <i class="bi bi-star-fill text-amber-500 ml-2 animate-bounce"></i>
                                            @endif
                                        </h3>
                                        <p class="text-sm text-gray-500 flex items-center">
                                            <i class="bi bi-tag-fill text-gray-400 mr-1 text-xs"></i>
                                            Alternatif #{{ $index + 1 }}
                                        </p>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-sm text-gray-500">Appraisal Score</div>
                                        <div class="text-lg font-bold text-blue-600 flex items-center justify-end">
                                            <i class="bi bi-graph-up text-blue-500 mr-1"></i>
                                            {{ number_format($alt['as'], 3) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-2 w-full bg-gray-200 rounded-full h-2.5 overflow-hidden">
                                    <div class="bg-gradient-to-r from-blue-600 to-blue-400 h-2.5 rounded-full progress-animation" style="width: {{ ($alt['as'] * 100) }}%"></div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                {{-- Enhanced Navigation Buttons --}}
                <div class="mt-8 flex justify-between">
                    <button class="prev-tab-btn px-5 py-2.5 bg-white hover:bg-gray-50 text-gray-700 font-medium rounded-lg border border-gray-300 shadow-sm hover:shadow-md transition-all duration-200 flex items-center transform hover:-translate-y-1" data-target="scores">
                        <i class="bi bi-arrow-left mr-2 animate-bounce-x-reverse"></i> Kembali ke Skor Penilaian
                    </button>
                    <a href="{{ route('jenis-analisis.index') }}"
                       class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-green-600 to-green-500 hover:from-green-700 hover:to-green-600 text-white font-medium rounded-lg shadow-sm hover:shadow-md transition-all duration-200 transform hover:-translate-y-1 hover:scale-105">
                        <i class="bi bi-check-circle-fill mr-2"></i> Selesai
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Enhanced Back Button --}}
    <div class="flex justify-end pt-4">
        <a href="{{ route('jenis-analisis.index') }}"
           class="inline-flex items-center px-5 py-2.5 bg-white hover:bg-gray-50 text-gray-700 font-medium rounded-lg border border-gray-300 shadow-sm hover:shadow-md transition-all duration-200 transform hover:-translate-y-1">
            <i class="bi bi-arrow-left-circle mr-2 text-gray-500"></i> Kembali ke Jenis Analisis
        </a>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Tab functionality
        const tabButtons = document.querySelectorAll('.tab-btn, .mobile-tab-btn');
        const tabContents = document.querySelectorAll('.tab-content');
        const tabProgress = document.querySelectorAll('.tab-progress');
        const tabIndicator = document.getElementById('tab-indicator');
        const mobileTabDropdown = document.getElementById('mobile-tab-dropdown');
        const mobileTabMenu = document.getElementById('mobile-tab-menu');
        const nextTabButtons = document.querySelectorAll('.next-tab-btn');
        const prevTabButtons = document.querySelectorAll('.prev-tab-btn');
        
        // Tab step mapping
        const tabSteps = {
            'matriks': 1,
            'pda-nda': 2,
            'scores': 3,
            'ranking': 4
        };
        
        // Function to switch tabs with enhanced animations
        function switchTab(targetId) {
            // Update tab buttons and their styling
            tabButtons.forEach(btn => {
                const btnTarget = btn.getAttribute('data-target');
                
                if (btnTarget === targetId) {
                    // Add active classes
                    btn.classList.add('active');
                    
                    // Update desktop tab styling
                    if (btn.classList.contains('tab-btn')) {
                        btn.classList.remove('border-transparent', 'text-gray-600');
                        btn.classList.add('border-blue-600', 'text-blue-600', 'bg-blue-50');
                        
                        // Update icon background for active tab
                        const icon = btn.querySelector('.tab-icon');
                        if (icon) {
                            icon.classList.add('bg-blue-200');
                        }
                        
                        // Show underline
                        const underline = btn.querySelector('.tab-underline');
                        if (underline) {
                            underline.style.transform = 'scale-x-100';
                        }
                    }
                    
                    // Update mobile tab styling
                    if (btn.classList.contains('mobile-tab-btn')) {
                        btn.classList.remove('text-gray-600');
                        btn.classList.add('bg-blue-50', 'text-blue-600', 'font-medium');
                        
                        // Show mobile underline
                        const mobileUnderline = btn.querySelector('.mobile-tab-underline');
                        if (mobileUnderline) {
                            mobileUnderline.style.transform = 'scale-x-100';
                        }
                    }
                } else {
                    // Remove active classes
                    btn.classList.remove('active');
                    
                    // Reset desktop tab styling
                    if (btn.classList.contains('tab-btn')) {
                        btn.classList.remove('border-blue-600', 'text-blue-600', 'bg-blue-50');
                        btn.classList.add('border-transparent', 'text-gray-600');
                        
                        // Reset icon background
                        const icon = btn.querySelector('.tab-icon');
                        if (icon) {
                            icon.classList.remove('bg-blue-200');
                        }
                        
                        // Hide underline
                        const underline = btn.querySelector('.tab-underline');
                        if (underline) {
                            underline.style.transform = 'scale-x-0';
                        }
                    }
                    
                    // Reset mobile tab styling
                    if (btn.classList.contains('mobile-tab-btn')) {
                        btn.classList.remove('bg-blue-50', 'text-blue-600', 'font-medium');
                        btn.classList.add('text-gray-600');
                        
                        // Hide mobile underline
                        const mobileUnderline = btn.querySelector('.mobile-tab-underline');
                        if (mobileUnderline) {
                            mobileUnderline.style.transform = 'scale-x-0';
                        }
                    }
                }
            });
            
            // Update tab contents with enhanced animations
            tabContents.forEach(content => {
                if (content.id === targetId) {
                    content.classList.remove('hidden');
                    setTimeout(() => {
                        content.classList.add('active');
                    }, 10);
                } else {
                    content.classList.remove('active');
                    setTimeout(() => {
                        content.classList.add('hidden');
                    }, 300);
                }
            });
            
            // Update progress indicators with animations
            tabProgress.forEach(progress => {
                const progressFor = progress.getAttribute('data-for');
                if (tabSteps[progressFor] <= tabSteps[targetId]) {
                    progress.classList.add('bg-blue-600');
                    progress.classList.remove('bg-gray-300');
                    progress.classList.add('scale-pulse');
                    setTimeout(() => {
                        progress.classList.remove('scale-pulse');
                    }, 500);
                } else {
                    progress.classList.remove('bg-blue-600');
                    progress.classList.add('bg-gray-300');
                }
            });
            
            // Update step indicator with animation
            if (tabIndicator) {
                tabIndicator.classList.add('scale-bounce');
                setTimeout(() => {
                    tabIndicator.innerHTML = `<i class="bi bi-shoe-prints text-blue-600 mr-1 text-sm"></i> Langkah ${tabSteps[targetId]} dari 4`;
                    tabIndicator.classList.remove('scale-bounce');
                }, 300);
            }
            
            // Close mobile menu if open
            if (mobileTabMenu && !mobileTabMenu.classList.contains('hidden')) {
                mobileTabMenu.classList.add('scale-y-95', 'opacity-0');
                setTimeout(() => {
                    mobileTabMenu.classList.add('hidden');
                    mobileTabMenu.classList.remove('scale-y-95', 'opacity-0');
                }, 300);
            }
        }
        
        // Tab button click handlers
        tabButtons.forEach(button => {
            button.addEventListener('click', () => {
                const targetId = button.getAttribute('data-target');
                switchTab(targetId);
            });
        });
        
        // Mobile dropdown toggle with animation
        if (mobileTabDropdown) {
            mobileTabDropdown.addEventListener('click', () => {
                if (mobileTabMenu.classList.contains('hidden')) {
                    mobileTabMenu.classList.remove('hidden');
                    mobileTabMenu.classList.add('scale-y-95', 'opacity-0');
                    setTimeout(() => {
                        mobileTabMenu.classList.remove('scale-y-95', 'opacity-0');
                        mobileTabMenu.classList.add('scale-y-100', 'opacity-100');
                    }, 10);
                } else {
                    mobileTabMenu.classList.remove('scale-y-100', 'opacity-100');
                    mobileTabMenu.classList.add('scale-y-95', 'opacity-0');
                    setTimeout(() => {
                        mobileTabMenu.classList.add('hidden');
                    }, 300);
                }
            });
        }
        
        // Next/Prev tab navigation
        nextTabButtons.forEach(button => {
            button.addEventListener('click', () => {
                const targetId = button.getAttribute('data-target');
                switchTab(targetId);
            });
        });
        
        prevTabButtons.forEach(button => {
            button.addEventListener('click', () => {
                const targetId = button.getAttribute('data-target');
                switchTab(targetId);
            });
        });
        
        // Initialize first tab
        switchTab('matriks');
    });
</script>

<style>
    /* Enhanced Tab styling */
    .tab-btn {
        @apply text-gray-600 hover:text-blue-600 py-4 px-6 text-sm font-medium border-b-2 border-transparent whitespace-nowrap flex items-center gap-2 transition-all duration-200;
    }
    
    .tab-btn.active {
        @apply text-blue-600 border-blue-600 bg-blue-50;
    }
    
    .tab-icon {
        @apply p-1.5 rounded-md flex items-center justify-center transition-all duration-200;
    }
    
    .tab-btn.active .tab-icon {
        @apply bg-blue-200;
    }
    
    .tab-underline {
        @apply transition-transform duration-300 ease-out;
    }
    
    .mobile-tab-btn {
        @apply py-3 px-4 text-gray-600 hover:bg-gray-50 transition-colors duration-200;
    }
    
    .mobile-tab-btn.active {
        @apply bg-blue-50 text-blue-600 font-medium;
    }
    
    .mobile-tab-underline {
        @apply transition-transform duration-300 ease-out;
    }
    
    /* Enhanced Content Animations */
    .tab-content {
        @apply transition-all duration-500 ease-in-out transform;
    }
    
    .tab-content.hidden {
        @apply opacity-0 translate-y-4;
    }
    
    .tab-content.active {
        @apply opacity-100 translate-y-0;
    }
    
    /* Custom Animations */
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
    @keyframes bounceX {
        0%, 100% { transform: translateX(0); }
        50% { transform: translateX(3px); }
    }
    
    @keyframes bounceXReverse {
        0%, 100% { transform: translateX(0); }
        50% { transform: translateX(-3px); }
    }
    
    @keyframes scalePulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.2); }
    }
    
    @keyframes progressAnimation {
        0% { transform: translateX(-100%); }
        100% { transform: translateX(0); }
    }
    
    @keyframes pulseSlow {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.7; }
    }
    
    @keyframes pulseSubtle {
        0%, 100% { box-shadow: 0 0 0 rgba(59, 130, 246, 0); }
        50% { box-shadow: 0 0 10px rgba(59, 130, 246, 0.3); }
    }
    
    .animate-fadeIn {
        animation: fadeIn 1s ease-in-out;
    }
    
    .animate-bounce-x {
        animation: bounceX 1s infinite;
    }
    
    .animate-bounce-x-reverse {
        animation: bounceXReverse 1s infinite;
    }
    
    .scale-pulse {
        animation: scalePulse 0.5s ease-in-out;
    }
    
    .scale-bounce {
        animation: scalePulse 0.3s ease-in-out;
    }
    
    .progress-animation {
        animation: progressAnimation 1s ease-out;
    }
    
    .animate-pulse-slow {
        animation: pulseSlow 2s infinite;
    }
    
    .animate-pulse-subtle {
        animation: pulseSubtle 2s infinite;
    }
    
    .pulse-animation {
        box-shadow: 0 0 0 0 rgba(59, 130, 246, 1);
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0% {
            box-shadow: 0 0 0 0 rgba(59, 130, 246, 0.7);
        }
        70% {
            box-shadow: 0 0 0 10px rgba(59, 130, 246, 0);
        }
        100% {
            box-shadow: 0 0 0 0 rgba(59, 130, 246, 0);
        }
    }
    
    /* Hide scrollbar for Chrome, Safari and Opera */
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }
    
    /* Hide scrollbar for IE, Edge and Firefox */
    .scrollbar-hide {
        -ms-overflow-style: none;  /* IE and Edge */
        scrollbar-width: none;  /* Firefox */
    }
</style>
@endpush
@endsection