<?php

// app/Console/Commands/ClearSmartAdsCache.php
namespace App\Console\Commands;

use App\Models\SmartAd;
use Illuminate\Console\Command;

class ClearSmartAdsCache extends Command
{
    protected $signature = 'smart-ads:clear-cache';
    protected $description = 'Clear smart ads cache';

    public function handle()
    {
        SmartAd::clearCache();
        $this->info('Smart ads cache cleared successfully!');
        return 0;
    }
}
