<?php

namespace App\Filament\Resources\SettingResource\Pages;

use App\Filament\Resources\SettingResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSetting extends CreateRecord
{
        protected static string $resource = SettingResource::class;
    
        protected function mutateFormDataBeforeCreate(array $data): array
        {
            // Generate a unique key based on the setting name
            if (!isset($data['key']) && isset($data['name'])) {
                $data['key'] = Str::slug($data['name']);
            }
            
            return $data;
        }
        
        protected function getRedirectUrl(): string
        {
            return $this->getResource()::getUrl('index');
        }
}
    