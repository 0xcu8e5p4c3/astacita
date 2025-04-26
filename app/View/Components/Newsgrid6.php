<?php

namespace App\View\Components;

use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
            ->simplePaginate(6);
    }
    public function loadMoreDiscover(Request $request)
    {
        $page = $request->input('page', 1);
    
        $articles = Article::where('status', 'published')
            ->where('published_at', '>=', Carbon::now()->subDays(10))
            ->inRandomOrder()
            ->paginate(6, ['*'], 'page', $page);
    
        return response()->json([
            'html' => view('articles.partials.article_list2  ', ['articles' => $articles])->render(),
            'next_page' => $page + 1,
            'has_more' => $articles->hasMorePages()
        ]);
    }
    public function render(): View|Closure|string
    {
        return view('components.newsgrid6');
    }
}
