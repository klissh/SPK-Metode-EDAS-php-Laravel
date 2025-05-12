<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | SPK EDAS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet" />
    <style>
        /* Custom toggle switch style */
        .toggle-checkbox:checked {
            right: 0;
            border-color: #10b981;
            background-color: #10b981;
        }
        .toggle-checkbox {
            transition: all 0.3s ease-in-out;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-emerald-50 to-indigo-50 flex justify-center items-center min-h-screen">

    <div class="w-[420px] bg-white rounded-2xl shadow-xl p-8 transform hover:shadow-2xl transition-all duration-300">
        <div class="mb-8 text-center">
            <div class="h-16 w-16 bg-gradient-to-r from-emerald-500 to-indigo-600 rounded-full mx-auto mb-4 flex items-center justify-center shadow-lg">
                <span class="material-symbols-outlined text-white text-3xl">person</span>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">Masuk ke Akun Anda</h2>
            <p class="text-gray-500 text-sm mt-2">Silakan masukkan kredensial Anda untuk melanjutkan</p>
        </div>

        @if(session('status'))
            <div class="mb-4 text-green-600 text-sm">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-5">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                        <span class="material-symbols-outlined text-lg">mail</span>
                    </span>
                    <input id="email" name="email" type="email" value="{{ old('email') }}"
                           class="pl-10 pr-4 py-3 w-full bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200 outline-none"
                           placeholder="mail@youremail.com" required autofocus />
                </div>
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-5">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                        <span class="material-symbols-outlined text-lg">lock</span>
                    </span>
                    <input id="password" name="password" type="password"
                           class="pl-10 pr-4 py-3 w-full bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200 outline-none"
                           placeholder="••••••••" required />
                </div>
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Toggle "Ingat saya" -->
            <div class="flex items-center mb-5">
                <div class="relative inline-block w-12 mr-2 align-middle select-none transition duration-200 ease-in">
                    <input type="checkbox" name="remember" id="remember_me"
                           class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 border-gray-300 appearance-none cursor-pointer {{ old('remember') ? 'checked' : '' }}"
                           {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember_me"
                           class="block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                </div>
                <label for="remember_me" class="text-sm text-gray-600 cursor-pointer select-none">
                    Ingat saya
                </label>
            </div>

            <div class="flex justify-between text-sm mb-6">
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="text-emerald-600 hover:underline">Belum punya akun? Daftar</a>
                @endif
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-blue-600 hover:underline">Lupa password?</a>
                @endif
            </div>

            <button type="submit"
                    class="w-full py-3 px-4 bg-gradient-to-r from-emerald-500 to-indigo-600 text-white font-semibold rounded-lg shadow hover:from-emerald-600 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transform hover:-translate-y-0.5 transition-all duration-300">
                <div class="flex items-center justify-center">
                    <span class="material-symbols-outlined mr-2">login</span> <span>login Masuk</span>
                </div>
            </button>
        </form>
    </div>
</body>
</html>
