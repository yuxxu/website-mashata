<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Antrian;
use Illuminate\Support\Facades\Auth; // tambahkan ini di atas


class DashboardController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $totalPasien = Antrian::count();
        $sudahCheckup = Antrian::where('status', 'selesai')->count();
        $sedangCheckup = Antrian::where('status', 'sedang check-up')->count();
        $belumCheckup = Antrian::where('status', 'belum check-up')->count();

        return view('admin.dashboard', compact('totalPasien', 'sudahCheckup', 'sedangCheckup', 'belumCheckup'));
    }

    public function getChartData()
    {
        $data = [
            'belum_checkup' => Antrian::where('status', 'Belum Check-Up')->count(),
            'sedang_checkup' => Antrian::where('status', 'Sedang Check-Up')->count(),
            'selesai' => Antrian::where('status', 'Selesai')->count(),
        ];

        return response()->json($data);
    }

}
