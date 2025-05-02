<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisAnalisis;
use App\Models\Alternatif;
use Illuminate\Validation\Rule;

class AlternatifController extends Controller
{
    public function index()
    {
        $jenis_analisis_id = session('jenis_analisis_id');
        $jenis_analisis = JenisAnalisis::find($jenis_analisis_id); // pastikan pakai model yang sesuai
        $alternatifs = Alternatif::where('jenis_analisis_id', session('jenis_analisis_id'))->get();
        return view('alternatif.index', compact('alternatifs', 'jenis_analisis'));
    }

    public function create()
    {
        return view('alternatif.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => [
                'required',
                Rule::unique('alternatifs')->where(fn($query) =>
                    $query->where('jenis_analisis_id', session('jenis_analisis_id'))
                )
            ],
            'nama_alternatif' => 'required|string|max:255',
        ]);

        Alternatif::create([
            'code' => $request->code,
            'nama_alternatif' => $request->nama_alternatif,
            'jenis_analisis_id' => session('jenis_analisis_id'),
        ]);

        return redirect()->route('alternatif.index')->with('success', 'Alternatif berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $alternatif = Alternatif::findOrFail($id);
        return view('alternatif.edit', compact('alternatif'));
    }

    public function update(Request $request, $id)
    {
        $alternatif = Alternatif::findOrFail($id);

        $request->validate([
            'nama_alternatif' => 'required|string|max:255',
        ]);

        $alternatif->update([
            'nama_alternatif' => $request->nama_alternatif,
        ]);

        return redirect()->route('alternatif.index')->with('success', 'Alternatif berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $alternatif = Alternatif::findOrFail($id);
        $alternatif->delete();

        return redirect()->route('alternatif.index')->with('success', 'Alternatif berhasil dihapus.');
    }
}
