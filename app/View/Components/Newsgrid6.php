<?php

namespace App\View\Components;

use App\Models\Article;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Newsgrid6 extends Component
{
    public $articles;

    public function __construct()
    {
        // Ambil artikel dari 10 hari terakhir secara acak
        $this->articles = Article::where('status', 'published')
            ->where('published_at', '>=', Carbon::now()->subDays(10))
            ->inRandomOrder()
            ->take(6)
            ->get();
    }

    public function render(): View|Closure|string
    {
        return view('components.newsgrid6');
    }
}
