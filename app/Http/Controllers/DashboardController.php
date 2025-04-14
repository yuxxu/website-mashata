<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Antrian;
use App\Models\Poli;
use Illuminate\Support\Facades\Auth; // tambahkan ini di atas


class DashboardController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
    
        $totalPasien = Antrian::count();
        $hariIni = now()->toDateString();

        $sudahCheckup = Antrian::whereDate('created_at', $hariIni)->where('status', 'selesai')->count();
        $sedangCheckup = Antrian::whereDate('created_at', $hariIni)->where('status', 'sedang check-up')->count();
        $belumCheckup = Antrian::whereDate('created_at', $hariIni)->where('status', 'belum check-up')->count();
    
        // Ambil jumlah pasien per poli untuk hari ini
        $jumlahPasienPerPoli = Poli::withCount(['antrian' => function ($query) {
            $query->whereDate('created_at', today());
        }])->get();
    
        return view('admin.dashboard', compact(
            'totalPasien',
            'sudahCheckup',
            'sedangCheckup',
            'belumCheckup',
            'jumlahPasienPerPoli'
        ));
    }

    public function getPasienPerPoli()
    {
        $data = Poli::withCount(['antrian' => function ($query) {
            $query->whereDate('created_at', today());
        }])->get();

        $labels = $data->pluck('nama_poli');
        $counts = $data->pluck('antrian_count');

        return response()->json([
            'labels' => $labels,
            'data' => $counts,
        ]);
    }

    public function getChartData()
    {
        $today = now()->toDateString();

        $data = [
            'belum_checkup' => Antrian::whereDate('created_at', $today)
                                    ->where('status', 'Belum Check-Up')
                                    ->count(),
            'sedang_checkup' => Antrian::whereDate('created_at', $today)
                                    ->where('status', 'Sedang Check-Up')
                                    ->count(),
            'sudah_checkup' => Antrian::whereDate('created_at', $today)
                                    ->where('status', 'Selesai')
                                    ->count(), // ✅ ganti 'selesai' jadi 'sudah_checkup'
        ];

        return response()->json($data);
    }

}
