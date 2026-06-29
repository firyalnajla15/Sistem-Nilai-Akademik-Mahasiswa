<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MahasiswaMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!session()->has('mahasiswa')) {
            return redirect('/mahasiswa/login')
                ->with('error', 'Silakan login sebagai mahasiswa.');
        }

        return $next($request);
    }
}