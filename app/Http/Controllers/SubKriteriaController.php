<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\SubKriteria;
use Illuminate\Http\Request;

class SubKriteriaController extends Controller
{
    // ✅ Tampilkan sub-kriteria berdasarkan kriteria_id
    public function index($kriteria_id)
    {
        $kriteria = Kriteria::findOrFail($kriteria_id);
        $subkriterias = SubKriteria::where('kriteria_id', $kriteria_id)->get();

        return view('sub_kriteria.index', compact('kriteria', 'subkriterias'));
    }

    // ✅ Tampilkan form tambah sub-kriteria
    public function create($kriteria_id)
    {
        $kriteria = Kriteria::findOrFail($kriteria_id);

        return view('sub_kriteria.create', compact('kriteria'));
    }

    // ✅ Simpan sub-kriteria baru
    public function store(Request $request)
    {
        $request->validate([
            'kriteria_id' => 'required|exists:kriterias,id',
            'nama_sub' => 'required|string|max:255',
            'nilai' => 'required|integer|min:1',
        ]);

        SubKriteria::create([
            'kriteria_id' => $request->kriteria_id,
            'nama_sub' => $request->nama_sub,
            'nilai' => $request->nilai,
        ]);

        return redirect()->route('sub-kriteria.index', ['kriteria_id' => $request->kriteria_id])
                         ->with('success', 'Sub kriteria berhasil ditambahkan.');
    }

    // ✅ Hapus sub-kriteria berdasarkan ID
    public function destroy($id)
    {
        $sub = SubKriteria::findOrFail($id);
        $kriteria_id = $sub->kriteria_id;

        $sub->delete();

        return redirect()->route('sub-kriteria.index', ['kriteria_id' => $kriteria_id])
                         ->with('success', 'Sub kriteria berhasil dihapus.');
    }
}
