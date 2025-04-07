<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poli extends Model
{
    // Menentukan nama tabel yang sesuai dengan database
    protected $table = 'poli'; // Pastikan nama tabelnya 'poli'

    // Definisikan kolom-kolom yang boleh diisi jika diperlukan
    protected $fillable = ['nama_poli', 'deskripsi', 'image']; 
}
