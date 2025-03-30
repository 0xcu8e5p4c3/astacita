<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article; // Sesuaikan dengan model yang digunakan

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('q');

        $results = Article::where('title', 'LIKE', "%{$query}%")
            ->orWhere('content', 'LIKE', "%{$query}%")
            ->orderBy('created_at', 'desc')
            ->get();

        return view('search-results', compact('results', 'query'));
    }
}
