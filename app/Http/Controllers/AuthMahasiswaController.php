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
        return view('auth.login_mahasiswa');
    }

    public function login(Request $request)
    {
        $request->validate([
            'nim' => 'required',
            'password' => 'required'
        ]);

        // Cari mahasiswa berdasarkan NIM
        $mahasiswa = Mahasiswa::where('nim', $request->nim)->first();

        if (!$mahasiswa) {
            return back()->with('error', 'NIM tidak ditemukan!');
        }

        // Cari user berdasarkan email
        $user = User::where('email', $mahasiswa->email)->first();

        if (!$user) {
            return back()->with('error', 'Akun belum diaktivasi! Silakan register.');
        }

        // Login dengan email
        if (Auth::attempt(['email' => $user->email, 'password' => $request->password])) {
            $request->session()->regenerate();

            session([
                'mahasiswa_login' => true,
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
        return view('auth.register_mahasiswa');
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

        // Cek NIM di tabel mahasiswa
        $mahasiswa = Mahasiswa::where('nim', $request->nim)->first();

        if (!$mahasiswa) {
            return back()->withErrors(['nim' => 'NIM tidak terdaftar di sistem! Hubungi admin.'])->withInput();
        }

        // Buat user
        $user = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'mahasiswa',
            'nim' => $request->nim
        ]);

        // Update email mahasiswa
        $mahasiswa->update([
            'email' => $request->email,
        ]);

        return redirect()
            ->route('mahasiswa.login')
            ->with('success', 'Akun berhasil diaktivasi! Silakan login.');
    }

    public function dashboard(Request $request)
    {
        if (!Auth::check() || Auth::user()->role !== 'mahasiswa') {
            Auth::logout();
            session()->flush();
            return redirect()->route('mahasiswa.login');
        }

        $nimSesi = session('nim') ?? Auth::user()->nim;
        $semesterDipilih = $request->input('semester');

        // Query nilai
        $queryNilai = DB::table('nilai_mahasiswa')
            ->join('mata_kuliah', 'nilai_mahasiswa.matkul_id', '=', 'mata_kuliah.id')
            ->where('nilai_mahasiswa.nim', $nimSesi);

        if (!empty($semesterDipilih)) {
            $queryNilai->where('mata_kuliah.semester', $semesterDipilih);
        }

        $daftarNilai = $queryNilai->select(
            'mata_kuliah.nama as nama_matakuliah',
            'mata_kuliah.semester',
            'nilai_mahasiswa.kehadiran',
            'nilai_mahasiswa.tugas',
            'nilai_mahasiswa.uts',
            'nilai_mahasiswa.uas',
            'nilai_mahasiswa.nilai_akhir',
            'nilai_mahasiswa.grade'
        )->orderBy('mata_kuliah.semester', 'asc')->get();

        // Total SKS
        $querySks = DB::table('nilai_mahasiswa')
            ->join('mata_kuliah', 'nilai_mahasiswa.matkul_id', '=', 'mata_kuliah.id')
            ->where('nilai_mahasiswa.nim', $nimSesi);

        if (!empty($semesterDipilih)) {
            $querySks->where('mata_kuliah.semester', $semesterDipilih);
        }

        $totalSks = $querySks->sum('mata_kuliah.sks');

        // Jumlah Matkul
        $queryJumlahMatkul = DB::table('nilai_mahasiswa')
            ->join('mata_kuliah', 'nilai_mahasiswa.matkul_id', '=', 'mata_kuliah.id')
            ->where('nilai_mahasiswa.nim', $nimSesi);

        if (!empty($semesterDipilih)) {
            $queryJumlahMatkul->where('mata_kuliah.semester', $semesterDipilih);
        }

        $jumlahMatkul = $queryJumlahMatkul->count();

        // Grafik IPK
        $semesterTertinggi = DB::table('nilai_mahasiswa')
            ->join('mata_kuliah', 'nilai_mahasiswa.matkul_id', '=', 'mata_kuliah.id')
            ->where('nilai_mahasiswa.nim', $nimSesi)
            ->max('mata_kuliah.semester');

        $batasLoop = $semesterTertinggi ? $semesterTertinggi : 1;

        $grafikIpk = [];
        for ($i = 1; $i <= $batasLoop; $i++) {
            $rataRataSemester = DB::table('nilai_mahasiswa')
                ->join('mata_kuliah', 'nilai_mahasiswa.matkul_id', '=', 'mata_kuliah.id')
                ->where('nilai_mahasiswa.nim', $nimSesi)
                ->where('mata_kuliah.semester', $i)
                ->avg('nilai_mahasiswa.nilai_akhir');

            $grafikIpk[] = $rataRataSemester ? number_format($rataRataSemester / 25, 2) : 0.00;
        }

        // IPK Total
        $semuaNilai = DB::table('nilai_mahasiswa')->where('nim', $nimSesi)->avg('nilai_akhir');
        $ipkTotal = $semuaNilai ? number_format($semuaNilai / 25, 2) : '0.00';

        return view('dashboard.mahasiswa', compact(
            'daftarNilai',
            'totalSks',
            'jumlahMatkul',
            'grafikIpk',
            'ipkTotal',
            'semesterDipilih'
        ));
    }

    public function profil()
    {
        if (!Auth::check()) {
            return redirect()->route('mahasiswa.login');
        }
        return view('profil.profil');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        session()->flush();
        return redirect()->route('mahasiswa.login');
    }
}
