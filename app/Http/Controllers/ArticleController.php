<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Article;
use App\Models\Category;

class ArticleController extends Controller
{
    public function showCategory(Request $request, $categorySlug)
    {
        // Ambil kategori berdasarkan slug
        $category = Category::where('slug', $categorySlug)->firstOrFail();

        // Ambil berita trending berdasarkan jumlah views terbanyak
        $trending = Article::where('category_id', $category->id)
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->withCount('views')
            ->orderByDesc('views_count') 
            ->limit(5)
            ->get();
        
        // Ambil berita terbaru yang sudah dipublikasikan
        $articles = Article::where('category_id', $category->id)
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->orderByDesc('published_at') 
            ->limit(5)
            ->get();

        $totalArticles = Article::where('category_id', $category->id)
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->count();
        
        return view('page_category1', compact('category', 'trending', 'articles', 'totalArticles'));
    }
    
    
    public function loadMore(Request $request, $slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $offset = (int) $request->query('offset', 0);
        $limit = 5;

        $articles = Article::where('category_id', $category->id)
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->orderByDesc('published_at')
            ->skip($offset)
            ->take($limit)
            ->get();

        $html = '';
        foreach ($articles as $article) {
            $html .= view('articles.partials.article_list', compact('article'))->render();
        }

        $total = Article::where('category_id', $category->id)
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->count();

        return response()->json([
            'html' => $html,
            'hasMore' => ($offset + $limit) < $total
        ]);
    }


    
}