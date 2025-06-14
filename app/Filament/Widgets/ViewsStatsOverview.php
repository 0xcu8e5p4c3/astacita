<?php

namespace App\Filament\Widgets;

use App\Models\View;
use App\Models\WebsiteVisit;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\StatsOverviewWidget as BaseStatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Carbon\Carbon;

class ViewsStatsOverview extends BaseStatsOverviewWidget

{
    protected array|string|int $columnSpan = 'full'; 
    protected function getStats(): array
    {
        $todayViews = View::today()->count();
        $weekViews = View::thisWeek()->count();
        $monthViews = View::thisMonth()->count();
        
        $todayVisits = WebsiteVisit::today()->distinct('session_id')->count();
        $weekVisits = WebsiteVisit::thisWeek()->distinct('session_id')->count();
        $monthVisits = WebsiteVisit::thisMonth()->distinct('session_id')->count();

        return [
            Stat::make('Views Hari Ini', $todayViews)
                ->description('Total views artikel hari ini')
                ->descriptionIcon('heroicon-m-eye')
                ->color('success'),
                
            Stat::make('Views Minggu Ini', $weekViews)
                ->description('Total views artikel minggu ini')
                ->descriptionIcon('heroicon-m-chart-bar')
                ->color('info'),
                
            Stat::make('Views Bulan Ini', $monthViews)
                ->description('Total views artikel bulan ini')
                ->descriptionIcon('heroicon-m-calendar')
                ->color('warning'),
                
            Stat::make('Unique Visitors Hari Ini', $todayVisits)
                ->description('Pengunjung unik hari ini')
                ->descriptionIcon('heroicon-m-users')
                ->color('primary'),
                
            Stat::make('Unique Visitors Minggu Ini', $weekVisits)
                ->description('Pengunjung unik minggu ini')
                ->descriptionIcon('heroicon-m-globe-alt')
                ->color('success'),
                
            Stat::make('Unique Visitors Bulan Ini', $monthVisits)
                ->description('Pengunjung unik bulan ini')
                ->descriptionIcon('heroicon-m-presentation-chart-line')
                ->color('info'),
        ];
    }
}