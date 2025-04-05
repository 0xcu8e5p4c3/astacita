<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Article;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class NewsGrid1 extends Component
{
    public $news;
    public $featured;
    public $articles;
    public $leftArticle;
    public $rightArticle;

    public function __construct()
    {
        // Cache key berdasarkan minggu ini
        $cacheKey = 'newsgrid1_' . Carbon::now()->startOfWeek()->format('Y-m-d');

        if (!Cache::has($cacheKey)) {
            // Ambil semua artikel yang tersedia
            $allArticles = Article::inRandomOrder()->get();

            // Pastikan jumlah artikel cukup untuk dipilih
            if ($allArticles->count() < 7) {
                abort(500, "Tidak cukup artikel untuk ditampilkan!");
            }

            // Pilih artikel secara acak tanpa duplikasi
            $this->featured = $allArticles->pop(); // 1 Featured
            $this->leftArticle = $allArticles->pop(); // 1 Left Image Section
            $this->rightArticle = $allArticles->pop(); // 1 Right Text Section
            $this->articles = $allArticles->splice(0, 3); // 3 Artikel terbaru
            $this->news = $allArticles->splice(0, 4); // 4 Artikel untuk Bottom Section

            // Simpan ke cache selama 7 hari
            Cache::put($cacheKey, [
                'news' => $this->news,
                'featured' => $this->featured,
                'articles' => $this->articles,
                'leftArticle' => $this->leftArticle,
                'rightArticle' => $this->rightArticle,
            ], now()->addDays(7));
        } else {
            // Ambil dari cache jika sudah ada
            $cachedData = Cache::get($cacheKey);
            $this->news = $cachedData['news'];
            $this->featured = $cachedData['featured'];
            $this->articles = $cachedData['articles'];
            $this->leftArticle = $cachedData['leftArticle'];
            $this->rightArticle = $cachedData['rightArticle'];
        }
    }

    public function render()
    {
        return view('components.newsgrid1', [
            'news' => $this->news,
            'featured' => $this->featured,
            'articles' => $this->articles,
            'leftArticle' => $this->leftArticle,
            'rightArticle' => $this->rightArticle,
        ]);
    }
}
