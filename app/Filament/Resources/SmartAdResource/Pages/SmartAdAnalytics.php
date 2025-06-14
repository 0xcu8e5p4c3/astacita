<?php

// app/Filament/Resources/SmartAdResource/Pages/SmartAdAnalytics.php
namespace App\Filament\Resources\SmartAdResource\Pages;

use App\Filament\Resources\SmartAdResource;
use App\Models\SmartAd;
use App\Models\SmartAdAnalytic;
use Filament\Resources\Pages\Page;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class SmartAdAnalytics extends Page
{
    protected static string $resource = SmartAdResource::class;
    protected static string $view = 'filament.resources.smart-ad-resource.pages.smart-ad-analytics';
    protected static ?string $title = 'Smart Ads Analytics';
    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';

    public function getWidgets(): array
    {
        return [
            SmartAdStatsWidget::class,
            SmartAdChartWidget::class,
            SmartAdPerformanceWidget::class,
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return $this->getWidgets();
    }
}