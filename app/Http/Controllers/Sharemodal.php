<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Sharemodal extends Controller
{
    public function show()
    {
        // Mengembalikan view modal (file: resources/views/modal.blade.php)
        return view('modal');
    }
}
