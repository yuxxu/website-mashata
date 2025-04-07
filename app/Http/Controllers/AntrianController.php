<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\Poli;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Tambahkan use Auth

class AntrianController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user(); // Gunakan Auth::user()
        $selectedPoli = $request->input('poli_id', null); // Ambil ID poli dari request

        // Ambil total antrian untuk poli yang dipilih
        $totalAntrian = $selectedPoli ? Antrian::where('poli_id', $selectedPoli)->count() : 0;

        // Hitung jumlah pasien berdasarkan status
        $sudahCheckUp = $selectedPoli ? Antrian::where('poli_id', $selectedPoli)->where('status', 'Selesai')->count() : 0;
        $belumCheckUp = $selectedPoli ? Antrian::where('poli_id', $selectedPoli)->where('status', 'Belum Check-up')->count() : 0;

        // Cari nomor antrian pasien saat ini (jika ada)
        $antrianPasien = $selectedPoli ? Antrian::where('poli_id', $selectedPoli)
            ->whereHas('pasien', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->first() : null;

        $nomorAntrianPasien = $antrianPasien ? $antrianPasien->nomor_antrian : 'Belum Terdaftar';

        // Ambil daftar poli
        $polis = Poli::all();

        // Ambil daftar antrian berdasarkan poli yang dipilih
        $antrian = $selectedPoli ? Antrian::where('poli_id', $selectedPoli)->with('pasien')->get() : collect([]);

        return view('antrian', compact(
            'polis', 'antrian', 'selectedPoli', 
            'totalAntrian', 'nomorAntrianPasien', 
            'sudahCheckUp', 'belumCheckUp'
        ));
    }

}
