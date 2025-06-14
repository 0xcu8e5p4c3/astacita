<?php

namespace App\Console\Commands;

use App\Models\SmartAd;
use App\Models\SmartAdsAnalytic;
use Illuminate\Console\Command;

class SmartAdsAnalytics extends Command
{
    protected $signature = 'smart-ads:update-analytics';
    protected $description = 'Update smart ads analytics CTR calculations';

    public function handle()
    {
        $analytics = SmartAdsAnalytic::all();
        
        foreach ($analytics as $analytic) {
            $analytic->updateCtr();
        }
        
        $this->info('Smart ads analytics updated successfully!');
        return 0;
    }
}