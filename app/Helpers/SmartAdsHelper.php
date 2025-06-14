<?php

// app/Helpers/SmartAdsHelper.php
namespace App\Helpers;

use App\Models\SmartAd;

class SmartAdsHelper
{
    public static function renderAds(string $type = null, string $position = null, string $page = null): string
    {
        $ads = SmartAd::getActiveAds($type, $position, $page);
        
        if ($ads->isEmpty()) {
            return '';
        }
        
        $html = '<div class="smart-ads-container">';
        
        foreach ($ads as $ad) {
            $content = $ad->content;
            $html .= '<div class="smart-ad smart-ad-' . $ad->type . ' smart-ad-' . $ad->position . '" data-ad-id="' . $ad->id . '">';
            
            if (!empty($content['image_url'])) {
                $html .= '<a href="' . ($content['link_url'] ?? '#') . '" target="_blank" onclick="recordClick(' . $ad->id . ')">';
                $html .= '<img src="' . $content['image_url'] . '" alt="' . ($content['alt_text'] ?? $ad->title) . '" class="smart-ad-image">';
                $html .= '</a>';
            }
            
            $html .= '</div>';
        }
        
        $html .= '</div>';
        
        return $html;
    }
    
    public static function getAdsByType(string $type): \Illuminate\Database\Eloquent\Collection
    {
        return SmartAd::getActiveAds($type);
    }
    
    public static function getTotalImpressions(): int
    {
        return SmartAdsAnalytic::sum('impressions');
    }
    
    public static function getTotalClicks(): int
    {
        return SmartAdsAnalytic::sum('clicks');
    }
    
    public static function getAverageCTR(): float
    {
        return SmartAdsAnalytic::avg('ctr') ?? 0;
    }
}