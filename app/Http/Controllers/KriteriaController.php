<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\JenisAnalisis;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KriteriaController extends Controller
{
    public function index()
    {
        if (!session('jenis_analisis_id')) {
        return redirect()->route('jenis-analisis.index')->with('error', 'Silakan pilih jenis analisis terlebih dahulu.');}
        $jenis_analisis_id = session('jenis_analisis_id');
        $jenis_analisis = JenisAnalisis::find($jenis_analisis_id);
        $kriterias = Kriteria::where('jenis_analisis_id', session('jenis_analisis_id'))->get();
        return view('kriteria.index', compact('kriterias', 'jenis_analisis'));
    }

    public function create()
    {
        return view('kriteria.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => [
                'required',
                Rule::unique('kriterias')->where(fn($query) =>
                    $query->where('jenis_analisis_id', session('jenis_analisis_id'))
                )
            ],
            'nama_kriteria' => 'required|string|max:255',
            'tipe' => 'required|in:benefit,cost',
            'bobot' => 'required|numeric|min:0|max:100',
        ]);

        $bobotDesimal = $request->bobot / 100;

        $totalBobot = Kriteria::where('jenis_analisis_id', session('jenis_analisis_id'))->sum('bobot') + $bobotDesimal;

        if (round($totalBobot, 4) > 1) {
            return redirect()->back()->withInput()->withErrors([
                'bobot' => 'Total bobot seluruh kriteria tidak boleh melebihi 100%.'
            ]);
        }

        Kriteria::create([
            'code' => $request->code,
            'nama_kriteria' => $request->nama_kriteria,
            'tipe' => $request->tipe,
            'bobot' => $bobotDesimal,
            'jenis_analisis_id' => session('jenis_analisis_id'),
        ]);

        return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kriteria = Kriteria::findOrFail($id);
        return view('kriteria.edit', compact('kriteria'));
    }

    public function update(Request $request, $id)
    {
        $kriteria = Kriteria::findOrFail($id);

        $request->validate([
            'nama_kriteria' => 'required|string|max:255',
            'tipe' => 'required|in:benefit,cost',
            'bobot' => 'required|numeric|min:0|max:100',
        ]);

        $bobotDesimal = $request->bobot / 100;

        $totalBobot = Kriteria::where('jenis_analisis_id', session('jenis_analisis_id'))
            ->where('id', '!=', $id)
            ->sum('bobot') + $bobotDesimal;

        if (round($totalBobot, 4) > 1) {
            return redirect()->back()->withInput()->withErrors([
                'bobot' => 'Total bobot seluruh kriteria tidak boleh melebihi 100%.'
            ]);
        }

        $kriteria->update([
            'nama_kriteria' => $request->nama_kriteria,
            'tipe' => $request->tipe,
            'bobot' => $bobotDesimal,
        ]);

        return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Kriteria::destroy($id);
        return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil dihapus.');
    }
}
