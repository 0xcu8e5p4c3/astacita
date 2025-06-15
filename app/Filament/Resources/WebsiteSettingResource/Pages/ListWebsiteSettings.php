<?php

namespace App\Filament\Resources\WebsiteSettingResource\Pages;

use App\Filament\Resources\WebsiteSettingResource;
use App\Models\WebsiteSetting;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWebsiteSettings extends ListRecords
{
    protected static string $resource = WebsiteSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Buat Pengaturan Website')
                ->visible(fn () => WebsiteSetting::count() === 0),
        ];
    }

    public function mount(): void
    {
        parent::mount();
        
        // If no settings exist, create default one and redirect to edit
        if (WebsiteSetting::count() === 0) {
            $setting = WebsiteSetting::create([
                'site_name' => 'Astacita.co',
                'site_tagline' => 'Portal Berita Terpercaya',
            ]);
            
            $this->redirect($this->getResource()::getUrl('edit', ['record' => $setting]));
        }
        
        // If only one record exists, redirect directly to edit page
        if (WebsiteSetting::count() === 1) {
            $setting = WebsiteSetting::first();
            $this->redirect($this->getResource()::getUrl('edit', ['record' => $setting]));
        }
    }
}