<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class EditorialTeamController extends Controller
{
    /**
     * Display the editorial team page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get settings from the database
        $settings = Setting::first()->value ?? [];
        
        return view('pages.editorial', compact('settings'));
    }
}