<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;

class Profile extends Component
{
    public $profile;
    public $role;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $user = Auth::user();
        $this->role = $user?->role ?? 'guest';
        $this->profile = $user?->profile;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.profile', [
            'profile' => $this->profile,
            'role' => $this->role,
        ]);
    }
}
