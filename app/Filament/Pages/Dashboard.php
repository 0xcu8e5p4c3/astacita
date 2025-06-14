<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use App\Filament\Widgets\PopularArticlesTable;
use App\Filament\Widgets\SmartAdCrartWidget;
use App\Filament\Widgets\SmartAdPerformanceWidget;
use App\Filament\Widgets\SmartAdStatsWidget;
use App\Filament\Widgets\TopArticlesChart;
use App\Filament\Widgets\ViewsOverTimeChart;
use App\Filament\Widgets\ViewsStatsOverview;
class Dashboard extends BaseDashboard
{
    public function getWidgets(): array
    {
        return [
            
        ];
    }
}
