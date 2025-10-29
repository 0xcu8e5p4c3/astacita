<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class WebsiteSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_name',
        'site_tagline',
        'site_logo',
        'site_favicon',
        'about_description',
        'visi',
        'misi',
        'about_short_description',
        'year_established',
        'editorial_team',
        'editorial_statement',
        'ethics_code',
        'ethics_last_updated',
        'cyber_media_guidelines',
        'guidelines_last_updated',
        'guidelines_reference',
        'contact_email',
        'contact_phone',
        'contact_address',
        'maps_embed_code',
        'social_facebook',
        'social_twitter',
        'social_instagram',
        'social_youtube',
        'social_linkedin',
        'coinmarketcap_api_key',
        'crypto_ticker_enabled',
    ];

    protected $casts = [
        'editorial_team' => 'array',
        'ethics_last_updated' => 'date',
        'guidelines_last_updated' => 'date',
        'crypto_ticker_enabled' => 'boolean',
    ];

    /**
     * Get the single website setting instance
     */
    public static function getInstance()
    {
        $setting = self::first();
        
        if (!$setting) {
            $setting = self::create([
                'site_name' => 'Astacita.co',
                'site_tagline' => 'Portal Berita Terpercaya',
            ]);
        }
        
        return $setting;
    }

    /**
     * Helper method to get specific setting value
     */
    public static function get($key, $default = null)
    {
        $setting = self::getInstance();
        return $setting->$key ?? $default;
    }

    /**
     * Helper method to set specific setting value
     */
    public static function set($key, $value)
    {
        $setting = self::getInstance();
        $setting->update([$key => $value]);
        return $setting;
    }

    /**
     * Get site logo URL
     */
    protected function siteLogoUrl(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->site_logo ? asset('storage/' . $this->site_logo) : null,
        );
    }

    /**
     * Get site favicon URL
     */
    protected function siteFaviconUrl(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->site_favicon ? asset('storage/' . $this->site_favicon) : null,
        );
    }

    /**
     * Get editorial team with photo URLs
     */
    protected function editorialTeamWithPhotos(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                if (!$this->editorial_team) return [];
                
                return collect($this->editorial_team)->map(function ($member) {
                    if (isset($member['photo']) && $member['photo']) {
                        $member['photo_url'] = asset('storage/' . $member['photo']);
                    }
                    return $member;
                })->toArray();
            }
        );
    }

    /**
     * Check if social media links exist
     */
    public function hasSocialMedia()
    {
        return $this->social_facebook || 
               $this->social_twitter || 
               $this->social_instagram || 
               $this->social_youtube || 
               $this->social_linkedin;
    }

    /**
     * Get all social media links as array
     */
    public function getSocialMediaLinks()
    {
        return [
            'facebook' => $this->social_facebook,
            'twitter' => $this->social_twitter,
            'instagram' => $this->social_instagram,
            'youtube' => $this->social_youtube,
            'linkedin' => $this->social_linkedin,
        ];
    }
    
    protected function coinmarketcapApiKey(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? decrypt($value) : null,
            set: fn ($value) => $value ? encrypt($value) : null,
        );
    }
}