<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Visit;

class TrackVisitor
{
    public function handle(Request $request, Closure $next)
    {
        // Simpan kunjungan berdasarkan IP pengunjung
        Visit::firstOrCreate(['ip_address' => $request->ip()]);

        return $next($request);
    }
}

