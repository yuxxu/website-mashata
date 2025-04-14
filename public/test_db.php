<?php

// Menggunakan konfigurasi Laravel untuk koneksi DB
use Illuminate\Support\Facades\DB;

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';

// Mengambil koneksi database
try {
    $result = DB::connection()->getPdo();
    echo "Koneksi ke database berhasil!";
} catch (\Exception $e) {
    echo "Koneksi ke database gagal: " . $e->getMessage();
}
