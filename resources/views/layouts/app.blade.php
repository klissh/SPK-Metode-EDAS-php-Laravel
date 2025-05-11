<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SPK EDAS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- ✅ Tambahkan ini untuk Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="font-sans bg-gradient-to-r from-gray-100 to-gray-200 min-h-screen">

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 h-screen fixed bg-gradient-to-b from-slate-800 to-slate-900 shadow-xl">
            <div class="flex flex-col h-full">
                <div class="px-6 py-8">
                    <h1 class="text-2xl font-bold text-white flex items-center gap-2 hover:scale-105 transition-all">
                        <svg class="w-7 h-7 text-emerald-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                        SPK EDAS
                    </h1>
                </div>

                <!-- Navigation -->
                <nav class="flex-grow px-4 pb-4">
                    <ul class="space-y-1">
                        <li>
                            <a href="{{ route('alternatif.index') }}"
                               class="flex items-center gap-3 px-4 py-3 rounded-lg transition hover:bg-slate-700/50 hover:text-emerald-400 hover:translate-x-1 group {{ request()->is('alternatif*') ? 'text-emerald-400 bg-slate-700/50' : 'text-gray-300' }}">
                                <span class="bg-slate-700/30 p-2 rounded-lg group-hover:bg-emerald-400/20">
                                    <i class="bi bi-calculator-fill"></i>
                                </span>
                                Data Alternatif
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('kriteria.index') }}"
                               class="flex items-center gap-3 px-4 py-3 rounded-lg transition hover:bg-slate-700/50 hover:text-emerald-400 hover:translate-x-1 group {{ request()->is('kriteria*') ? 'text-emerald-400 bg-slate-700/50' : 'text-gray-300' }}">
                                <span class="bg-slate-700/30 p-2 rounded-lg group-hover:bg-emerald-400/20">
                                    <i class="bi bi-sliders2-vertical"></i>
                                </span>
                                Data Kriteria
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('nilai.index') }}"
                               class="flex items-center gap-3 px-4 py-3 rounded-lg transition hover:bg-slate-700/50 hover:text-emerald-400 hover:translate-x-1 group {{ request()->is('nilai-alternatif*') ? 'text-emerald-400 bg-slate-700/50' : 'text-gray-300' }}">
                                <span class="bg-slate-700/30 p-2 rounded-lg group-hover:bg-emerald-400/20">
                                    <i class="bi bi-pencil-square"></i>
                                </span>
                                Nilai Alternatif
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('edas.index') }}"
                               class="flex items-center gap-3 px-4 py-3 rounded-lg transition hover:bg-slate-700/50 hover:text-emerald-400 hover:translate-x-1 group {{ request()->is('perhitungan') ? 'text-emerald-400 bg-slate-700/50' : 'text-gray-300' }}">
                                <span class="bg-slate-700/30 p-2 rounded-lg group-hover:bg-emerald-400/20">
                                    <i class="bi bi-bar-chart-fill"></i>
                                </span>
                                Hasil Perhitungan
                            </a>
                        </li>
                    </ul>
                </nav>

                <!-- Bottom Buttons -->
                <div class="px-4 mb-6 space-y-4">
                    <a href="{{ route('jenis-analisis.index') }}"
                       class="flex items-center justify-center gap-2 bg-gradient-to-r from-emerald-500 to-teal-600 text-white py-3 px-4 rounded-lg shadow-lg hover:shadow-emerald-500/30 hover:-translate-y-1 transition">
                        <i class="bi bi-plus-circle-fill"></i>
                        Pilih Analisis
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="flex w-full items-center justify-center gap-2 bg-gradient-to-r from-rose-500 to-red-600 text-white py-3 px-4 rounded-lg shadow-lg hover:shadow-rose-500/30 hover:-translate-y-1 transition">
                            <i class="bi bi-box-arrow-right"></i>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Konten -->
        <main class="ml-64 flex-1 p-8 transition-all duration-300">
            <div class="bg-white rounded-xl shadow-md p-6 min-h-[80vh]">
                @yield('content')
            </div>
        </main>
    </div>
@stack('scripts')
</body>
</html>
