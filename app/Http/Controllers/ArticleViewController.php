<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Article;

class ArticleViewController extends Controller
{
    public function show($categorySlug, $articleSlug)
    {
        $category = Category::where('slug', $categorySlug)->firstOrFail();
    
        $viewarticle = Article::where('slug', $articleSlug)
            ->where('category_id', $category->id)
            ->with(['category', 'author', 'tags', 'media'])
            ->firstOrFail();
    
        return view('view-article', compact('viewarticle'));
    }
    
}


