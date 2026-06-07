<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     * Hanya izinkan user dengan role 'admin'.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! auth()->check() || ! auth()->user()->isAdmin()) {
            return redirect()->route('home')
                ->with('error', 'Akses ditolak. Halaman ini hanya untuk admin.');
        }

        return $next($request);
    }
}
