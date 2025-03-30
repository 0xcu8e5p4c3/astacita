<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewArticle extends Controller
{
    public function show($slug)
{
    $article = Article::where('slug', $slug)
        ->with(['category', 'author', 'tags', 'media'])
        ->firstOrFail();

    return view('view-article', compact('article'));
}

}
