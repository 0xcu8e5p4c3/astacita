<?php

use Illuminate\Support\Facades\Route;
use App\Models\View;
use Illuminate\Http\Request;
use App\Models\Article;

Route::get('/home', function () {
    return view('home');
});

Route::get('/article/{slug}', function ($slug, Request $request) {
    $article = Article::where('slug', $slug)->firstOrFail();

    // Cek apakah IP sudah melihat artikel ini
    $existingView = View::where('article_id', $article->id)
                        ->where('ip_address', $request->ip())
                        ->first();

    if (!$existingView) {
        View::create([
            'article_id' => $article->id,
            'ip_address' => $request->ip(),
        ]);
    }

    return view('article', compact('article'));
});