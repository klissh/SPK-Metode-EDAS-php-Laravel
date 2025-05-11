<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class CekJenisAnalisisDipilih
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Boleh diakses tanpa pilih jenis analisis
        if (
            $request->is('jenis-analisis') ||
            $request->is('jenis-analisis/*') ||
            $request->is('set-jenis-analisis') ||
            $request->is('profile*') ||
            $request->is('logout')
        ) {
            return $next($request);
        }

        // Jika belum memilih jenis analisis
        if (!Session::has('jenis_analisis_id')) {
            return redirect()->route('jenis-analisis.index')
                ->with('warning', 'Silakan pilih jenis analisis terlebih dahulu.');
        }

        return $next($request);
    }
}
