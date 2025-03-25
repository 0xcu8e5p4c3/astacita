<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        // **Pastikan logout tidak dicegah oleh middleware**
        if ($request->routeIs('filament.astacita.auth.logout') || $request->is('logout')) {
            Auth::logout();
            session()->invalidate();
            session()->regenerateToken();
            
            return redirect('/'); // **Redirect langsung ke halaman utama setelah logout**
        }

        if (Auth::check()) {
            $user = Auth::user();

            // **Jika user belum verifikasi email, redirect ke halaman verifikasi**
            if (!$user->hasVerifiedEmail() && !$request->is('astacita/email-verification/prompt')) {
                return redirect()->route('filament.astacita.auth.email-verification.prompt')
                    ->with('error', 'Silakan verifikasi email Anda sebelum mengakses halaman ini.');
            }

            // **Redirect berdasarkan role user**
            $redirectRoutes = [
                'editor' => '/astacita',
                'author' => '/astacita',
                'user' => '/',
                'admin' => '/dashboard',
            ];

            $targetRoute = $redirectRoutes[$user->role] ?? '/login';

            // **Cegah redirect berulang**
            if (!$request->is(trim($targetRoute, '/'))) {
                return redirect($targetRoute);
            }
        }

        return $next($request);
    }
}
