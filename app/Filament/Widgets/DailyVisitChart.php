<?php

namespace App\Filament\Widgets;

use App\Models\View;
use App\Models\WebsiteVisit;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\StatsOverviewWidget as BaseStatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Carbon\Carbon;

class DailyVisitsChart extends ChartWidget
{
    protected static ?string $heading = 'Pengunjung Website Harian (30 Hari Terakhir)';

    protected function getData(): array
    {
        $data = WebsiteVisit::getDailyVisitsChart(30);
        
        // Fill missing dates with 0
        $dates = [];
        $visits = [];
        for ($i = 29; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $dates[] = Carbon::parse($date)->format('d M');
            $visits[] = $data[$date] ?? 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Unique Visitors',
                    'data' => $visits,
                    'backgroundColor' => 'rgba(34, 197, 94, 0.1)',
                    'borderColor' => 'rgb(34, 197, 94)',
                    'pointBackgroundColor' => 'rgb(34, 197, 94)',
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
