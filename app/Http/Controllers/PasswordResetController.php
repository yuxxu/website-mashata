<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class PasswordResetController extends Controller
{
    // 1️⃣ Menampilkan Form Lupa Password
    public function showForgotForm()
    {
        return view('auth.forgot-password');
    }
    

    // 2️⃣ Mengirim Link Reset Password
    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);
    
        $status = Password::sendResetLink($request->only('email'));
    
        return $status === Password::RESET_LINK_SENT
            ? back()->with(['success' => 'Kami telah mengirim kode verifikasi. Silakan cek email-mu.'])
            : back()->withErrors(['email' => __($status)]);
    }
    

    // 3️⃣ Menampilkan Form Reset Password
    public function showResetForm($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    // 4️⃣ Menangani Reset Password
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('success', __($status))
            : back()->withErrors(['email' => __($status)]);
    }
}
