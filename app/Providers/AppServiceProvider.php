<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Notifikasi;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
{
    View::composer('mahasiswa.layouts.index', function ($view) {

        $jumlahNotifikasi = 0;
        $notifikasiTerbaru = collect();

        if (session()->has('nim')) {

            $jumlahNotifikasi = Notifikasi::where('nim', session('nim'))
                ->where('dibaca', false)
                ->count();

            $notifikasiTerbaru = Notifikasi::where('nim', session('nim'))
                ->where('dibaca', false)
                ->latest()
                ->take(5)
                ->get();
        }

        $view->with(compact(
            'jumlahNotifikasi',
            'notifikasiTerbaru'
        ));
    });
}
}
