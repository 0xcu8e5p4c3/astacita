<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Article;
use Carbon\Carbon;

class PublishScheduledPosts extends Command
{
    protected $signature = 'posts:publish';
    protected $description = 'Publikasikan artikel yang telah dijadwalkan';

    public function handle()
    {
        $now = Carbon::now();

        $articles = Article::where('status', 'scheduled')
            ->where('scheduled_at', '<=', $now)
            ->get();

        foreach ($articles as $article) {
            $article->update([
                'status' => 'published',
                'published_at' => $now,
            ]);
        }

        $this->info('Artikel terjadwal telah dipublikasikan.');
    }
}
