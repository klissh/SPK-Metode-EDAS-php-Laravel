<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPK EDAS</title>

    {{-- Vite & Tailwind CSS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Font Inter --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>

<body class="bg-gray-50 text-gray-900 dark:bg-gray-900 dark:text-white min-h-screen flex flex-col transition-colors duration-300">

    {{-- Theme Toggle --}}
    <script>
        if (localStorage.getItem('darkMode') === 'true' ||
            (!localStorage.getItem('darkMode') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }
    </script>

    {{-- Navbar --}}
    <nav class="bg-white dark:bg-gray-800 text-gray-800 dark:text-white shadow sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-blue-600 rounded flex justify-center items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <span class="text-lg font-bold bg-gradient-to-r from-blue-600 to-blue-400 bg-clip-text text-transparent">SPK EDAS</span>
            </div>
            <div class="hidden md:flex gap-6">
                @if (!request()->routeIs('user.select'))
                    <a href="{{ url('/') }}" class="hover:text-blue-600 dark:hover:text-blue-400 transition">Beranda</a>
                @endif
                @if (session('jenis_analisis_id'))
                    <a href="{{ route('user.perhitungan', session('jenis_analisis_id')) }}" class="hover:text-blue-600 dark:hover:text-blue-400 transition">Nilai_Alternatif</a>
                    <a href="{{ route('user.ranking', session('jenis_analisis_id')) }}" class="hover:text-blue-600 dark:hover:text-blue-400 transition">Ranking</a>
                @endif
            </div>
            <button onclick="toggleMobileMenu()" class="md:hidden text-gray-700 dark:text-gray-200 hover:text-blue-600 dark:hover:text-blue-400">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>

        {{-- Mobile --}}
        <div id="mobile-menu" class="hidden md:hidden px-4 py-2">
            @if (!request()->routeIs('user.select'))
                <a href="{{ url('/') }}" class="block py-2 hover:text-blue-600">Beranda</a>
            @endif
            @if (session('jenis_analisis_id'))
                <a href="{{ route('user.perhitungan', session('jenis_analisis_id')) }}" class="block py-2 hover:text-blue-600">Nilai_Alternatif</a>
                <a href="{{ route('user.ranking', session('jenis_analisis_id')) }}" class="block py-2 hover:text-blue-600">Ranking</a>
            @endif
        </div>
    </nav>

    {{-- Main --}}
    <main class="flex-grow max-w-7xl mx-auto px-4 py-6">
        <div class="bg-white dark:bg-gray-800 shadow rounded p-6">
            @yield('content')
        </div>
    </main>

    <script>
        function toggleMobileMenu() {
            const m = document.getElementById('mobile-menu');
            m.classList.toggle('hidden');
        }
    </script>
</body>
</html>
