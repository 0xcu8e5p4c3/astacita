<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Article;

class ArticleViewController extends Controller
{
    public function show($categorySlug, $articleSlug)
    {
        // Cari kategori berdasarkan slug
        $category = Category::where('slug', $categorySlug)->firstOrFail();
    
        // Cari artikel berdasarkan slug dan kategori
        $viewarticle = Article::where('slug', $articleSlug)
            ->where('category_id', $category->id)
            ->with(['category', 'author', 'tags', 'media'])
            ->firstOrFail();
    
        // Kembalikan ke view-article dengan data artikel
        return view('view-article', compact('viewarticle'));
    }
    
}


