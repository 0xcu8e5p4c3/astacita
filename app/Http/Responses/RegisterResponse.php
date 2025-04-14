<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterResponse
{
    public function RegisterResponse(Request $request)
    {

        Auth::logout();

        return redirect()->route('verif.email');
    }
}
