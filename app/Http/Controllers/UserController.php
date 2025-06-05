<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisAnalisis;
use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\NilaiAlternatif;

class UserController extends Controller
{
    public function selectJenisAnalisis()
    {
        $jenis_analisis = JenisAnalisis::all();
        return view('user.select', compact('jenis_analisis'));
    }

    public function tampilkanPerhitungan($id)
    {
        session(['jenis_analisis_id' => $id]);
        $jenis_analisis = JenisAnalisis::findOrFail($id);

        $kriterias = Kriteria::where('jenis_analisis_id', $id)->get();
        $alternatifs = Alternatif::where('jenis_analisis_id', $id)->get();

        $nilai_terisi = NilaiAlternatif::whereIn('alternatif_id', $alternatifs->pluck('id'))
            ->whereIn('kriteria_id', $kriterias->pluck('id'))
            ->get()
            ->groupBy(['alternatif_id', 'kriteria_id']);

        return view('user.perhitungan', compact(
            'jenis_analisis',
            'alternatifs',
            'kriterias',
            'nilai_terisi'
        ));
    }

    public function simpanNilai(Request $request, $id)
    {
        $request->validate([
            'nilai' => 'required|array',
        ]);

        foreach ($request->nilai as $alternatif_id => $kriteria_nilai) {
            foreach ($kriteria_nilai as $kriteria_id => $nilai) {
                if (!is_null($nilai)) {
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

        return redirect()->route('user.perhitungan', $id)
            ->with('success', 'Nilai berhasil disimpan!');
    }

    public function tampilkanRanking($id)
    {
        session(['jenis_analisis_id' => $id]);
        $jenis_analisis = JenisAnalisis::findOrFail($id);
        $kriterias = Kriteria::where('jenis_analisis_id', $id)->get();
        $alternatifs = Alternatif::where('jenis_analisis_id', $id)->get();

        $data = [];
        foreach ($alternatifs as $alt) {
            foreach ($kriterias as $kri) {
                $nilai = NilaiAlternatif::where('alternatif_id', $alt->id)
                    ->where('kriteria_id', $kri->id)
                    ->first();

                $data[$alt->code][$kri->code] = $nilai?->nilai ?? 0;
            }
        }

        // Rata-rata
        $rata2 = [];
        foreach ($kriterias as $kri) {
            $total = 0;
            foreach ($alternatifs as $alt) {
                $total += $data[$alt->code][$kri->code];
            }
            $rata2[$kri->code] = count($alternatifs) ? $total / count($alternatifs) : 0;
        }

        // PDA & NDA
        $pda = $nda = [];
        foreach ($alternatifs as $alt) {
            foreach ($kriterias as $kri) {
                $nilai = $data[$alt->code][$kri->code];
                $av = $rata2[$kri->code];

                if ($av == 0) {
                    $pda[$alt->code][$kri->code] = 0;
                    $nda[$alt->code][$kri->code] = 0;
                    continue;
                }

                $attr = $kri->atribut ?? $kri->tipe;
                if ($attr === 'benefit') {
                    $pda[$alt->code][$kri->code] = max(0, ($nilai - $av) / $av);
                    $nda[$alt->code][$kri->code] = max(0, ($av - $nilai) / $av);
                } else {
                    $pda[$alt->code][$kri->code] = max(0, ($av - $nilai) / $av);
                    $nda[$alt->code][$kri->code] = max(0, ($nilai - $av) / $av);
                }
            }
        }

        // SP & SN
        $SP = $SN = [];
        $totalBobot = $kriterias->sum('bobot');

        foreach ($alternatifs as $alt) {
            $sumPDA = $sumNDA = 0;
            foreach ($kriterias as $kri) {
                $sumPDA += $pda[$alt->code][$kri->code] * $kri->bobot;
                $sumNDA += $nda[$alt->code][$kri->code] * $kri->bobot;
            }
            $SP[$alt->code] = $totalBobot ? $sumPDA / $totalBobot : 0;
            $SN[$alt->code] = $totalBobot ? $sumNDA / $totalBobot : 0;
        }

        // NSP, NSN, AS
        $maxSP = max($SP) ?: 1;
        $maxSN = max($SN) ?: 1;

        $NSP = $NSN = $AS = [];

        foreach ($alternatifs as $alt) {
            $code = $alt->code;
            $NSP[$code] = $SP[$code] / $maxSP;
            $NSN[$code] = 1 - ($SN[$code] / $maxSN);
            $AS[$code] = 0.5 * ($NSP[$code] + $NSN[$code]);
        }

        // Ranking
        $ranking = [];
        foreach ($alternatifs as $alt) {
            $ranking[] = [
                'nama' => $alt->nama_alternatif,
                'as' => round($AS[$alt->code], 4)
            ];
        }

        usort($ranking, fn($a, $b) => $b['as'] <=> $a['as']);

        return view('user.ranking', compact('ranking'));
    }
}
