<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JenisAnalisis extends Model
{
    use HasFactory;

    // ✅ Nama tabel
    protected $table = 'jenis_analisis';

    // ✅ Kolom yang boleh diisi secara massal
    protected $fillable = ['nama', 'user_id'];

    // ✅ Relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
