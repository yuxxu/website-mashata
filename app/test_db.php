<?php

// Autoload Composer
require_once __DIR__.'/../vendor/autoload.php';

// Inisialisasi Capsule (Database Manager)
use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

// Konfigurasi koneksi database menggunakan .env
$capsule->addConnection([
    'driver' => 'mysql',
    'host' => 'centerbeam.proxy.rlwy.net',
    'port' => 50611,
    'database' => 'railway',
    'username' => 'root',
    'password' => 'mppEgkgjLMWVHwwXezpuFBtglJzDLmvK',
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => '',
]);

// Menginisialisasi Eloquent dan mengaktifkan database
$capsule->setAsGlobal();
$capsule->bootEloquent();

try {
    // Coba koneksi ke database
    $result = Capsule::connection()->getPdo();
    echo "Koneksi ke database berhasil!";
} catch (Exception $e) {
    echo "Koneksi ke database gagal: " . $e->getMessage();
}
