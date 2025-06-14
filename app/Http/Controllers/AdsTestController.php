<?php

// app/Http/Controllers/AdsTestController.php
namespace App\Http\Controllers;

use App\Models\SmartAd;
use Illuminate\Http\Request;

class AdsTestController extends Controller
{
    public function index()
    {
        $allAds = SmartAd::with('analytics')->get();
        $activeAds = SmartAd::where('is_active', true)->get();
        
        return view('ads-test', compact('allAds', 'activeAds'));
    }
    
    public function testPage($page = 'home')
    {
        $ads = SmartAd::getActiveAds(null, null, $page);
        
        return view('ads-test-page', compact('ads', 'page'));
    }
}