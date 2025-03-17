<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use App\Models\View;
use App\Models\User;
use App\Models\Article;

class WebStatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getCards(): array
    {
        return [
            Card::make('Total Visits', View::count())
                ->description('Total website visits')
                ->icon('heroicon-o-globe-alt')
                ->color('primary'),

            Card::make('Today\'s Visits', View::whereDate('visited_at', today())->count())
                ->description('Visits today')
                ->icon('heroicon-o-chart-bar')
                ->color('success'),

            Card::make('Total Articles', Article::count())
                ->description('Total published articles')
                ->icon('heroicon-o-document-text')
                ->color('info'),
            
            Card::make('Total Users', User::count())  // Menampilkan total pengguna
                ->description('Total registered users')
                ->icon('heroicon-o-user-group')
                ->color('warning'),
        ];
    }
}
