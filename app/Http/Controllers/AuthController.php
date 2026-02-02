<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('Template.login');
    }

    public function authentication(Request $request)
    {
        // 1. Validasi Input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'Email pegawai wajib diisi.',
            'email.email' => 'Format email tidak valid (Gunakan @bulog.co.id).',
            'password.required' => 'Kata sandi tidak boleh kosong.',
        ]);

        // 2. Cek fitur "Remember Me"
        $remember = $request->has('remember');

        // 3. Percobaan Autentikasi
        if (Auth::attempt($credentials, $remember)) {
            // Regenerasi session untuk keamanan (mencegah session fixation)
            $request->session()->regenerate();

            return redirect()->intended('/')
                ->with('success', 'Selamat datang kembali di SIM Bulog, '.Auth::user()->name);
        }

        // 4. Jika Gagal, kembalikan dengan error
        return back()->withErrors([
            'email' => 'Email atau kata sandi yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Anda telah berhasil keluar dari sistem.');
    }
}
