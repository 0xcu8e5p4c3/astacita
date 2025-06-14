<?php

namespace App\Filament\Widgets;

use App\Models\SmartAdsAnalytic;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class SmartAdStatsWidget extends BaseWidget
{
    protected static ?int $sort = 1;
    protected function getStats(): array
    {
        $totalImpressions = SmartAdsAnalytic::sum('impressions');
        $totalClicks = SmartAdsAnalytic::sum('clicks');
        $avgCtr = SmartAdsAnalytic::avg('ctr');
        $activeAds = \App\Models\SmartAd::where('is_active', true)->count();

        return [
            Stat::make('Total Impressions', number_format($totalImpressions))
                ->description('All time impressions')
                ->descriptionIcon('heroicon-m-eye')
                ->color('success'),

            Stat::make('Total Clicks', number_format($totalClicks))
                ->description('All time clicks')
                ->descriptionIcon('heroicon-m-cursor-arrow-rays')
                ->color('info'),

            Stat::make('Average CTR', number_format($avgCtr, 2) . '%')
                ->description('Click through rate')
                ->descriptionIcon('heroicon-m-chart-bar')
                ->color('warning'),

            Stat::make('Active Ads', $activeAds)
                ->description('Currently active')
                ->descriptionIcon('heroicon-m-megaphone')
                ->color('primary'),
        ];
    }
}
