<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Http\Requests\LoginRequest;

class AuthUserController extends Controller
{
    public function store(LoginRequest $request)
    {
        if (! Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }
        
        $request->session()->regenerate();

        return redirect()->intended('/'); // Ganti dengan route tujuan setelah login
    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/'); // Ganti dengan route tujuan setelah logout
    }
}
