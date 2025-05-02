<div class="flex h-screen bg-gray-100">
    <!-- Sidebar -->
    <aside class="w-64 bg-white border-r shadow-lg">
        <div class="h-20 flex items-center justify-center border-b">
            <a href="{{ route('dashboard') }}" class="text-2xl font-bold text-indigo-600">
                <x-application-logo class="h-10 w-auto" />
            </a>
        </div>
        <nav class="mt-6">
            <ul class="space-y-1 px-4 text-gray-700">
                <!-- Dashboard -->
                <li>
                    <a href="{{ route('dashboard') }}"
                       class="flex items-center px-4 py-2 rounded-lg transition duration-200 hover:bg-indigo-100
                              {{ request()->routeIs('dashboard') ? 'bg-indigo-100 text-indigo-600 font-semibold' : '' }}">
                        📊
                        <span class="ml-3">Dashboard</span>
                    </a>
                </li>
                <!-- Jenis Analisis -->
                <li>
                    <a href="{{ route('jenis-analisis.index') }}"
                       class="flex items-center px-4 py-2 rounded-lg transition duration-200 hover:bg-indigo-100
                              {{ request()->is('jenis-analisis*') ? 'bg-indigo-100 text-indigo-600 font-semibold' : '' }}">
                        🧩
                        <span class="ml-3">Jenis Analisis</span>
                    </a>
                </li>
                <!-- Tambahan menu lain jika perlu -->
            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
        <!-- Topbar -->
        <header class="h-20 bg-white shadow flex items-center justify-end px-6">
            <div class="relative">
                <button class="flex items-center space-x-2 focus:outline-none" id="userDropdownButton">
                    <span class="text-gray-700 font-medium">👤 {{ Auth::user()->name }}</span>
                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div id="userDropdownMenu"
                     class="hidden absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-md z-50">
                    <a href="{{ route('profile.edit') }}"
                       class="block px-4 py-2 text-gray-700 hover:bg-gray-100">⚙️ Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-50">
                            🚪 Logout
                        </button>
                    </form>
                </div>
            </div>
        </header>

        <!-- Slot konten utama -->
        <main class="flex-1 p-6 bg-gray-50 overflow-auto">
            {{ $slot }}
        </main>
    </div>
</div>

<script>
    // Toggle user dropdown
    document.getElementById('userDropdownButton').addEventListener('click', function () {
        const menu = document.getElementById('userDropdownMenu');
        menu.classList.toggle('hidden');
    });
</script>
