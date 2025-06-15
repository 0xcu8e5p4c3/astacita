<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WebsiteSetting;

class AboutController extends Controller
{
    public function tentang()
    {
        $setting = WebsiteSetting::getInstance();
        
        return view('pages.about', compact('setting'));
    }
    
    public function redaksi()
    {
        $setting = WebsiteSetting::getInstance();
        
        return view('pages.editorial', compact('setting'));
    }
    
    public function kodeEtik()
    {
        $setting = WebsiteSetting::getInstance();
        
        return view('pages.ethics-code', compact('setting'));
    }

        public function cyberGuidelines()
    {
        $setting = WebsiteSetting::getInstance();
        
        return view('pages.cyber-guidelines', compact('setting'));
    }
        public function contact()
    {
        $setting = WebsiteSetting::getInstance();
        
        return view('pages.contact', compact('setting'));
    }
}