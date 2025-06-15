<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\WebsiteSetting;

class WebsiteSettingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Share website settings with all views
        View::composer('*', function ($view) {
            try {
                $settings = WebsiteSetting::getInstance();
                
                // Share common settings
                $view->with([
                    'siteName' => $settings->site_name ?? config('app.name'),
                    'siteTagline' => $settings->site_tagline ?? '',
                    'siteLogoUrl' => $settings->site_logo ? asset('storage/' . $settings->site_logo) : null,
                    'siteFaviconUrl' => $settings->site_favicon ? asset('storage/' . $settings->site_favicon) : null,
                    'contactEmail' => $settings->contact_email ?? '',
                    'contactPhone' => $settings->contact_phone ?? '',
                    'socialMediaLinks' => [
                        'facebook' => $settings->social_facebook,
                        'twitter' => $settings->social_twitter,
                        'instagram' => $settings->social_instagram,
                        'youtube' => $settings->social_youtube,
                        'linkedin' => $settings->social_linkedin,
                    ],
                    'websiteSettings' => $settings,
                ]);
            } catch (\Exception $e) {
                // Handle case where database is not set up yet or table doesn't exist
                $view->with([
                    'siteName' => config('app.name', 'Astacita.co'),
                    'siteTagline' => 'Portal Berita Terpercaya',
                    'siteLogoUrl' => null,
                    'siteFaviconUrl' => null,
                    'contactEmail' => '',
                    'contactPhone' => '',
                    'socialMediaLinks' => [],
                    'websiteSettings' => null,
                ]);
            }
        });
    }
}