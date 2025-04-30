<?php

namespace App\Services;

class VideoService
{
    /**
     * Generate embed code for a TikTok URL
     * 
     * @param string $url
     * @return array
     */
    public function processTikTokVideo(string $url): array
    {
        // Extract TikTok video ID from URL
        preg_match('/\/@[^\/]+\/video\/(\d+)/', $url, $matches);
        $videoId = $matches[1] ?? null;
        
        if (!$videoId) {
            return [
                'embed_code' => null,
                'thumbnail' => null
            ];
        }
        
        // Generate embed code
        $embedCode = '<blockquote class="tiktok-embed" cite="' . $url . '" 
                     data-video-id="' . $videoId . '" style="max-width: 100%; min-width: 240px; min-height: 375px;">
                     <section></section></blockquote>
                     <script async src="https://www.tiktok.com/embed.js"></script>';
        
        // We'll use the embed code only, no need for thumbnails as we'll use the embed directly
        
        return [
            'embed_code' => $embedCode,
            'thumbnail' => null
        ];
    }
    
    /**
     * Generate embed code for a YouTube URL
     * 
     * @param string $url
     * @return array
     */
    public function processYouTubeVideo(string $url): array
    {
        // Extract YouTube video ID from URL
        if (strpos($url, 'youtu.be/') !== false) {
            // Short URL format
            preg_match('/youtu\.be\/([a-zA-Z0-9_-]+)/', $url, $matches);
        } else {
            // Standard URL format
            preg_match('/v=([a-zA-Z0-9_-]+)/', $url, $matches);
        }
        
        $videoId = $matches[1] ?? null;
        
        if (!$videoId) {
            return [
                'embed_code' => null
            ];
        }
        
        // Generate embed code - thumbnails will be handled in the view
        $embedCode = '<iframe width="100%" height="100%" src="https://www.youtube.com/embed/' . $videoId . '" 
                     frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                     allowfullscreen style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"></iframe>';
        
        return [
            'embed_code' => $embedCode
        ];
    }
}