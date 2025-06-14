<?php

namespace App\Filament\Resources\SmartAdResource\Pages;

use App\Filament\Resources\SmartAdResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSmartAd extends EditRecord
{
    protected static string $resource = SmartAdResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
