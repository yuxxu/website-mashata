<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Antrian;
use App\Models\Pasien;
use App\Models\Poli;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminAntrianController extends Controller
{
    public function adminIndex(Request $request)
    {
        if (!Auth::check() || Auth::user()->role === 'pengguna') {
            return redirect('/')->with('error', 'Akses ditolak.');
        }

        $polis = Poli::all();
        $selectedPoli = $request->input('poli_id');

        $query = Antrian::with('pasien')->orderBy('nomor_antrian', 'asc');
        if ($selectedPoli) {
            $query->where('poli_id', $selectedPoli);
        }

        $antrian = $query->get();

        return view('admin.antrian.index', compact('polis', 'selectedPoli', 'antrian'));
    }

    public function updateStatus(Request $request, $id)
    {
        if (!Auth::check() || !in_array(Auth::user()->role, ['admin', 'dokter'])) {
            return redirect('/')->with('error', 'Akses ditolak.');
        }        

        $request->validate([
            'status' => 'required|in:belum check-up,sedang check-up,selesai',
        ]);

        $antrian = Antrian::findOrFail($id);
        $antrian->status = $request->status;
        $antrian->save();

        return redirect('/admin/antrian')->with('success', 'Status pasien berhasil diperbarui.');
    }

    public function resetAntrian()
    {
        // Matikan foreign key constraint sementara
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    
        // Kosongkan tabel antrian dan pasien
        Antrian::truncate();
        Pasien::truncate();
    
        // Aktifkan lagi foreign key constraint
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    
        return redirect()->back()->with('success', 'Semua antrian berhasil direset.');
    }
    

    public function create()
    {
        $poli = Poli::all();
        return view('admin.antrian.create', compact('poli'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'nama' => 'required|string',
            'nik' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string',
            'alamat' => 'required|string',
            'no_hp' => 'required|string',
            'poli_id' => 'required|exists:poli,id',
        ]);

        $pasien = Pasien::create([
            'user_id' => $user->id,
            'nama' => $request->nama,
            'nik' => $request->nik,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
        ]);

        $lastNo = Antrian::where('poli_id', $request->poli_id)->max('nomor_antrian') ?? 0;

        Antrian::create([
            'pasien_id' => $pasien->id,
            'poli_id' => $request->poli_id,
            'nomor_antrian' => $lastNo + 1,
            'status' => 'Belum Check-up',
        ]);

        return redirect('/admin/antrian')->with('success', 'Antrian berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $antrian = Antrian::with('pasien')->findOrFail($id);
        $poli = Poli::all();
        return view('admin.antrian.edit', compact('antrian', 'poli'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'nik' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'poli_id' => 'required',
            'status' => 'required',
        ]);

        $antrian = Antrian::findOrFail($id);
        $pasien = $antrian->pasien;

        $pasien->update([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
        ]);

        $antrian->update([
            'poli_id' => $request->poli_id,
            'status' => $request->status,
        ]);

        return redirect('/admin/antrian')->with('success', 'Antrian berhasil diupdate.');
    }

    public function downloadCsv()
    {
        $filename = 'data_antrian_' . now()->format('Ymd_His') . '.csv';

        $antrians = Antrian::with(['pasien', 'poli'])->orderBy('created_at', 'desc')->get();

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['Nomor Antrian', 'Nama Pasien', 'NIK', 'Tanggal Lahir', 'Jenis Kelamin', 'Alamat', 'No HP', 'Poli', 'Status'];

        $callback = function() use ($antrians, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($antrians as $antrian) {
                fputcsv($file, [
                    $antrian->nomor_antrian,
                    $antrian->pasien->nama,
                    $antrian->pasien->nik,
                    $antrian->pasien->tanggal_lahir,
                    $antrian->pasien->jenis_kelamin,
                    $antrian->pasien->alamat,
                    $antrian->pasien->no_hp,
                    $antrian->poli->nama_poli,
                    $antrian->status,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
