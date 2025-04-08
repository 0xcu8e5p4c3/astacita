<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;

class IsEditor
{
    public function handle(Request $request, Closure $next)
    {

        if (Auth::check() && Auth::user()->role === 'editor') {
            session()->forget('filament.notifications');
            return $next($request);
        }

        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        
        session()->put('filament.notifications', [
            [
                'title' => 'Akses Ditolak',
                'body' => 'Hanya editor yang bisa mengakses dashboard admin.',
                'type' => 'danger',
                'icon' => 'heroicon-o-x-circle',
                'duration' => 3000,
                'persistent' => true,
            ],
        ]);
        
        return redirect()->route('filament.astacita.auth.login');
    }
}
