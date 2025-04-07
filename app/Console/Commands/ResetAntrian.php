<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Antrian;

class ResetAntrian extends Command
{
    protected $signature = 'reset:antrian';
    protected $description = 'Reset data antrian setiap hari';

    public function handle()
    {
        // Hapus semua data antrian
        Antrian::truncate(); // hati-hati, ini hapus semua!

        // Atau, kalau mau ganti status aja:
        // Antrian::update(['status' => 'belum check-up']);

        $this->info('Data antrian berhasil di-reset.');
    }
        
}
