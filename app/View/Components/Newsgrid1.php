<?php

namespace App\View\Components;

use App\Models\Article;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Newsgrid1 extends Component
{
    public $featured;
    public $news;
    public $leftArticle;
    public $rightArticle;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        // Ambil artikel featured terbaru
        $this->featured = Article::where('is_featured', 1)
            ->where('status', 'published')
            ->orderByDesc('published_at')
            ->first();

        // Ambil 4 artikel terbaru yang bukan featured & berbeda dari artikel featured
        $this->news = Article::where('status', 'published')
            ->where(function ($query) {
                $query->where('is_featured', 0);
                if ($this->featured) {
                    $query->orWhere('id', '!=', $this->featured->id);
                }
            })
            ->orderByDesc('published_at')
            ->take(4)
            ->get();

        // Tetapkan left dan right article (jika tersedia)
        $this->leftArticle = $this->news->get(0);
        $this->rightArticle = $this->news->get(1);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.newsgrid1');
    }
}
