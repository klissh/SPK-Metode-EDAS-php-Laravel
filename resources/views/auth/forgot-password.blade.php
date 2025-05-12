<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lupa Password | SPK EDAS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet" />
</head>
<body class="bg-gradient-to-br from-emerald-50 to-indigo-50 flex justify-center items-center min-h-screen">

    <div class="w-[420px] bg-white rounded-2xl shadow-xl p-8 transform hover:shadow-2xl transition-all duration-300">
        <div class="mb-8 text-center">
            <div class="h-16 w-16 bg-gradient-to-r from-emerald-500 to-indigo-600 rounded-full mx-auto mb-4 flex items-center justify-center shadow-lg">
                <span class="material-symbols-outlined text-white text-3xl">lock_reset</span>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">Lupa Password?</h2>
            <p class="text-gray-500 text-sm mt-2">
                Jangan khawatir. Masukkan email Anda dan kami akan mengirimkan link untuk mengatur ulang password.
            </p>
        </div>

        <!-- Status sukses kirim link -->
        @if (session('status'))
            <div class="mb-4 text-green-600 text-sm">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email -->
            <div class="mb-6">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                       class="pl-4 pr-4 py-3 w-full bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none" />
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tombol Submit -->
            <button type="submit"
                    class="w-full py-3 px-4 bg-gradient-to-r from-emerald-500 to-indigo-600 text-white font-semibold rounded-lg shadow hover:from-emerald-600 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transform hover:-translate-y-0.5 transition-all duration-300">
                <div class="flex items-center justify-center">
                    <span class="material-symbols-outlined mr-2">send</span>
                    <span>Kirim Link Reset Password</span>
                </div>
            </button>
        </form>

        <div class="text-center text-sm mt-6">
            <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800 hover:underline">
                ← Kembali ke Login
            </a>
        </div>
    </div>

</body>
</html>
