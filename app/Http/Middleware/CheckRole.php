<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Periksa apakah pengguna terautentikasi
        if (!Auth::check()) {
            return redirect('/login'); // Arahkan ke halaman login jika tidak terautentikasi
        }

        // Periksa apakah pengguna memiliki role yang sesuai
        $user = Auth::user();
        if (!in_array($user->role, $roles)) {
            abort(403, 'Unauthorized'); // Tampilkan error jika role tidak sesuai
        }

        return $next($request);
    }
}
