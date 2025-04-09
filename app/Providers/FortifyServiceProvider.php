<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Illuminate\Http\Request;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;

class FortifyServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // View untuk login/register/forgot/reset dalam 1 file
        Fortify::loginView(fn () => view('auth-user.login'));

        Fortify::registerView(fn () => view('auth-user.login'));
        $this->app->singleton(CreatesNewUsers::class, CreateNewUser::class);

        Fortify::requestPasswordResetLinkView(fn () => view('auth-user.login'));

        Fortify::resetPasswordView(fn ($request) => view('auth-user.login', ['request' => $request]));

        Fortify::verifyEmailView(fn () => view('auth.verify-email'));

        // Rate limiter untuk login
        RateLimiter::for('login', function (Request $request) {
            return Limit::perMinute(5)->by($request->email . $request->ip());
        });

        // Rate limiter untuk two-factor (opsional)
        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
    public const HOME = '/';
}
