<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article; // Pastikan model yang digunakan sudah sesuai

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('q'); // Ambil kata kunci pencarian
    
        // Cari artikel berdasarkan judul atau konten yang mengandung kata kunci
        $results = Article::where('title', 'LIKE', "%{$query}%")
                          ->orWhere('content', 'LIKE', "%{$query}%")
                          ->orderBy('created_at', 'desc')
                          ->get();
    
        // Kirim hasil pencarian dan kata kunci ke view
        return view('search-results', compact('results', 'query'));
    }
    
}
