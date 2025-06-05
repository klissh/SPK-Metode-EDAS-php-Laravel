@extends('layouts.user')

@section('content')
<div class="container mx-auto py-8 px-4">
    <div class="mb-8 animate-fadeIn">
        <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-2">Pilih Jenis Analisis</h2>
        <p class="text-gray-600 dark:text-gray-300 text-sm">Silakan pilih jenis analisis yang ingin Anda lakukan</p>
        <div class="h-1 w-20 bg-gradient-to-r from-blue-600 to-blue-400 rounded mt-2"></div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($jenis_analisis as $ja)
            <a href="{{ route('user.perhitungan', $ja->id) }}" 
               class="group relative overflow-hidden bg-white dark:bg-gray-800 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 border border-gray-100 dark:border-gray-700 flex flex-col h-full">
                
                {{-- Card header with icon --}}
                <div class="p-5 border-b border-gray-100 dark:border-gray-700 flex items-center">
                    <div class="w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center mr-3 group-hover:bg-blue-500 dark:group-hover:bg-blue-600 transition-colors duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 dark:text-blue-300 group-hover:text-white transition-colors duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-800 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-300">{{ $ja->nama }}</h3>
                </div>
                
                {{-- Card body --}}
                <div class="p-5 flex-grow">
                    <p class="text-gray-600 dark:text-gray-300 text-sm">
                        {{ $ja->deskripsi ?? 'Analisis menggunakan metode EDAS (Evaluation based on Distance from Average Solution)' }}
                    </p>
                </div>
                
                {{-- Card footer --}}
                <div class="p-5 pt-0 flex justify-between items-center">
                   
                    <span class="inline-flex items-center text-sm font-medium text-blue-600 dark:text-blue-400 group-hover:translate-x-1 transition-transform duration-300">
                        Pilih
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </span>
                </div>
                
                {{-- Hover effect overlay --}}
                <div class="absolute inset-0 bg-gradient-to-r from-blue-600/5 to-blue-400/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none"></div>
                
                {{-- Animated border effect --}}
                <div class="absolute bottom-0 left-0 h-1 bg-gradient-to-r from-blue-600 to-blue-400 w-0 group-hover:w-full transition-all duration-500"></div>
            </a>
        @endforeach
    </div>
    
    {{-- Empty state if no analysis types are available --}}
    @if(count($jenis_analisis) === 0)
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-8 text-center animate-fadeIn">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400 dark:text-gray-500 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-2">Tidak Ada Jenis Analisis</h3>
            <p class="text-gray-500 dark:text-gray-400 mb-4">Belum ada jenis analisis yang tersedia saat ini.</p>
        </div>
    @endif
</div>

<script>
    // Add staggered animation to cards
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.grid > a');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            setTimeout(() => {
                card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, 100 * index);
        });
    });
</script>
@endsection