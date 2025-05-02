<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubKriteria extends Model
{
    use HasFactory;

    protected $fillable = ['kriteria_id', 'nama_sub', 'nilai'];

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'kriteria_id');
    }
}
