<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function about()
    {
        $data = [
            'site_name' => Setting::getSetting('site_name') ?? 'Astacita.co',
            'site_tagline' => Setting::getSetting('site_tagline') ?? 'Berita dan Informasi Terpercaya',
            'about_description' => Setting::getSetting('about_description') ?? '',
            'visi' => Setting::getSetting('visi') ?? '',
            'misi' => Setting::getSetting('misi') ?? '',
            'year_established' => Setting::getSetting('year_established') ?? '2020',
            'site_logo' => Setting::getSetting('site_logo'),
        ];

        return view('pages.about', compact('data'));
    }

    public function editorial()
    {
        $data = [
            'editorial_team' => Setting::getSetting('editorial_team') ?? [],
            'editorial_statement' => Setting::getSetting('editorial_statement') ?? '',
        ];

        return view('pages.editorial', compact('data'));
    }

    public function ethicsCode()
    {
        $data = [
            'ethics_code' => Setting::getSetting('ethics_code') ?? '',
            'ethics_last_updated' => Setting::getSetting('ethics_last_updated'),
        ];

        return view('pages.ethics-code', compact('data'));
    }

    public function cyberGuidelines()
    {
        $data = [
            'cyber_media_guidelines' => Setting::getSetting('cyber_media_guidelines') ?? '',
            'guidelines_last_updated' => Setting::getSetting('guidelines_last_updated'),
            'guidelines_reference' => Setting::getSetting('guidelines_reference'),
        ];

        return view('pages.cyber-guidelines', compact('data'));
    }

    public function contact()
    {
        $data = [
            'contact_email' => Setting::getSetting('contact_email') ?? '',
            'contact_phone' => Setting::getSetting('contact_phone') ?? '',
            'contact_address' => Setting::getSetting('contact_address') ?? '',
            'maps_embed_code' => Setting::getSetting('maps_embed_code') ?? '',
            'social_facebook' => Setting::getSetting('social_facebook') ?? '',
            'social_twitter' => Setting::getSetting('social_twitter') ?? '',
            'social_instagram' => Setting::getSetting('social_instagram') ?? '',
            'social_youtube' => Setting::getSetting('social_youtube') ?? '',
            'social_linkedin' => Setting::getSetting('social_linkedin') ?? '',
        ];

        return view('pages.contact', compact('data'));
    }
}
