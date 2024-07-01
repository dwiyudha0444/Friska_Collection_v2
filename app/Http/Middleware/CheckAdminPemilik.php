<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckAdminPemilik
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // Pastikan pengguna sudah login
        if (!$user) {
            return redirect('/forbidden');
        }

        // Periksa apakah pengguna adalah admin atau pemilik
        if ($user->role !== 'admin' && $user->role !== 'pemilik') {
            return redirect('/forbidden');
        }

        return $next($request);
    }
}
