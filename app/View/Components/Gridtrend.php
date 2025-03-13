<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Article;

class Gridtrend extends Component
{
    public $news;

    public function __construct()
    {
        // Ambil 5 artikel dengan jumlah views terbanyak
        $this->news = Article::withCount('views')->orderBy('views_count', 'desc')->take(5)->get();
    }

    public function render()
    {
        return view('components.gridtrend')->with('news', $this->news);
    }
    
}
