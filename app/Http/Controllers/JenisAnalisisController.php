<?php

namespace App\Http\Controllers;

use App\Models\JenisAnalisis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JenisAnalisisController extends Controller
{
    // ✅ Tampilkan semua data jenis analisis milik user yang login
    public function index()
    {
        $data = JenisAnalisis::where('user_id', Auth::id())->get();
        return view('jenis_analisis.index', compact('data'));
    }

    // ✅ Tampilkan form tambah jenis analisis
    public function create()
    {
        return view('jenis_analisis.create');
    }

    // ✅ Simpan jenis analisis baru milik user yang login
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        JenisAnalisis::create([
            'nama' => $request->nama,
            'user_id' => Auth::id(), // Simpan ID user yang login
        ]);

        return redirect()->route('jenis-analisis.index')->with('success', 'Jenis analisis berhasil ditambahkan!');
    }

    // ✅ Tampilkan form edit jenis analisis
    public function edit(JenisAnalisis $jenisAnalisi)
    {
        return view('jenis_analisis.edit', [
            'jenisAnalisis' => $jenisAnalisi
        ]);
    }

    // ✅ Update jenis analisis (hanya nama yang boleh diubah)
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

    // ✅ Tampilkan form pemilihan jenis analisis (hanya yang milik user)
    public function pilih()
    {
        $data = JenisAnalisis::where('user_id', Auth::id())->get();
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
