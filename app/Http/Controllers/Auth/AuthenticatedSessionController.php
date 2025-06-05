<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Http;

class AuthenticatedSessionController extends Controller
{
    /**
     * Tampilkan halaman login.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Proses permintaan login.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // ✅ 1. Validasi CAPTCHA
        $this->validateRecaptcha($request);

        // ✅ 2. Validasi throttle
        $this->checkRateLimit($request);

        // ✅ 3. Autentikasi
        $request->authenticate();

        // ✅ 4. Reset rate limit setelah login berhasil
        $request->session()->regenerate();
        RateLimiter::clear($this->throttleKey($request));

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Logout dan hancurkan sesi.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Cek apakah user sudah melebihi batas login.
     */
    protected function checkRateLimit(Request $request): void
    {
        $key = $this->throttleKey($request);

        if (RateLimiter::tooManyAttempts($key, 3)) {
            throw ValidationException::withMessages([
                'email' => Lang::get('Terlalu banyak percobaan login.'),
            ]);
        }

        RateLimiter::hit($key, 60); // diblokir selama 60 detik setelah 3x gagal
    }

    /**
     * Generate kunci rate limit berdasarkan email dan IP.
     */
    protected function throttleKey(Request $request): string
    {
        return Str::lower($request->input('email')).'|'.$request->ip();
    }

    /**
     * Validasi CAPTCHA reCAPTCHA v2.
     */
    protected function validateRecaptcha(Request $request): void
    {
        $recaptchaResponse = $request->input('g-recaptcha-response');

        if (!$recaptchaResponse) {
            throw ValidationException::withMessages([
                'g-recaptcha-response' => ['Silakan centang kotak reCAPTCHA.'],
            ]);
        }

        // ✅ Override SSL sertifikat secara manual untuk menghindari cURL error 60
        $response = Http::withOptions([
          'verify' => false,
        ])->asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
           'secret' => config('services.recaptcha.secret_key'),
            'response' => $request->input('g-recaptcha-response'),
           'remoteip' => $request->ip(),
        ]);


        if (!$response->json('success')) {
            throw ValidationException::withMessages([
                'g-recaptcha-response' => ['Verifikasi reCAPTCHA gagal.'],
            ]);
        }
    }
}
