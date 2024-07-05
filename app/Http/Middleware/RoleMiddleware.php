<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        // Memeriksa apakah pengguna sudah login
        if (!Auth::check()) {
            // Jika pengguna belum login, arahkan mereka ke halaman login
            return redirect('login');
        }

        // Mendapatkan pengguna yang sedang login
        $user = Auth::user();

        // Memeriksa apakah peran pengguna sesuai dengan peran yang diberikan sebagai parameter middleware
        if (!$user->hasRole($role)) {
            // Jika tidak sesuai, tampilkan halaman error 403 Unauthorized
            abort(403, 'Unauthorized action.');
        }

        // Jika peran sesuai, lanjutkan ke request berikutnya
        return $next($request);
    }
}
