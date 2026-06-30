<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthMahasiswaController extends Controller
{
    public function showLogin()
    {
        return view('mahasiswa.auth.login_mahasiswa');
    }

    public function login(Request $request)
    {
        $request->validate([
            'nim' => 'required',
            'password' => 'required'
        ]);

        $mahasiswa = Mahasiswa::where('nim', $request->nim)->first();

        if (!$mahasiswa) {
            return back()->with('error', 'NIM tidak ditemukan!');
        }

        $user = User::where('email', $mahasiswa->email)->first();

        if (!$user) {
            return back()->with('error', 'Akun belum diaktivasi! Silakan register.');
        }

        if (Auth::attempt([
            'email' => $user->email,
            'password' => $request->password
        ])) {

            $request->session()->regenerate();

            session([
                'mahasiswa_login' => true,
                'mahasiswa_id' => $mahasiswa->id,
                'nim' => $mahasiswa->nim,
                'nama' => $mahasiswa->nama,
                'jurusan' => $mahasiswa->prodi ?? 'Manajemen Informatika',
            ]);

            return redirect()->route('mahasiswa.dashboard');
        }

        return back()->with('error', 'Password salah!');
    }

    public function showRegister()
    {
        return view('mahasiswa.auth.register_mahasiswa');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nim' => 'required',
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:6|confirmed'
        ], [
            'password.confirmed' => 'Konfirmasi password tidak cocok!',
            'email.unique' => 'Email sudah digunakan!',
            'nim.unique' => 'NIM sudah terdaftar!'
        ]);

        $mahasiswa = Mahasiswa::where('nim', $request->nim)->first();

        if (!$mahasiswa) {
            return back()
                ->withErrors([
                    'nim' => 'NIM tidak terdaftar di sistem! Hubungi admin.'
                ])
                ->withInput();
        }

        User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'mahasiswa',
            'nim' => $request->nim
        ]);

        $mahasiswa->update([
            'email' => $request->email,
        ]);

        return redirect()
            ->route('mahasiswa.login')
            ->with('success', 'Akun berhasil diaktivasi! Silakan login.');
    }
    public function dashboard()
    {
        if (!Auth::check()) {
            return redirect()->route('mahasiswa.login');
        }

        return view('mahasiswa.dashboard.index');
    }

    public function profil()
    {
        if (!Auth::check()) {
            return redirect()->route('mahasiswa.login');
        }

        return view('mahasiswa.profil.index');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->forget([
            'mahasiswa_login',
            'mahasiswa_id',
            'nim',
            'nama',
            'jurusan'
        ]);

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('mahasiswa.login');
    }
}
