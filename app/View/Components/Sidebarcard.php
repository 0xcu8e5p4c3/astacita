<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Article;
use App\Models\Tags;

class Sidebarcard extends Component
{
    public $articles;
    public $tags;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        // Ambil 2 artikel terbaru yang sudah dipublikasikan
        $this->articles = Article::where('published', true)
                                 ->orderBy('published_at', 'desc')
                                 ->take(5)
                                 ->get();

        // Ambil tags yang paling banyak dipakai dalam artikel
        $this->tags = Tags::select('tags.id', 'tags.name')
            ->join('article_tag', 'tags.id', '=', 'article_tag.tag_id')
            ->selectRaw('COUNT(article_tag.article_id) as tag_count')
            ->groupBy('tags.id', 'tags.name')
            ->orderByDesc('tag_count')
            ->take(10) // Ambil 10 tag paling populer
            ->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.sidebarcard', [
            'articles' => $this->articles,
            'tags' => $this->tags
        ]);
    }
}
