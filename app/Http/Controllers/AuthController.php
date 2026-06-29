<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman login admin.
     */
    public function login()
{
    return view('admin.auth.admin');
}

    /**
     * Proses login admin.
     */
    public function authenticate(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Coba login
        if (Auth::attempt($credentials)) {

            // Regenerate session
            $request->session()->regenerate();

            // Redirect ke dashboard admin
            return redirect()->intended(route('dashboard'));
        }

        // Jika gagal
        return back()
            ->withInput($request->only('email'))
            ->with('error', 'Email atau Password Salah');
    }

    /**
     * Logout admin.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}