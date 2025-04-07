<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller; // Pastikan Controller di-extend dengan benar
use Illuminate\Support\Facades\Auth;
use App\Models\Poli; // Asumsikan ada model Poli

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Pastikan user login sebelum mengakses controller ini
    }

    public function index()
    {
        $user = Auth::user(); // Mengambil user yang sedang login
        $polis = Poli::all(); // Ambil data dari database
        return view('homepage', compact('polis')); // Pastikan 'polis' dikirim ke view
    }  
}