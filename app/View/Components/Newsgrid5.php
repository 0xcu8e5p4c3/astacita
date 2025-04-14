<?php

namespace App\View\Components;

use App\Models\Article;
use App\Models\Category;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Newsgrid5 extends Component
{
    public $featuredArticle;
    public $trendingArticles;
    public $latestArticles;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        // Ambil artikel untuk berita utama (featured)
        $this->featuredArticle = Article::orderBy('created_at', 'desc')->first();

        // Ambil kategori 'crypto'
        $category = Category::where('name', 'crypto')->first(); // Ambil kategori dengan nama 'crypto'

        // Jika kategori 'crypto' ada, ambil artikel terkait
        if ($category) {
            // Ambil artikel trending berdasarkan jumlah views terbanyak
            $this->trendingArticles = Article::where('category_id', $category->id)
                ->where('status', 'published')
                ->whereNotNull('published_at')
                ->withCount('views') // Menghitung jumlah views
                ->orderByDesc('views_count') // Urutkan berdasarkan jumlah views
                ->take(15)
                ->get();
        } else {
            $this->trendingArticles = collect(); // Jika kategori tidak ditemukan
        }

        // Ambil artikel terbaru di kategori 'crypto'
        $this->latestArticles = Article::where('category_id', $category ? $category->id : null)
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->orderByDesc('published_at') // Urutkan berdasarkan tanggal publish
            ->take(15)
            ->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.newsgrid5');
    }
}
