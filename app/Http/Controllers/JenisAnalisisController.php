<?php

namespace App\Http\Controllers;

use App\Models\JenisAnalisis;
use Illuminate\Http\Request;

class JenisAnalisisController extends Controller
{
    // ✅ Tampilkan semua data jenis analisis
    public function index()
    {
        $data = JenisAnalisis::all();
        return view('jenis_analisis.index', compact('data'));
    }

    // ✅ Tampilkan form tambah jenis analisis
    public function create()
    {
        return view('jenis_analisis.create');
    }

    // ✅ Simpan jenis analisis baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        JenisAnalisis::create($request->only('nama'));

        return redirect()->route('jenis-analisis.index')->with('success', 'Jenis analisis berhasil ditambahkan!');
    }

    // ✅ Tampilkan form edit jenis analisis
    public function edit(JenisAnalisis $jenisAnalisi) // perhatikan: route binding pakai singular jenisAnalisi
    {
        return view('jenis_analisis.edit', [
            'jenisAnalisis' => $jenisAnalisi
        ]);
    }

    // ✅ Update jenis analisis
    public function update(Request $request, JenisAnalisis $jenisAnalisi)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $jenisAnalisi->update($request->only('nama'));

        return redirect()->route('jenis-analisis.index')->with('success', 'Jenis analisis berhasil diperbarui!');
    }

    // ✅ Hapus jenis analisis
    public function destroy(JenisAnalisis $jenisAnalisi)
    {
        $jenisAnalisi->delete();

        return redirect()->route('jenis-analisis.index')->with('success', 'Jenis analisis berhasil dihapus!');
    }

    // ✅ Tampilkan form pemilihan jenis analisis
    public function pilih()
    {
        $data = JenisAnalisis::all();
        return view('jenis_analisis.pilih', compact('data'));
    }

    // ✅ Simpan pilihan jenis analisis ke session
    public function set(Request $request)
    {
        $request->validate([
            'jenis_analisis_id' => 'required|exists:jenis_analisis,id',
        ]);

        session(['jenis_analisis_id' => $request->jenis_analisis_id]);

        return redirect()->route('alternatif.index')->with('success', 'Jenis analisis berhasil dipilih.');
    }
}
