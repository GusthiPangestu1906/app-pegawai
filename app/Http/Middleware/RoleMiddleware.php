<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();

        // LOGIKA BARU:
        // Jika user adalah 'admin', dia boleh akses segalanya (termasuk halaman employee)
        if ($user->role === 'admin') {
            return $next($request);
        }

        // Jika bukan admin, cek apakah role sesuai
        if ($user->role !== $role) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}