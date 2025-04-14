<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Article;

class Newsgrid4 extends Component
{
    public $news;

    public function __construct()
    {
        $this->news = Article::with(['category', 'author'])
            ->withCount('views')
            ->orderByDesc('views_count')
            ->take(3)
            ->get();
    }

    public function render(): View|Closure|string
    {
        return view('components.newsgrid4');
    }
}
