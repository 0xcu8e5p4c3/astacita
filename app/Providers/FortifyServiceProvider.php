<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Http\Responses\CustomRegisterResponse;
use Laravel\Fortify\Contracts\RegisterResponse;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Illuminate\Http\Request;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;


class FortifyServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);
        
        Fortify::loginView(fn () => view('auth-user.login'));

        Fortify::registerView(fn () => view('auth-user.login'));
        $this->app->singleton(RegisterResponse::class, CustomRegisterResponse::class);
        $this->app->singleton(CreatesNewUsers::class, CreateNewUser::class);

        Fortify::requestPasswordResetLinkView(fn () => view('auth-user.login'));

        RateLimiter::for('password-reset', function (Request $request) {
            return Limit::perMinute(5)->by($request->email);
        });

        Fortify::resetPasswordView(function ($request) {
            return view('auth-user.form-forgot', [
                'token' => $request->route('token'),
                'email' => $request->query('email'),
            ]);
        });

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
