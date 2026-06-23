<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman form login admin.
     */
    public function login()
    {
        return view('auth.login');
    }

    /**
     * Memproses data form login dan melakukan otentikasi admin.
     */
    public function authenticate(Request $request)
    {
        // 1. Validasi input email dan password
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Coba lakukan login menggunakan data input
        if (Auth::attempt($credentials)) {
            // Jika sukses, buat ulang session untuk keamanan
            $request->session()->regenerate();

            // FIX FULL: Mengarahkan admin langsung ke halaman dashboard admin
            return redirect()->intended('/dashboard');
        }

        // 3. Jika login gagal, kembali ke halaman login dengan pesan error
        return back()->with('error', 'Email atau Password Salah');
    }

    /**
     * Memproses logout admin dan membersihkan session.
     */
    public function logout(Request $request)
    {
        // Keluar dari sistem otentikasi Auth Laravel
        Auth::logout();

        // Menghapus data session lama agar tidak bisa digunakan lagi
        $request->session()->invalidate();

        // Membuat ulang token CSRF baru untuk keamanan form berikutnya
        $request->session()->regenerateToken();

        // Kembali ke halaman login setelah berhasil logout
        return redirect('/login');
    }
}