<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Poli;

class PoliSeeder extends Seeder
{
    public function run()
    {
        Poli::create([
            'nama_poli' => 'Poli Umum',
            'deskripsi' => 'Layanan kesehatan umum',
            'image' => 'poli-umum.png'
        ]);

        Poli::create([
            'nama_poli' => 'Poli Gigi',
            'deskripsi' => 'Layanan kesehatan gigi',
            'image' => 'poli-gigi.png'
        ]);

        Poli::create([
            'nama_poli' => 'Poli KIA',
            'deskripsi' => 'Layanan kesehatan ibu & anak',
            'image' => 'poli-kia.png'
        ]);

        Poli::create([
            'nama_poli' => 'Poli Gizi',
            'deskripsi' => 'Layanan kesehatan gizi',
            'image' => 'poli-gizi.png'
        ]);

        Poli::create([
            'nama_poli' => 'Poli Lansia',
            'deskripsi' => 'Layanan kesehatan lansia',
            'image' => 'poli-tuwa.png'
        ]);

        Poli::create([
            'nama_poli' => 'Poli Kulit',
            'deskripsi' => 'Layanan kesehatan kulit',
            'image' => 'poli-kulit.png'
        ]);

        // Tambahkan data poli lainnya sesuai kebutuhan
    }
}

