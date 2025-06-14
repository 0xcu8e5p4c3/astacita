<?php

namespace App\Filament\Resources\SmartAdResource\Pages;

use App\Filament\Resources\SmartAdResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSmartAd extends ViewRecord
{
    protected static string $resource = SmartAdResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}