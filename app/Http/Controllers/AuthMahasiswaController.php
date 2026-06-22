<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthMahasiswaController extends Controller
{
    public function showLogin()
    {
        return view('auth.login_mahasiswa');
    }

    public function login(Request $request)
    {
        $request->validate([
            'nim' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt(['nim' => $request->nim, 'password' => $request->password])) {
            $request->session()->regenerate();
            
            $user = Auth::user();
            $mahasiswa = Mahasiswa::where('nim', $user->nim)->first();
            
            session([
                'mahasiswa_login' => true,
                'nim' => $user->nim,
                'nama' => $mahasiswa ? $mahasiswa->nama : $user->name
            ]);

            return redirect()->route('mahasiswa.dashboard');
        }

        return back()->with('error', 'NIM atau Password salah!');
    }

    public function showRegister()
    {
        return view('auth.register_mahasiswa');
    }

    public function register(Request $request)
    {
        // Validasi input form pendaftaran
        $request->validate([
            'nim' => 'required',
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|min:6|confirmed' // 'confirmed' otomatis mencocokkan field password_confirmation
        ], [
            // Pesan error kustom jika password tidak sama saat diinput mahasiswa
            'password.confirmed' => 'Konfirmasi password yang Anda masukkan tidak cocok!'
        ]);

        // 1. Cek apakah NIM tersebut valid (sudah diinput dosen di tabel mahasiswa)
        $mahasiswa = Mahasiswa::where('nim', $request->nim)->first();

        if (!$mahasiswa) {
            return back()->withErrors(['nim' => 'NIM Anda belum terdaftar di sistem akademik. Silakan hubungi Dosen/Admin.'])->withInput();
        }

        // 2. Cek apakah NIM ini sudah memiliki akun login di tabel users
        $akunLama = User::where('nim', $request->nim)->first();
        if ($akunLama) {
            return back()->withErrors(['nim' => 'NIM ini sudah diaktivasi sebelumnya. Silakan langsung login.'])->withInput();
        }

        // 3. Cek apakah Email yang diinput sudah dipakai user lain di tabel users
        $emailLama = User::where('email', $request->email)->first();
        if ($emailLama) {
            return back()->withErrors(['email' => 'Email ini sudah digunakan oleh akun lain.'])->withInput();
        }

        // 4. Jika semua valid, simpan ke tabel users
        User::create([
            'name' => $request->nama,       
            'email' => $request->email,     
            'password' => Hash::make($request->password),
            'role' => 'mahasiswa',
            'nim' => $request->nim
        ]);

        return redirect()
            ->route('mahasiswa.login')
            ->with('success', 'Akun berhasil diaktivasi! Silakan login menggunakan password baru Anda.');
    }

    public function dashboard()
    {
        if (!Auth::check() || Auth::user()->role !== 'mahasiswa') {
            Auth::logout();
            session()->flush();
            return redirect()->route('mahasiswa.login');
        }

        return view('dashboard.mahasiswa');
    }

    public function logout()
    {
        Auth::logout();
        session()->flush();
        return redirect()->route('mahasiswa.login');
    }
}