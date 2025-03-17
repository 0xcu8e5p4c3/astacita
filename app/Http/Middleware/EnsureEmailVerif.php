<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureEmailVerif
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && !Auth::user()->hasVerifiedEmail()) {
            if ($request->routeIs('filament.admin.auth.register') || $request->routeIs('filament.admin.auth.password-reset.request')) {
                return redirect()->route('verification.notice')->with('error', 'Silakan verifikasi email Anda terlebih dahulu.');
            }
        }
        
        return $next($request);
    }
}
