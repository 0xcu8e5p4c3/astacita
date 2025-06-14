<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\View;
use App\Models\ScrollTracking;
use App\Models\TimeTracking;
use Carbon\Carbon;

class CleanupOldViews extends Command
{
    protected $signature = 'views:cleanup {--days=90 : Number of days to keep}';
    protected $description = 'Clean up old view tracking data';

    public function handle()
    {
        $days = $this->option('days');
        $cutoffDate = Carbon::now()->subDays($days);

        $this->info("Cleaning up view data older than {$days} days...");

        // Clean up views
        $viewsDeleted = View::where('viewed_at', '<', $cutoffDate)->delete();
        $this->info("Deleted {$viewsDeleted} old view records");

        // Clean up scroll tracking
        $scrollDeleted = ScrollTracking::where('tracked_at', '<', $cutoffDate)->delete();
        $this->info("Deleted {$scrollDeleted} old scroll tracking records");

        // Clean up time tracking
        $timeDeleted = TimeTracking::where('created_at', '<', $cutoffDate)->delete();
        $this->info("Deleted {$timeDeleted} old time tracking records");

        $this->info('Cleanup completed successfully!');
    }
}