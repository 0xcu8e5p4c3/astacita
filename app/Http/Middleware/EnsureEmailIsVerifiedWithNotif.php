<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class EnsureEmailIsVerifiedWithNotif
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user && ! $user->hasVerifiedEmail()) {
            // Jika belum diverifikasi, kasih notifikasi dan redirect
            session()->put('filament.notifications', [
                [
                    'title' => 'Email Belum Diverifikasi',
                    'body' => 'Silakan verifikasi email kamu sebelum lanjut.',
                    'type' => 'warning',
                    'icon' => 'heroicon-o-exclamation-circle',
                    'duration' => 5000,
                    'persistent' => true,
                ],
            ]);

            return redirect()->route('verification.notice');
        }

        // Jika ada flag 'just_verified' di session, kasih notifikasi sukses
        if (session('just_verified')) {
            session()->forget('just_verified'); // Hapus flag biar ga berulang

            session()->put('filament.notifications', [
                [
                    'title' => 'Verifikasi Berhasil',
                    'body' => 'Email kamu berhasil diverifikasi. Silakan login.',
                    'type' => 'success',
                    'icon' => 'heroicon-o-check-circle',
                    'duration' => 4000,
                    'persistent' => false,
                ],
            ]);
        }

        return $next($request);
    }
}
