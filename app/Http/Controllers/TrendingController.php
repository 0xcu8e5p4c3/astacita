<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class TrendingController extends Controller
{
    public function index()
    {
        // Pastikan tabel 'views' ada dan gunakan relasi untuk menghitung jumlah views
        $trending = Article::where('status', 'published')
        ->whereNotNull('published_at')
        ->withCount('views') // Menghitung jumlah views dari tabel views
        ->orderByDesc('views_count') // Urutkan berdasarkan jumlah views
        ->limit(10)
        ->get();    

        return view('component.gridtrend', compact('trending'));
    }
}
