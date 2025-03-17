<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        if (Auth::check()) {
            $user = Auth::user();

            // 🚨 Cek apakah user belum verifikasi email, dan pastikan tidak terjadi loop redirect
            if (!$user->hasVerifiedEmail() && !$request->is('admin/email-verification/prompt')) {
                return redirect()->route('filament.admin.auth.email-verification.prompt')
                    ->with('error', 'Silakan verifikasi email Anda sebelum mengakses halaman ini.');
            }

            // ✅ Setelah verifikasi, arahkan user ke halaman sesuai rolenya
            if ($user->hasVerifiedEmail()) {
                if ($user->role === 'editor' || $user->role === 'author') {
                    return redirect('/admin');
                }

                if ($user->role === 'user') {
                    return redirect('/');
                }
            }

            return $next($request);
        }

        return $next($request);
    }
}
