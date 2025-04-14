<?php

// Load Composer's autoloader
require_once __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__.'/../bootstrap/app.php';

// Set up the Laravel environment (optional, if not set up)
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

// Ensure DB facade is accessible
use Illuminate\Support\Facades\DB;

try {
    // Example database query to test the connection
    $result = DB::select("SELECT * FROM users LIMIT 1");
    echo "Database connection successful. Query result: ";
    print_r($result);
} catch (Exception $e) {
    echo "Koneksi ke database gagal: " . $e->getMessage();
}
