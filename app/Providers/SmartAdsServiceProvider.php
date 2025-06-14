<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Console\Commands\ClearSmartAdsCache;
use App\Console\Commands\SmartAdsAnalytics;

class SmartAdsServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                ClearSmartAdsCache::class,
                SmartAdsAnalytics::class,
            ]);
        }
    }
}

