<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthMahasiswaController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\NilaiMahasiswaController;
use App\Http\Controllers\TranskripController;
use App\Http\Controllers\KRSController;

/*
|--------------------------------------------------------------------------
| LANDING PAGE
|--------------------------------------------------------------------------
*/

Route::view('/', 'landing.index')->name('home');

/*
|--------------------------------------------------------------------------
| LOGIN ADMIN
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);

/*
|--------------------------------------------------------------------------
| LOGIN MAHASISWA
|--------------------------------------------------------------------------
*/

Route::get('/login-mahasiswa', [AuthMahasiswaController::class, 'showLogin'])
    ->name('mahasiswa.login');

Route::post('/login-mahasiswa', [AuthMahasiswaController::class, 'login']);

Route::post('/logout-mahasiswa', [AuthMahasiswaController::class, 'logout'])
    ->name('mahasiswa.logout');

/*
|--------------------------------------------------------------------------
| REGISTER MAHASISWA
|--------------------------------------------------------------------------
*/

Route::get('/mahasiswa/register', [AuthMahasiswaController::class, 'showRegister'])
    ->name('mahasiswa.register');

Route::post('/mahasiswa/register', [AuthMahasiswaController::class, 'register']);

/*
|--------------------------------------------------------------------------
| AREA LOGIN
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

/*
    |--------------------------------------------------------------------------
    | KRS
    |--------------------------------------------------------------------------
    */

    Route::prefix('krs')->name('krs.')->group(function () {
    Route::get('/', [KRSController::class, 'index'])->name('index');
});

    /*
    |--------------------------------------------------------------------------
    | ADMIN
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', function () {
        return view('admin.dashboard.index');
    })->name('dashboard');

    Route::get('/profil', function () {
        return view('admin.profil.index');
    })->name('profil');

    /*
    |--------------------------------------------------------------------------
    | MAHASISWA
    |--------------------------------------------------------------------------
    */

    Route::get('/mahasiswa/dashboard', [AuthMahasiswaController::class, 'dashboard'])
        ->name('mahasiswa.dashboard');

    Route::get('/mahasiswa/profil', [AuthMahasiswaController::class, 'profil'])
        ->name('mahasiswa.profil');

    /*
    |--------------------------------------------------------------------------
    | DATA MAHASISWA
    |--------------------------------------------------------------------------
    */

    Route::resource('mahasiswa', MahasiswaController::class);

    /*
    |--------------------------------------------------------------------------
    | MATA KULIAH
    |--------------------------------------------------------------------------
    */

    Route::resource('mata-kuliah', MataKuliahController::class);

    /*
    |--------------------------------------------------------------------------
    | NILAI
    |--------------------------------------------------------------------------
    */

    Route::prefix('nilai')->name('nilai.')->group(function () {

        Route::get('/', [NilaiMahasiswaController::class, 'index'])->name('index');

        Route::get('/create', [NilaiMahasiswaController::class, 'create'])->name('create');

        Route::post('/', [NilaiMahasiswaController::class, 'store'])->name('store');

        Route::get('/{id}/edit', [NilaiMahasiswaController::class, 'edit'])->name('edit');

        Route::put('/{id}', [NilaiMahasiswaController::class, 'update'])->name('update');

        Route::delete('/{id}', [NilaiMahasiswaController::class, 'destroy'])->name('destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | TRANSKRIP
    |--------------------------------------------------------------------------
    */

    Route::prefix('transkrip')->name('transkrip.')->group(function () {

        Route::get('/', [TranskripController::class, 'index'])->name('index');
        Route::get('/pdf', [TranskripController::class, 'pdf'])->name('pdf');

    });


    /*
    |--------------------------------------------------------------------------
    | API
    |--------------------------------------------------------------------------
    */

    Route::prefix('api')->name('api.')->group(function () {

        Route::get('/search-mahasiswa',
            [NilaiMahasiswaController::class, 'searchMahasiswa'])
            ->name('search.mahasiswa');

        Route::get('/matkul-by-semester',
            [NilaiMahasiswaController::class, 'getMatkulBySemester'])
            ->name('matkul.by.semester');

        Route::get('/check-nilai',
            [NilaiMahasiswaController::class, 'checkNilai'])
            ->name('check.nilai');

    });

    /*
    |--------------------------------------------------------------------------
    | LOGOUT ADMIN
    |--------------------------------------------------------------------------
    */

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/logout', [AuthController::class, 'logout']);
});

/*
|--------------------------------------------------------------------------
| 404
|--------------------------------------------------------------------------
*/

Route::fallback(function () {
    abort(404);
});