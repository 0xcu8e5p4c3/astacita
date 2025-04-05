<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;

class RouteServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // ✅ Custom handler untuk verifikasi email
        Route::middleware(['web', 'auth'])
            ->get('astacita/email/verify/{id}/{hash}', function (Request $request) {
                $user = $request->user();

                if (!$user->hasVerifiedEmail()) {
                    $user->markEmailAsVerified();
                    event(new Verified($user));
                }

                return redirect(self::redirectByRole($user->role));
            })->name('filament.astacita.auth.email-verification.verify');
    }

    // ✅ Fungsi bantu untuk redirect berdasarkan role
    public static function redirectByRole(string $role): string
    {
        return match ($role) {
            'editor', 'author' => '/astacita',
            'user' => '/',
            default => '/',
        };
    }
}
