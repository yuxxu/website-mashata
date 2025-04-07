<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antrian extends Model
{
    use HasFactory;

    protected $table = 'antrian'; // Nama tabel dalam database
    
    protected $fillable = [
        'pasien_id',
        'poli_id',
        'nomor_antrian',
        'status',
        'tanggal_antrian',
        'updated_by'
    ];

    // Relasi ke tabel Pasien
    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'pasien_id');
    }

    // Relasi ke tabel Poli
    public function poli()
    {
        return $this->belongsTo(Poli::class, 'poli_id');
    }

        // Relasi ke tabel User
        public function user()
        {
            return $this->belongsTo(User::class, 'user_id');
        }

    // Relasi ke tabel Users (dokter/admin yang memperbarui status)
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}

