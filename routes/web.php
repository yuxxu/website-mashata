<?php

use App\Http\Controllers\AdminAntrianController;
use App\Http\Controllers\AntrianController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DaftarController;
use App\Http\Controllers\PoliController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\UserController;
use App\Models\Antrian;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view ('landingpage');
});

Route::get('/test', function () {
    return 'Hosting berhasil!';
});


Route::get('/dashboard', function () {
    if (!Auth::check() || Auth::user()->role !== 'admin') {
        return redirect('/')->with('error', 'Akses ditolak.');
    }
    return view('admin.dashboard');
})->name('dashboard');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/admin/chart-data', [DashboardController::class, 'getChartData'])->name('chart.data');

Route::get('/admin/antrian', [AdminAntrianController::class, 'adminIndex'])->name('admin.antrian');
Route::get('/admin/antrian/create', [AdminAntrianController::class, 'create'])->name('admin.antrian.create');
Route::post('/admin/antrian/store', [AdminAntrianController::class, 'store'])->name('admin.antrian.store');
Route::get('/admin/antrian/{id}/edit', [AdminAntrianController::class, 'edit'])->name('admin.antrian.edit');
Route::put('/admin/antrian/{id}', [AdminAntrianController::class, 'update'])->name('admin.antrian.update');
Route::put('/admin/antrian/{id}/status', [AdminAntrianController::class, 'updateStatus'])->name('ubah.status');
Route::post('/reset-antrian', [AdminAntrianController::class, 'resetAntrian'])->name('admin.reset-antrian');
Route::get('/admin/antrian/download', [AdminAntrianController::class, 'downloadCsv'])->name('admin.antrian.download');
Route::delete('/poli/{id}', [PoliController::class, 'destroy'])->name('poli.destroy');



Route::get('/chart/pasien-per-poli', [DashboardController::class, 'getPasienPerPoli']);

Route::get('/admin/poli', [PoliController::class, 'index'])->name('poli.index');
Route::get('/admin/poli/create', [PoliController::class, 'create'])->name('poli.create');
Route::post('/admin/poli/store', [PoliController::class, 'store'])->name('poli.store');
Route::get('/admin/poli/edit/{id}', [PoliController::class, 'edit'])->name('poli.edit');
Route::post('/admin/poli/update/{id}', [PoliController::class, 'update'])->name('poli.update');

Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
Route::get('/admin/users/create', [UserController::class, 'create'])->name('admin.users.create');
Route::post('/admin/users', [UserController::class, 'store'])->name('admin.users.store');
Route::get('/admin/users/{id}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
Route::put('/admin/users/{id}', [UserController::class, 'update'])->name('admin.users.update');
Route::delete('/admin/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');

Route::middleware(['auth'])->group(function () {
    Route::get('/homepage', [HomeController::class, 'index'])->name('homepage');
    
    Route::get('/daftar/{poli}', [DaftarController::class, 'index'])->name('daftar');
    Route::post('/daftar', [DaftarController::class, 'daftarPasien'])->name('daftar.pasien');

    Route::get('/antrian', function () {
        return view ('antrian');
    });

    Route::get('/antrian', [AntrianController::class, 'index'])->name('antrian');
});


Route::get('/forgot-password', [PasswordResetController::class, 'showForgotForm'])->name('password.request');
Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [PasswordResetController::class, 'resetPassword'])->name('password.update');


Route::get('/login', function () {
    return view('auth.login'); // Sesuaikan dengan view login Anda
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('auth.authenticate');

Route::get('/signup', [AuthController::class, 'showSignupForm'])->name('signup');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');