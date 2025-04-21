<?php


use App\Http\Controllers\SearchController;
use App\Http\Controllers\TrendingController;
use App\Http\Controllers\Auth\AuthUserController;
use Illuminate\Support\Facades\Route;
use App\Models\View;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ArticleViewController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\URL;
use Illuminate\Auth\Events\Verified;
use App\Models\User;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/email/verify', function () {
    return view('auth-user.verif-email'); 
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (Request $request, $id, $hash) {
    $user = User::findOrFail($id);

    if (! hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
        abort(403);
    }

    if (! $user->hasVerifiedEmail()) {
        $user->markEmailAsVerified();
        event(new Verified($user));
    }

    return redirect()->route('login');
})->middleware('signed', 'verified')->name('verification.verify');


Route::post('/login', [AuthUserController::class, 'store']);

Route::post('/logout', [AuthUserController::class, 'destroy'])->name('logout');

// category menu navbar
Route::get('/pages/{slug}/{request?}', [ArticleController::class, 'showCategory'])->name('category.show');
// Detail artikel
Route::get('/news/{categorySlug}/{articleSlug}', [ArticleViewController::class, 'show'])
    // ->middleware('store.article')
    ->name('article.show');

    Route::get('/category/{slug}/load-more', [ArticleController::class, 'loadMore'])->name('category.loadmore');

Route::get('/search', [SearchController::class, 'search'])->name('search');

Route::get('/profile', function () {
    return view('profile');
})->name('profile');

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/'); // Redirect ke halaman utama setelah logout
})->name('logout');

