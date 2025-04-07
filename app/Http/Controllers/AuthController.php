<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role === 'admin' || $user->role === 'dokter') {
                return redirect()->route('dashboard')->with('success', 'Login berhasil sebagai Admin!');
            }
            return redirect()->route('homepage')->with('success', 'Login berhasil!');
        }        

        return redirect()->route('login')->withErrors('Login gagal, coba lagi.');
    }


    // Menampilkan halaman signup
    public function showSignupForm()
    {
        return view('auth.signup'); // Sesuaikan dengan nama view kamu
    }    

    // Proses sign up (register user)
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'pengguna' // Tambahkan role default
        ]);

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat! Silakan login.');
    }

    // Proses logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}