<?php

if (!function_exists('website_setting')) {
    /**
     * Get website setting value
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    function website_setting($key, $default = null)
    {
        return \App\Models\WebsiteSetting::get($key, $default);
    }
}

if (!function_exists('site_name')) {
    /**
     * Get site name
     *
     * @return string
     */
    function site_name()
    {
        return website_setting('site_name', config('app.name', 'Astacita.co'));
    }
}

if (!function_exists('site_tagline')) {
    /**
     * Get site tagline
     *
     * @return string
     */
    function site_tagline()
    {
        return website_setting('site_tagline', 'Portal Berita Terpercaya');
    }
}

if (!function_exists('site_logo_url')) {
    /**
     * Get site logo URL
     *
     * @return string|null
     */
    function site_logo_url()
    {
        $logo = website_setting('site_logo');
        return $logo ? asset('storage/' . $logo) : null;
    }
}

if (!function_exists('site_favicon_url')) {
    /**
     * Get site favicon URL
     *
     * @return string|null
     */
    function site_favicon_url()
    {
        $favicon = website_setting('site_favicon');
        return $favicon ? asset('storage/' . $favicon) : null;
    }
}

if (!function_calls('editorial_team')) {
    /**
     * Get editorial team with photo URLs
     *
     * @return array
     */
    function editorial_team()
    {
        $team = website_setting('editorial_team', []);
        
        return collect($team)->map(function ($member) {
            if (isset($member['photo']) && $member['photo']) {
                $member['photo_url'] = asset('storage/' . $member['photo']);
            }
            return $member;
        })->toArray();
    }
}

if (!function_exists('social_media_links')) {
    /**
     * Get all social media links
     *
     * @return array
     */
    function social_media_links()
    {
        return [
            'facebook' => website_setting('social_facebook'),
            'twitter' => website_setting('social_twitter'),
            'instagram' => website_setting('social_instagram'),
            'youtube' => website_setting('social_youtube'),
            'linkedin' => website_setting('social_linkedin'),
        ];
    }
}

if (!function_exists('contact_info')) {
    /**
     * Get contact information
     *
     * @return array
     */
    function contact_info()
    {
        return [
            'email' => website_setting('contact_email'),
            'phone' => website_setting('contact_phone'),
            'address' => website_setting('contact_address'),
            'maps_embed' => website_setting('maps_embed_code'),
        ];
    }
}