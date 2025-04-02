<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Category;

class Footer extends Component
{
    public $categories;

    /**
     * Membuat instance komponen baru.
     *
     * @return void
     */
    public function __construct()
    {
        // Ambil semua kategori dari model Category
        $this->categories = Category::all();
    }

    /**
     * Mendapatkan view / konten yang mewakili komponen ini.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        // Kirim variabel categories ke view footer
        return view('components.footer', ['categories' => $this->categories]);
    }
}
