<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JenisAnalisis extends Model
{
    use HasFactory;

    // ✅ Spesifikasikan nama tabel secara eksplisit
    protected $table = 'jenis_analisis';

    // ✅ Tentukan kolom yang bisa diisi secara massal (mass assignment)
    protected $fillable = ['nama'];
}
