<?php

// app/Filament/Resources/SmartAdResource/Pages/ListSmartAds.php
namespace App\Filament\Resources\SmartAdResource\Pages;

use App\Filament\Resources\SmartAdResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSmartAds extends ListRecords
{
    protected static string $resource = SmartAdResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('analytics')
                ->label('View Analytics')
                ->icon('heroicon-o-chart-bar')
                ->url(fn () => SmartAdResource::getUrl('analytics')),
        ];
    }
}