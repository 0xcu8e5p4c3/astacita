<?php

use Illuminate\Support\Facades\Route;
use App\Models\View;
use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/ai', function () {
    return view('page_category1');
})->name('ai');

Route::get('/crypto', function () {
    return view('page_category2');
})->name('crypto');

Route::get('/startup', function () {
    return view('page_category3');
})->name('startup');

Route::get('/kabinet', function () {
    return view('page_category4');
})->name('kabinet');

Route::get('/okegas', function () {
    return view('page_category5');
})->name('okegas');

Route::get('/bumn', function () {
    return view('page_category6');
})->name('bumn');

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


Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/'); // Redirect ke halaman utama setelah logout
})->name('logout');

