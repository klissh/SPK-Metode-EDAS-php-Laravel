<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kriteria;
use App\Models\Alternatif;
use App\Models\JenisAnalisis;
use App\Models\NilaiAlternatif;

class NilaiAlternatifController extends Controller
{
    // ✅ Tampilkan form input nilai alternatif
    public function index()
    {
        if (!session('jenis_analisis_id')) {
        return redirect()->route('jenis-analisis.index')->with('error', 'Silakan pilih jenis analisis terlebih dahulu.');}
        $jenis_analisis_id = session('jenis_analisis_id');
        $jenis_analisis = JenisAnalisis::find($jenis_analisis_id);
        $jenisAnalisisId = session('jenis_analisis_id');

        $kriterias = Kriteria::with('subKriterias')
            ->where('jenis_analisis_id', $jenisAnalisisId)
            ->get();

        $alternatifs = Alternatif::where('jenis_analisis_id', $jenisAnalisisId)->get();

        $nilai_terisi = NilaiAlternatif::whereIn('alternatif_id', $alternatifs->pluck('id'))
            ->whereIn('kriteria_id', $kriterias->pluck('id'))
            ->get()
            ->groupBy(['alternatif_id', 'kriteria_id']);

        return view('nilai_alternatif.index', compact('kriterias', 'alternatifs', 'nilai_terisi', 'jenis_analisis'));
    }

    // ✅ Simpan nilai alternatif
    public function store(Request $request)
    {
        $request->validate([
            'nilai' => 'required|array',
        ]);

        foreach ($request->nilai as $alternatif_id => $kriteria_nilai) {
            foreach ($kriteria_nilai as $kriteria_id => $sub_kriteria_id) {
                if ($sub_kriteria_id !== null) {
                    NilaiAlternatif::updateOrCreate(
                        [
                            'alternatif_id' => (int) $alternatif_id,
                            'kriteria_id' => (int) $kriteria_id,
                        ],
                        [
                            'sub_kriteria_id' => (int) $sub_kriteria_id
                        ]
                    );
                }
            }
        }

        return redirect()->route('nilai.index')->with('success', 'Nilai berhasil disimpan.');
    }
}
