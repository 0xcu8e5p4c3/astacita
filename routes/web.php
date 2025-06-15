<?php


use App\Http\Controllers\SearchController;
use App\Http\Controllers\TrendingController;
use App\Http\Controllers\Auth\AuthUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\Api\TrackingController;
use App\Models\View;
use Illuminate\Http\Request;
use App\Http\Controllers\SmartAdController;
use App\Http\Controllers\AdsTestController;
use App\Models\Article;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ArticleViewController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\URL;
use Illuminate\Auth\Events\Verified;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/profile', function () {
    return view('profile');
})->name('profile');

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

    return redirect()->route('home');
})->middleware('signed', 'verified')->name('verification.verify');

Route::get('/reset-password/{token}', function (Request $request, $token) {
    return view('auth-user.form-forgot', [
        'token' => $token,
        'email' => $request->email,
    ]);
})->middleware('guest')->name('password.reset');

Route::post('/login', [AuthUserController::class, 'store']);

Route::post('/logout', [AuthUserController::class, 'destroy'])->name('logout');

Route::get('/tentang-kami', [AboutController::class, 'tentang'])->name('about');
Route::get('/redaksi', [AboutController::class, 'redaksi'])->name('editorial');
Route::get('/kode-etik', [AboutController::class, 'kodeEtik'])->name('ethics-code');
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

Route::get('images/{encodedPath}', function ($encodedPath) {
    try {
    
        if (strpos($encodedPath, '-meta') !== false) {

            $parts = explode('-meta', $encodedPath);
            $prefix = $parts[0];
            
            $base64Part = explode('-.jpg', $parts[1])[0];
            
            $decodedFileName = base64_decode($base64Part);
            
            $actualPath = 'images/' . $prefix . '/' . $decodedFileName;
        
            if (Storage::disk('public')->exists($actualPath)) {
                return Storage::disk('public')->response($actualPath);
            }
            
            $alternativePath = 'article/covers/' . $decodedFileName;
            if (Storage::disk('public')->exists($alternativePath)) {
                return Storage::disk('public')->response($alternativePath);
            }
        }
    
        if (Storage::disk('public')->exists($encodedPath)) {
            return Storage::disk('public')->response($encodedPath);
        }
        
        abort(404, 'Image not found');
    } catch (Exception $e) {
        // Log error
        Log::error('Image decode error: ' . $e->getMessage());
        abort(500, 'Error processing image');
    }
})->name('image.show')->where('encodedPath', '.*');

// Smart Ads API Routes
Route::prefix('api/smart-ads')->group(function () {
    Route::get('/', [SmartAdController::class, 'getAds']);
    Route::post('/{ad}/impression', [SmartAdController::class, 'recordImpression']);
    Route::post('/{ad}/click', [SmartAdController::class, 'recordClick']);
    Route::post('/clear-cache', [SmartAdController::class, 'clearCache']);
});

// Test Routes
Route::get('/ads-test', [AdsTestController::class, 'index'])->name('ads.test');
Route::get('/ads-test/{page}', [AdsTestController::class, 'testPage'])->name('ads.test.page');

Route::prefix('api')->group(function () {
    Route::controller(TrackingController::class)->group(function () {
        // Tracking endpoints (POST only)
        Route::post('track', 'trackView');
        Route::post('visit', 'trackVisit');
        Route::post('visit/duration', 'updateVisitDuration');
        Route::post('track-event', 'trackEvent');
    
        // Analytics endpoints (GET only)
        Route::get('analytics', 'getAnalytics');
        Route::get('analytics/realtime', 'getRealTimeStats');
    });
});

