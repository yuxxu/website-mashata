<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Antrian;
use App\Models\Poli;

class AdminAntrianController extends Controller
{
    public function adminIndex(Request $request)
    {
        // Cek apakah pengguna adalah admin
        if (!Auth::check() || Auth::user()->role === 'pengguna') {
            return redirect('/')->with('error', 'Akses ditolak.');
        }

        // Ambil daftar poli
        $polis = Poli::all();
        $selectedPoli = $request->input('poli_id');

        // Query antrian berdasarkan poli (jika dipilih)
        $query = Antrian::with('pasien')->orderBy('nomor_antrian', 'asc');
        if ($selectedPoli) {
            $query->where('poli_id', $selectedPoli);
        }

        $antrian = $query->get();

        return view('admin.antrian', compact('polis', 'selectedPoli', 'antrian'));
    }

    public function updateStatus(Request $request, $id)
    {
        // Cek apakah pengguna adalah admin
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'Akses ditolak.');
        }

        $request->validate([
            'status' => 'required|in:belum check-up,sedang check-up,selesai',
        ]);

        $antrian = Antrian::findOrFail($id);
        $antrian->status = $request->status;
        $antrian->save();

        return redirect()->route('admin.antrian')->with('success', 'Status pasien berhasil diperbarui.');
    }
}

