<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kriteria extends Model
{
    use HasFactory;

    // Tidak perlu override primaryKey karena pakai default 'id'

    protected $fillable = ['code', 'nama_kriteria', 'tipe', 'bobot', 'jenis_analisis_id'];

    // ✅ Relasi ke Jenis Analisis
    public function jenisAnalisis()
    {
        return $this->belongsTo(JenisAnalisis::class);
    }

    // ✅ Relasi ke Sub Kriteria
    public function subKriterias()
    {
        return $this->hasMany(SubKriteria::class, 'kriteria_id');
    }

    // ✅ Relasi ke Nilai Alternatif
    public function nilaiAlternatifs()
    {
        return $this->hasMany(NilaiAlternatif::class, 'kriteria_id');
    }
}
