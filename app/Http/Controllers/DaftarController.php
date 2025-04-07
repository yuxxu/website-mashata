<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Antrian;
use App\Models\Pasien;
use App\Models\Poli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Pastikan Auth digunakan

class DaftarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Pastikan hanya user yang login bisa mengakses controller ini
    }

    public function index($poliId)
    {
        $poli = Poli::find($poliId);

        if (!$poli) {
            return redirect('/')->with('error', 'Poli tidak ditemukan');
        }

        return view('daftar', compact('poli'));
    }
    
    public function daftarPasien(Request $request)
    {
        $user = Auth::user(); // Mengambil user yang sedang login
    
        $pasien = Pasien::create([
            'user_id' => $user->id,
            'nama' => $request->nama,
            'nik' => $request->nik,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
        ]);
    

        // Masukkan pasien ke antrian
        Antrian::create([
            'pasien_id' => $pasien->id,
            'poli_id' => $request->poli_id,
            'nomor_antrian' => Antrian::where('poli_id', $request->poli_id)->count() + 1,
            'status' => 'Belum Check-up',
        ]);

    return redirect()->route('antrian')->with('success', 'Pendaftaran berhasil! Anda masuk ke dalam antrian.');
}

}

