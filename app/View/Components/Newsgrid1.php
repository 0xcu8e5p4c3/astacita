<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Article;

class NewsGrid1 extends Component
{
    public $news;
    public $featured;
    public $articles;

    public function __construct()
    {
        // Ambil artikel trending berdasarkan jumlah views terbanyak
        $this->news = Article::withCount('views')->orderBy('views_count', 'desc')->take(5)->get();

        // Ambil artikel yang paling banyak views untuk featured
        $this->featured = Article::withCount('views')->orderBy('views_count', 'desc')->first();

        // Ambil 3 artikel terbaru
        $this->articles = Article::latest()->take(3)->get();
    }

    public function render()
    {
        return view('components.newsgrid1');
    }
}
