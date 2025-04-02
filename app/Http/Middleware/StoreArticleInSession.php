<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Article;

class StoreArticleInSession
{
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah request memiliki parameter "slug"
        if ($request->route('slug')) {
            // Ambil artikel berdasarkan slug
            $article = Article::where('slug', $request->route('slug'))
                ->with(['category', 'author', 'tags', 'media'])
                ->first();

            // Simpan artikel ke dalam session jika ditemukan
            if ($article) {
                session(['currentArticle' => $article]);
            }
        }

        return $next($request);
    }
}
