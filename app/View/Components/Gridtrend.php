<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Article;

class Gridtrend extends Component
{
    public $hometrend;

    public function __construct()
    {
        // Ambil artikel trending berdasarkan jumlah views
        $this->hometrend = Article::where('status', 'published')
            ->whereNotNull('published_at')
            ->withCount('views') // Menghitung jumlah views dari tabel views
            ->orderByDesc('views_count') // Urutkan berdasarkan jumlah views
            ->limit(15)
            ->get();
    }

    public function render()
    {
        return view('components.gridtrend', ['hometrend' => $this->hometrend]);
    }
}
