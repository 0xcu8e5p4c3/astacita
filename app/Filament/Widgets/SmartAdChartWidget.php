<?php

namespace App\Filament\Widgets;

use App\Models\SmartAdsAnalytic;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class SmartAdChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Ads Performance (Last 30 Days)';
    protected int | string | array $columnSpan = '3';
    protected static ?int $sort = 5;
    

    protected function getData(): array
    {
        $data = SmartAdsAnalytic::where('date', '>=', Carbon::now()->subDays(30))
            ->selectRaw('date, SUM(impressions) as total_impressions, SUM(clicks) as total_clicks')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Impressions',
                    'data' => $data->pluck('total_impressions')->toArray(),
                    'backgroundColor' => 'rgba(59, 130, 246, 0.1)',
                    'borderColor' => 'rgb(59, 130, 246)',
                ],
                [
                    'label' => 'Clicks',
                    'data' => $data->pluck('total_clicks')->toArray(),
                    'backgroundColor' => 'rgba(16, 185, 129, 0.1)',
                    'borderColor' => 'rgb(16, 185, 129)',
                ],
            ],
            'labels' => $data->pluck('date')->map(fn ($date) => Carbon::parse($date)->format('M d'))->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
