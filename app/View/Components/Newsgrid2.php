<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Video;

class Newsgrid2 extends Component
{
    public string $type;

    public function __construct(string $type = 'all')
    {
        $this->type = $type;
    }

    /**
     * Ambil video berdasarkan tipe
     */
    protected function getVideos()
    {
        if ($this->type === 'tiktok') {
            return Video::where('platform', 'tiktok')->latest()->take(5)->get();
        } elseif ($this->type === 'youtube') {
            return Video::where('platform', 'youtube')->latest()->take(5)->get();
        }

        return [
            'tiktok' => Video::where('platform', 'tiktok')->latest()->take(5)->get(),
            'youtube' => Video::where('platform', 'youtube')->latest()->take(5)->get(),
        ];
    }

    /**
     * Ambil ID dari URL TikTok
     */
    public function getTikTokId(string $url): ?string
    {
        $pattern = '/(?:https?:\/\/)?(?:www\.)?tiktok\.com\/@[\w.-]+\/video\/(\d+)/';

        return preg_match($pattern, $url, $matches) ? $matches[1] : null;
    }

    /**
     * Ambil ID dari URL YouTube
     */
    public function getYouTubeId(string $url): ?string
    {
        $pattern = '/(?:youtube\.com.*(?:\\?|&)v=|youtu\.be\/)([a-zA-Z0-9_-]{11})/';

        return preg_match($pattern, $url, $matches) ? $matches[1] : null;
    }

    /**
     * Tampilkan komponen
     */
    public function render()
    {
        return function (array $data) {
            $data['videos'] = $this->getVideos();
            $data['type'] = $this->type;
            $data['getTikTokId'] = fn($url) => $this->getTikTokId($url);
            $data['getYouTubeId'] = fn($url) => $this->getYouTubeId($url);

            return view('components.Newsgrid2', $data);
        };
    }
}
