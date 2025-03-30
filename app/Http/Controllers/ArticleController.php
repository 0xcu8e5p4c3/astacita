<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;

class ArticleController extends Controller
{
    public function category(Request $request, $slug)
    {
        // Ambil kategori berdasarkan slug
        $category = Category::where('slug', $slug)->firstOrFail();

        // Ambil berita trending berdasarkan jumlah views terbanyak
        $trending = Article::where('category_id', $category->id)
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->withCount('views') // Menghitung jumlah views dari tabel views
            ->orderByDesc('views_count') // Urutkan berdasarkan jumlah views
            ->limit(5)
            ->get();
        
        // Ambil berita terbaru yang sudah dipublikasikan
        $articles = Article::where('category_id', $category->id)
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->orderByDesc('published_at') // Order berdasarkan tanggal publish
            ->limit(5)
            ->get();
            
        return view('page_category1', compact('category', 'trending', 'articles'));
    }

    public function show($slug)
    {
        $article = Article::where('slug', $slug)
            ->with(['category', 'author', 'tags', 'media'])
            ->firstOrFail();

        return view('view-article', compact('article'));
    }


    public function loadMore(Request $request, $slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        
        $offset = (int) $request->offset; // Pastikan offset adalah integer
        \Log::info("Offset yang diterima: " . $offset); // Cek nilai offset di log

        // Ambil artikel dengan limit dan offset
        $moreArticles = Article::where('category_id', $category->id)
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->orderByDesc('published_at')
            ->skip($offset)
            ->take(5)
            ->get();

        \Log::info("Jumlah artikel yang diambil: " . $moreArticles->count()); // Debug jumlah artikel yang diambil

        if ($moreArticles->isEmpty()) {
            return response()->json(['html' => '']); // Jika tidak ada artikel lagi, kirim kosong
        }

        return response()->json([
            'html' => view('articles.partials.article_list', ['articles' => $moreArticles])->render()
        ]);

    }
}