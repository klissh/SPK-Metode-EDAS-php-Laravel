<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\SubKriteriaController;
use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\NilaiAlternatifController;
use App\Http\Controllers\EDASController;
use App\Http\Controllers\JenisAnalisisController;
use App\Http\Controllers\UserController; // ← Tambahan controller untuk user

// ✅ Halaman awal langsung ke pemilihan jenis_analisis (tanpa login)
Route::get('/', [UserController::class, 'selectJenisAnalisis'])->name('user.select');

// ✅ Halaman hasil perhitungan untuk jenis_analisis tertentu
Route::get('/perhitungan/{id}', [UserController::class, 'tampilkanPerhitungan'])->name('user.perhitungan');
Route::post('/perhitungan/{id}/simpan', [UserController::class, 'simpanNilai'])->name('user.simpan-nilai');
Route::get('/user/ranking/{id}', [UserController::class, 'tampilkanRanking'])->name('user.ranking');


// ✅ Route admin setelah login
Route::middleware(['auth'])->group(function () {

    // ✅ Dashboard: redirect ke jenis analisis admin
    Route::get('/dashboard', function () {
        return redirect()->route('jenis-analisis.index');
    })->middleware(['verified'])->name('dashboard');


    // ✅ Jenis Analisis (CRUD hanya admin)
    Route::resource('/jenis-analisis', JenisAnalisisController::class);
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

    // ✅ Perhitungan EDAS untuk admin
    Route::get('/perhitungan', [EDASController::class, 'index'])->name('edas.index');
});

// ✅ Auth routes (login saja, tanpa register untuk user publik)
require __DIR__.'/auth.php';
