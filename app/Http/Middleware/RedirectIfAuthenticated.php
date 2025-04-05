<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        // ✅ Handle logout secara manual
        if ($request->routeIs('filament.astacita.auth.logout') || $request->is('logout')) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('/'); // Atau route lain setelah logout
        }

        // ✅ Kalau sudah login
        if (Auth::check()) {
            $user = Auth::user();

            // 🚫 Cegah user non-verifikasi email akses halaman lain
            if (
                !$user->hasVerifiedEmail() &&
                !$request->routeIs('filament.astacita.auth.email-verification.prompt') &&
                !$request->routeIs('filament.astacita.auth.email-verification.verify') &&
                !$request->routeIs('filament.astacita.auth.logout')
            ) {
                return redirect()->route('filament.astacita.auth.email-verification.prompt')
                    ->with('error', 'Silakan verifikasi email Anda terlebih dahulu.');
            }

            // ✅ Cegah akses ke halaman login/register kalau udah login
            if (
                $request->routeIs('filament.astacita.auth.login') ||
                $request->routeIs('filament.astacita.auth.register')
            ) {
                $redirectRoutes = [
                    'admin' => '/dashboard',
                    'editor' => '/astacita',
                    'author' => '/astacita',
                    'user' => '/',
                ];

                $targetRoute = $redirectRoutes[$user->role] ?? '/';

                return redirect($targetRoute);
            }
        }

        // ✅ Biarkan proses lanjut kalau belum login
        return $next($request);
    }
}
