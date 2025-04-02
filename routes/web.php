<?php


use App\Http\Controllers\SearchController;
use App\Http\Controllers\TrendingController;
use Illuminate\Support\Facades\Route;
use App\Models\View;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ArticleViewController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('home');
})->name('home');

// category menu navbar
Route::get('/pages/{slug}/{request?}', [ArticleController::class, 'showCategory'])->name('category.show');
// Detail artikel
Route::get('/news/{categorySlug}/{articleSlug}', [ArticleViewController::class, 'show'])
    // ->middleware('store.article')
    ->name('article.show');


Route::get('/pages/{slug}/loadmore', [ArticleController::class, 'loadMore'])->name('category.loadmore');

Route::get('/search', [SearchController::class, 'search'])->name('search');

Route::get('/test', function () {
    return view('test');
})->name('test');

Route::get('/profile', function () {
    return view('profile');
})->name('profile');

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/'); // Redirect ke halaman utama setelah logout
})->name('logout');

