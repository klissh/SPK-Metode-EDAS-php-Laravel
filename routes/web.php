<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\SubKriteriaController;
use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\NilaiAlternatifController;
use App\Http\Controllers\EDASController;
use App\Http\Controllers\JenisAnalisisController;
use Illuminate\Support\Facades\Route;

// Halaman awal: redirect ke login/dashboard
Route::get('/', function () {
    return redirect('/dashboard');
});

// ✅ Dashboard: redirect ke pemilihan jenis analisis
Route::get('/dashboard', function () {
    return redirect()->route('pilih-jenis-analisis');
})->middleware(['auth', 'verified'])->name('dashboard');

// ✅ Semua route ini hanya bisa diakses setelah login
Route::middleware(['auth'])->group(function () {

    // ✅ CRUD Profile (default dari Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ✅ Jenis Analisis CRUD
    Route::resource('/jenis-analisis', JenisAnalisisController::class);

    // ✅ Pemilihan Jenis Analisis
    Route::get('/pilih-jenis-analisis', [JenisAnalisisController::class, 'pilih'])->name('pilih-jenis-analisis');
    Route::post('/set-jenis-analisis', [JenisAnalisisController::class, 'set'])->name('set-jenis-analisis');

    // ✅ Kriteria
    Route::resource('/kriteria', KriteriaController::class);

    // ✅ Sub-Kriteria
    Route::get('/sub-kriteria/{kriteria_id}', [SubKriteriaController::class, 'index'])->name('sub-kriteria.index');
    Route::get('/sub-kriteria/{kriteria_id}/create', [SubKriteriaController::class, 'create'])->name('sub-kriteria.create');
    Route::post('/sub-kriteria', [SubKriteriaController::class, 'store'])->name('sub-kriteria.store');
    Route::delete('/sub-kriteria/{id}', [SubKriteriaController::class, 'destroy'])->name('sub-kriteria.destroy');

    // ✅ Alternatif
    Route::resource('alternatif', AlternatifController::class);

    // ✅ Nilai Alternatif
    Route::get('/nilai-alternatif', [NilaiAlternatifController::class, 'index'])->name('nilai.index');
    Route::post('/nilai-alternatif/simpan', [NilaiAlternatifController::class, 'store'])->name('nilai.store');

    // ✅ EDAS
    Route::get('/perhitungan', [EDASController::class, 'index'])->name('edas.index');
});

require __DIR__.'/auth.php';
