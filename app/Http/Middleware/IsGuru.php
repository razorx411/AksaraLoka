<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsGuru
{
    /**
     * Handle an incoming request.
     * Hanya izinkan user dengan role 'guru'.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! auth()->check() || ! auth()->user()->isGuru()) {
            return redirect()->route('home')
                ->with('error', 'Akses ditolak. Halaman ini hanya untuk guru.');
        }

        return $next($request);
    }
}

