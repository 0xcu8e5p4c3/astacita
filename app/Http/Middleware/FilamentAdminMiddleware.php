<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Route;

class FilamentAdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        $routeName = Route::currentRouteName();

        $allowedRoutes = ['login', 'register', 'password.request', 'password.email', 'password.reset', 'password.update'];

        if (in_array($routeName, $allowedRoutes)) {
            return $next($request);
        }

        if (!$user || !$user->hasRole('editor')) {
            abort(403, 'Unauthorized access.');
        }

        return $next($request);
    }
}
