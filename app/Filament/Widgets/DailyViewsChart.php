<?php

namespace App\Filament\Widgets;

use App\Models\View;
use App\Models\WebsiteVisit;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\StatsOverviewWidget as BaseStatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Carbon\Carbon;

// Widget untuk Chart Views Harian
class DailyViewsChart extends ChartWidget
{
    protected static ?string $heading = 'Views Artikel Harian (30 Hari Terakhir)';
    protected array|string|int $columnSpan = 'full'; 
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $data = View::getDailyViewsChart(30);
        
        // Fill missing dates with 0
        $dates = [];
        $views = [];
        for ($i = 29; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $dates[] = Carbon::parse($date)->format('d M');
            $views[] = $data[$date] ?? 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Views',
                    'data' => $views,
                    'backgroundColor' => 'rgba(59, 130, 246, 0.1)',
                    'borderColor' => 'rgb(59, 130, 246)',
                    'pointBackgroundColor' => 'rgb(59, 130, 246)',
                    'fill' => true,
                ],
            ],
            'labels' => $dates,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
