<?php

namespace App\Filament\Widgets;

use App\Models\SmartAd;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class SmartAdPerformanceWidget extends BaseWidget
{
    protected static ?string $heading = 'Top Performing Ads';
    protected array|string|int $columnSpan = 'full'; 
    protected static ?int $sort = 6;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                SmartAd::query()
                    ->withSum('analytics', 'impressions')
                    ->withSum('analytics', 'clicks')
                    ->withAvg('analytics', 'ctr')
                    ->orderByDesc('analytics_sum_clicks')
                    ->limit(10)
            )
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->limit(30),
                
                Tables\Columns\BadgeColumn::make('type'),
                
                Tables\Columns\TextColumn::make('analytics_sum_impressions')
                    ->label('Impressions')
                    ->default(0)
                    ->numeric(),
                
                Tables\Columns\TextColumn::make('analytics_sum_clicks')
                    ->label('Clicks')
                    ->default(0)
                    ->numeric(),
                
                Tables\Columns\TextColumn::make('analytics_avg_ctr')
                    ->label('CTR')
                    ->formatStateUsing(fn ($state) => number_format($state ?? 0, 2) . '%'),
            ]);
    }
}