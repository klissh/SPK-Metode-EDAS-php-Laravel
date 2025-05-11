<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Alternatif;
use App\Models\NilaiAlternatif;
use App\Models\JenisAnalisis;
use App\Models\SubKriteria;

class EDASController extends Controller
{
    public function index()
    {
        if (!session('jenis_analisis_id')) {
        return redirect()->route('jenis-analisis.index')->with('error', 'Silakan pilih jenis analisis terlebih dahulu.');}
        
        $jenisAnalisisId = session('jenis_analisis_id');
        $jenis_analisis_id = session('jenis_analisis_id');
        $jenis_analisis = JenisAnalisis::find($jenis_analisis_id); // pastikan pakai model yang sesuai

        $kriterias = Kriteria::where('jenis_analisis_id', $jenisAnalisisId)->get();
        $alternatifs = Alternatif::where('jenis_analisis_id', $jenisAnalisisId)->get();

        // Gunakan kode sebagai key utama
        $data = [];
        foreach ($alternatifs as $alt) {
            foreach ($kriterias as $kri) {
                $nilai = NilaiAlternatif::where('alternatif_id', $alt->id)
                    ->where('kriteria_id', $kri->id)
                    ->first();

                if ($nilai) {
                    $sub = SubKriteria::find($nilai->sub_kriteria_id);
                    $data[$alt->code][$kri->code] = $sub?->nilai ?? 0;
                } else {
                    $data[$alt->code][$kri->code] = 0;
                }
            }
        }

        // Hitung rata-rata
        $rata2 = [];
        foreach ($kriterias as $kri) {
            $total = 0;
            foreach ($alternatifs as $alt) {
                $total += $data[$alt->code][$kri->code];
            }
            $rata2[$kri->code] = count($alternatifs) ? $total / count($alternatifs) : 0;
        }

        // Hitung PDA dan NDA
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

                if ($kri->tipe === 'benefit') {
                    $pda[$alt->code][$kri->code] = max(0, ($nilai - $av) / $av);
                    $nda[$alt->code][$kri->code] = max(0, ($av - $nilai) / $av);
                } else {
                    $pda[$alt->code][$kri->code] = max(0, ($av - $nilai) / $av);
                    $nda[$alt->code][$kri->code] = max(0, ($nilai - $av) / $av);
                }
            }
        }

        // Hitung SP dan SN
        $SP = $SN = [];
        $totalBobot = $kriterias->sum('bobot');
        foreach ($alternatifs as $alt) {
            $sumPDA = $sumNDA = 0;
            foreach ($kriterias as $kri) {
                $bobot = $kri->bobot ?? 1;
                $sumPDA += $pda[$alt->code][$kri->code] * $bobot;
                $sumNDA += $nda[$alt->code][$kri->code] * $bobot;
            }

            $SP[$alt->code] = $totalBobot ? $sumPDA / $totalBobot : 0;
            $SN[$alt->code] = $totalBobot ? $sumNDA / $totalBobot : 0;
        }

        // Hitung NSP, NSN, AS
        $maxSP = max($SP) ?: 1;
        $maxSN = max($SN) ?: 1;
        $NSP = $NSN = $AS = [];

        foreach ($alternatifs as $alt) {
            $code = $alt->code;
            $NSP[$code] = $maxSP ? $SP[$code] / $maxSP : 0;
            $NSN[$code] = $maxSN ? 1 - ($SN[$code] / $maxSN) : 0;
            $AS[$code] = 0.5 * ($NSP[$code] + $NSN[$code]);
        }

        // Ranking
        $ranking = [];
        foreach ($AS as $code => $nilai) {
            $alt = $alternatifs->firstWhere('code', $code);
            $ranking[] = [
                'kode' => $code,
                'nama' => $alt->nama_alternatif ?? 'Tanpa Nama',
                'as' => $nilai
            ];
        }
        usort($ranking, fn($a, $b) => $b['as'] <=> $a['as']);

        return view('edas.index', compact(
            'kriterias', 'alternatifs', 'data', 'rata2', 'pda', 'nda',
            'SP', 'SN', 'NSP', 'NSN', 'AS', 'ranking', 'jenis_analisis'
        ));
    }
}
