<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | SPK EDAS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script> <!-- Tambahan -->

    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet" />
    <style>
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
            <h2 class="text-2xl font-bold text-gray-800">SPK EDAS</h2>
            <p class="text-gray-500 text-sm mt-2">Masuk ke Akun Anda</p>
        </div>

        @if(session('status'))
            <div class="mb-4 text-green-600 text-sm">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}" id="loginForm">
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
                    <p class="mt-1 text-sm text-red-600" id="errorMessage">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-5">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                        <span class="material-symbols-outlined text-lg">lock</span>
                    </span>
                    <input id="password" name="password" type="password"
                           class="pl-10 pr-10 py-3 w-full bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200 outline-none"
                           placeholder="••••••••" required />
                    <span onclick="togglePassword()" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 cursor-pointer">
                        <i id="eyeIcon" class="fa-solid fa-eye"></i>
                    </span>
                </div>
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- CAPTCHA -->
            <div class="mb-4">
                <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
                @if ($errors->has('g-recaptcha-response'))
                    <p class="text-sm text-red-600 mt-2">{{ $errors->first('g-recaptcha-response') }}</p>
                @endif
            </div>

            <button id="submitButton" type="submit"
                    class="w-full py-3 px-4 bg-gradient-to-r from-emerald-500 to-indigo-600 text-white font-semibold rounded-lg shadow hover:from-emerald-600 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transform hover:-translate-y-0.5 transition-all duration-300">
                <div class="flex items-center justify-center">
                    <span class="material-symbols-outlined mr-2">login</span> <span>login Masuk</span>
                </div>
            </button>
        </form>

        <p id="cooldownMessage" class="text-sm text-red-600 text-center mt-4 hidden">
            Terlalu banyak percobaan login. Silakan coba lagi dalam <span id="countdown">60</span> detik.
        </p>
    </div>

    <script>
        function togglePassword() {
            const passwordField = document.getElementById("password");
            const eyeIcon = document.getElementById("eyeIcon");

            if (passwordField.type === "password") {
                passwordField.type = "text";
                eyeIcon.classList.remove("fa-eye");
                eyeIcon.classList.add("fa-eye-slash");
            } else {
                passwordField.type = "password";
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye");
            }
        }

        // Cek apakah ada error terkait terlalu banyak percobaan login
        const errorMessage = document.getElementById('errorMessage');
        if (errorMessage && errorMessage.innerText.includes('Terlalu banyak percobaan')) {
            const cooldownMessage = document.getElementById('cooldownMessage');
            const countdownSpan = document.getElementById('countdown');
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            const submitButton = document.getElementById('submitButton');

            cooldownMessage.classList.remove('hidden');

            const secondsMatch = errorMessage.innerText.match(/dalam (\d+) detik/);
            let seconds = secondsMatch ? parseInt(secondsMatch[1]) : 60;

            emailInput.disabled = true;
            passwordInput.disabled = true;
            submitButton.disabled = true;
            submitButton.classList.add('opacity-50', 'cursor-not-allowed');

            const interval = setInterval(() => {
                seconds--;
                countdownSpan.innerText = seconds;

                if (seconds <= 0) {
                    clearInterval(interval);
                    emailInput.disabled = false;
                    passwordInput.disabled = false;
                    submitButton.disabled = false;
                    submitButton.classList.remove('opacity-50', 'cursor-not-allowed');
                    cooldownMessage.classList.add('hidden');
                }
            }, 1000);
        }
    </script>

</body>
</html>
