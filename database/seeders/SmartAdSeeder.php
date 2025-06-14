<?php

namespace Database\Seeders;

use App\Models\SmartAd;
use Illuminate\Database\Seeder;

class SmartAdSeeder extends Seeder
{
    public function run()
    {
        $ads = [
            [
                'title' => 'Banner Top Homepage',
                'type' => 'banner',
                'position' => 'top',
                'content' => [
                    'image_url' => 'https://picsum.photos/728/90?random=1',
                    'link_url' => 'https://example.com/banner-top',
                    'alt_text' => 'Banner Advertisement Top'
                ],
                'is_active' => true,
                'priority' => 5,
                'start_date' => now(),
                'end_date' => now()->addMonths(3),
                'target_pages' => 'home,about'
            ],
            [
                'title' => 'Banner Bottom Homepage',
                'type' => 'banner',
                'position' => 'bottom',
                'content' => [
                    'image_url' => 'https://picsum.photos/728/90?random=2',
                    'link_url' => 'https://example.com/banner-bottom',
                    'alt_text' => 'Banner Advertisement Bottom'
                ],
                'is_active' => true,
                'priority' => 4,
                'start_date' => now(),
                'end_date' => now()->addMonths(2),
                'target_pages' => null
            ],
            [
                'title' => 'Sidebar Right Ad',
                'type' => 'sidebar',
                'position' => 'right',
                'content' => [
                    'image_url' => 'https://picsum.photos/300/250?random=3',
                    'link_url' => 'https://example.com/sidebar-right',
                    'alt_text' => 'Sidebar Right Advertisement'
                ],
                'is_active' => true,
                'priority' => 3,
                'start_date' => now(),
                'end_date' => now()->addMonths(1),
                'target_pages' => 'blog,news'
            ],
            [
                'title' => 'Sidebar Left Ad',
                'type' => 'sidebar',
                'position' => 'left',
                'content' => [
                    'image_url' => 'https://picsum.photos/300/250?random=4',
                    'link_url' => 'https://example.com/sidebar-left',
                    'alt_text' => 'Sidebar Left Advertisement'
                ],
                'is_active' => true,
                'priority' => 2,
                'start_date' => now(),
                'end_date' => now()->addMonths(2),
                'target_pages' => null
            ],
            [
                'title' => 'Popup Center Ad',
                'type' => 'popup',
                'position' => 'center',
                'content' => [
                    'image_url' => 'https://picsum.photos/500/400?random=5',
                    'link_url' => 'https://example.com/popup-center',
                    'alt_text' => 'Popup Center Advertisement'
                ],
                'is_active' => true,
                'priority' => 8,
                'start_date' => now(),
                'end_date' => now()->addDays(30),
                'target_pages' => 'home'
            ],
            [
                'title' => 'Inline Content Ad',
                'type' => 'inline',
                'position' => 'center',
                'content' => [
                    'image_url' => 'https://picsum.photos/468/60?random=6',
                    'link_url' => 'https://example.com/inline-content',
                    'alt_text' => 'Inline Content Advertisement'
                ],
                'is_active' => true,
                'priority' => 6,
                'start_date' => now(),
                'end_date' => now()->addMonths(1),
                'target_pages' => 'blog,article'
            ],
            [
                'title' => 'Mobile Banner Ad',
                'type' => 'banner',
                'position' => 'top',
                'content' => [
                    'image_url' => 'https://picsum.photos/320/50?random=7',
                    'link_url' => 'https://example.com/mobile-banner',
                    'alt_text' => 'Mobile Banner Advertisement'
                ],
                'is_active' => true,
                'priority' => 7,
                'start_date' => now(),
                'end_date' => now()->addMonths(2),
                'target_pages' => null
            ],
            [
                'title' => 'Expired Ad (Inactive)',
                'type' => 'banner',
                'position' => 'bottom',
                'content' => [
                    'image_url' => 'https://picsum.photos/728/90?random=8',
                    'link_url' => 'https://example.com/expired',
                    'alt_text' => 'Expired Advertisement'
                ],
                'is_active' => false,
                'priority' => 1,
                'start_date' => now()->subDays(30),
                'end_date' => now()->subDays(1),
                'target_pages' => null
            ]
        ];

        foreach ($ads as $ad) {
            SmartAd::create($ad);
        }

        $this->createSampleAnalytics();
    }

    private function createSampleAnalytics()
    {
        $ads = SmartAd::all();
        
        foreach ($ads as $ad) {
            for ($i = 29; $i >= 0; $i--) {
                $date = now()->subDays($i)->toDateString();
                $impressions = rand(50, 500);
                $clicks = rand(1, 50);
                
                \App\Models\SmartAdsAnalytic::create([
                    'smart_ad_id' => $ad->id,
                    'impressions' => $impressions,
                    'clicks' => $clicks,
                    'ctr' => ($clicks / $impressions) * 100,
                    'date' => $date
                ]);
            }
        }
    }
}
