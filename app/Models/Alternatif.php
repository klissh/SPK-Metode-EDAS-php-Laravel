<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Alternatif extends Model
{
    use HasFactory;

    // ✅ Tidak perlu override primaryKey karena pakai 'id' default

    protected $fillable = ['code', 'nama_alternatif', 'jenis_analisis_id'];

    // ✅ Relasi ke Jenis Analisis
    public function jenisAnalisis()
    {
        return $this->belongsTo(JenisAnalisis::class);
    }

    // ✅ Relasi ke Nilai Alternatif
    public function nilaiAlternatifs()
    {
        return $this->hasMany(NilaiAlternatif::class, 'alternatif_id');
    }
}
