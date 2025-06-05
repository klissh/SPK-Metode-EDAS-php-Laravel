<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kriteria;
use App\Models\Alternatif;
use App\Models\JenisAnalisis;
use App\Models\NilaiAlternatif;

class NilaiAlternatifController extends Controller
{
    public function index()
    {
        if (!session('jenis_analisis_id')) {
            return redirect()->route('jenis-analisis.index')->with('error', 'Silakan pilih jenis analisis terlebih dahulu.');
        }

        $jenis_analisis_id = session('jenis_analisis_id');
        $jenis_analisis = JenisAnalisis::find($jenis_analisis_id);

        $kriterias = Kriteria::where('jenis_analisis_id', $jenis_analisis_id)->get();
        $alternatifs = Alternatif::where('jenis_analisis_id', $jenis_analisis_id)->get();

        $nilai_terisi = NilaiAlternatif::whereIn('alternatif_id', $alternatifs->pluck('id'))
            ->whereIn('kriteria_id', $kriterias->pluck('id'))
            ->get()
            ->groupBy(['alternatif_id', 'kriteria_id']);

        return view('nilai_alternatif.index', compact('kriterias', 'alternatifs', 'nilai_terisi', 'jenis_analisis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nilai' => 'required|array',
            'nilai.*.*' => 'nullable|numeric|min:0|max:100',
        ]);

        // Simpan untuk keperluan debug di JS Console
        $debug_log = [];

        foreach ($request->nilai as $alternatif_id => $kriteria_nilai) {
            foreach ($kriteria_nilai as $kriteria_id => $nilai) {
                $debug_log[] = [
                    'alternatif_id' => $alternatif_id,
                    'kriteria_id' => $kriteria_id,
                    'nilai' => $nilai,
                    'valid' => is_numeric($nilai)
                ];

                if (is_numeric($nilai)) {
                    NilaiAlternatif::updateOrCreate(
                        [
                            'alternatif_id' => (int) $alternatif_id,
                            'kriteria_id'   => (int) $kriteria_id,
                        ],
                        [
                            'nilai' => (float) $nilai
                        ]
                    );
                }
            }
        }

        // Kirim log ke view agar bisa ditampilkan di inspect console
        session()->flash('debug_console', $debug_log);

        return redirect()->route('nilai.index')->with('success', 'Nilai berhasil disimpan.');
    }
}
