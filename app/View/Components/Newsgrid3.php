<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Category;

class Newsgrid3 extends Component
{
    public $okegas;
    public $bumn;
    public $kabinet;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        // Ambil kategori berdasarkan slug
        $okegasCategory = Category::where('slug', 'oke-gas')->first();
        $bumnCategory = Category::where('slug', 'bumn')->first();
        $kabinetCategory = Category::where('slug', 'kabinet')->first();

        // Ambil artikel berdasarkan kategori dan pastikan author dimuat
        $this->okegas = $okegasCategory ? $okegasCategory->articles()->with('author')->latest()->take(4)->get() : collect();
        $this->bumn = $bumnCategory ? $bumnCategory->articles()->with('author')->latest()->take(4)->get() : collect();
        $this->kabinet = $kabinetCategory ? $kabinetCategory->articles()->with('author')->latest()->take(4)->get() : collect();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.newsgrid3', [
            'okegas' => $this->okegas,
            'bumn' => $this->bumn,
            'kabinet' => $this->kabinet,
        ]);
    }
}
