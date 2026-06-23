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
        $request->validate([
            'nim' => 'required',
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|min:6|confirmed'
        ], [
            'password.confirmed' => 'Konfirmasi password yang Anda masukkan tidak cocok!'
        ]);

        $mahasiswa = Mahasiswa::where('nim', $request->nim)->first();

        if (!$mahasiswa) {
            return back()->withErrors(['nim' => 'NIM Anda belum terdaftar di sistem akademik. Silakan hubungi Dosen/Admin.'])->withInput();
        }

        $akunLama = User::where('nim', $request->nim)->first();
        if ($akunLama) {
            return back()->withErrors(['nim' => 'NIM ini sudah diaktivasi sebelumnya. Silakan langsung login.'])->withInput();
        }

        $emailLama = User::where('email', $request->email)->first();
        if ($emailLama) {
            return back()->withErrors(['email' => 'Email ini sudah digunakan oleh akun lain.'])->withInput();
        }

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

    public function dashboard(Request $request)
    {
        if (!Auth::check() || Auth::user()->role !== 'mahasiswa') {
            Auth::logout();
            session()->flush();
            return redirect()->route('mahasiswa.login');
        }

        $nimSesi = Auth::user()->nim;
        $semesterDipilih = $request->input('semester');

        // 1. QUERY TABEL: Mengambil nilai mahasiswa (Filter per semester + diurutkan dari Semester 1, 2, dst)
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

        // 2. QUERY CARD STATISTIK: SKS & Total Matkul otomatis ikut ter-filter per semester jika dipilih
        $querySks = DB::table('nilai_mahasiswa')
            ->join('mata_kuliah', 'nilai_mahasiswa.matkul_id', '=', 'mata_kuliah.id')
            ->where('nilai_mahasiswa.nim', $nimSesi);

        $queryJumlahMatkul = DB::table('nilai_mahasiswa')
            ->join('mata_kuliah', 'nilai_mahasiswa.matkul_id', '=', 'mata_kuliah.id')
            ->where('nilai_mahasiswa.nim', $nimSesi);

        if (!empty($semesterDipilih)) {
            $querySks->where('mata_kuliah.semester', $semesterDipilih);
            $queryJumlahMatkul->where('mata_kuliah.semester', $semesterDipilih);
        }

        $totalSks = $querySks->sum('mata_kuliah.sks');
        $jumlahMatkul = $queryJumlahMatkul->count();

        // 3. LOGIKA KURVA DINAMIS: Otomatis mendeteksi seluruh semester tertinggi di database mahasiswa tersebut
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

            if ($rataRataSemester) {
                $grafikIpk[] = number_format($rataRataSemester / 25, 2);
            } else {
                $grafikIpk[] = 0.00; 
            }
        }

        // 4. IPK KUMULATIF TOTAL (Tetap menghitung akumulasi seluruh nilai)
        $semuaNilai = DB::table('nilai_mahasiswa')->where('nim', $nimSesi)->avg('nilai_akhir');
        $ipkTotal = $semuaNilai ? number_format($semuaNilai / 25, 2) : '0.00';

        return view('dashboard.mahasiswa', compact('daftarNilai', 'totalSks', 'jumlahMatkul', 'grafikIpk', 'ipkTotal', 'semesterDipilih'));
    }

    public function logout()
    {
        Auth::logout();
        session()->flush();
        return redirect()->route('mahasiswa.login');
    }

    public function logoutToLanding()
    {
        Auth::logout();
        session()->flush();
        return redirect('/');
    }
}