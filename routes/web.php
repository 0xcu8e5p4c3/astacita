<?php


use App\Http\Controllers\SearchController;
use App\Http\Controllers\TrendingController;
use App\Http\Controllers\Auth\AuthUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AboutController;
use App\Models\View;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ArticleViewController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\URL;
use Illuminate\Auth\Events\Verified;
use App\Models\User;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/subscription', function () {
    return view('subscription');
})->name('subscription');

Route::get('/dashboard-user', function () {
    return view('dashboard');
})->name('dashboard');

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

Route::get('/tentang-kami', [AboutController::class, 'about'])->name('about');
Route::get('/redaksi', [AboutController::class, 'editorial'])->name('editorial');
Route::get('/kode-etik', [AboutController::class, 'ethicsCode'])->name('ethics-code');
Route::get('/pedoman-media-cyber', [AboutController::class, 'cyberGuidelines'])->name('cyber-guidelines');
Route::get('/kontak', [AboutController::class, 'contact'])->name('contact');

Route::get('/pages/{slug}/{request?}', [ArticleController::class, 'showCategory'])->name('category.show');

Route::get('/news/{categorySlug}/{articleSlug}', [ArticleViewController::class, 'show'])
    ->name('article.show');

Route::get('/category/{slug}/load-more', [ArticleController::class, 'loadMore'])->name('category.loadmore');

Route::get('/search', [SearchController::class, 'search'])->name('search');

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');

Route::get('/profile', function () {
    return view('profile');
})->name('profile');

Route::middleware(['auth'])->group(function () {
    Route::put('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
});

Route::get('/load-more-articles', function (Request $request) {
    $page = $request->input('page', 1);

    $articles = Article::with(['category', 'author']) // <-- penting eager load
        ->orderBy('published_at', 'desc')
        ->where('status', 'published')
        ->paginate(6, ['*'], 'page', $page);

    $html = '';

    foreach ($articles as $article) {
        $html .= view('components.partials.article_card', compact('article'))->render();
    }

    return response()->json([
        'html' => $html,
        'has_more' => $articles->hasMorePages(),
        'next_page' => $articles->currentPage() + 1,
    ]);
})->name('articles.loadmore');
