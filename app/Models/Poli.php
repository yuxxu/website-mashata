<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poli extends Model
{
    protected $table = 'poli';

    protected $fillable = ['nama_poli', 'deskripsi', 'image'];

    // ✅ Relasi ke model Antrian
    public function antrian()
    {
        return $this->hasMany(Antrian::class, 'poli_id');
    }
}
