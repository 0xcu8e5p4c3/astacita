<?php

// app/Filament/Resources/SmartAdResource/Pages/CreateSmartAd.php
namespace App\Filament\Resources\SmartAdResource\Pages;

use App\Filament\Resources\SmartAdResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSmartAd extends CreateRecord
{
    protected static string $resource = SmartAdResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
