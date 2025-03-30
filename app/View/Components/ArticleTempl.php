<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Article;

class ArticleTempl extends Component
{
    public $article;

    /**
     * Buat instance komponen.
     */
    public function __construct($slug)
    {
        $this->article = Article::where('slug', $slug)
            ->with(['category', 'author', 'tags', 'media'])
            ->firstOrFail();
    }

    /**
     * Render tampilan komponen.
     */
    public function render()
    {
        return view('components.article-templ', [
            'article' => $this->article
        ]);
    }
}
