<?php

namespace App\Filament\Resources\WebsiteSettingResource\Pages;

use App\Filament\Resources\WebsiteSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;

class EditWebsiteSetting extends EditRecord
{
    protected static string $resource = WebsiteSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('preview')
                ->label('Preview Website')
                ->icon('heroicon-o-eye')
                ->url(fn () => url('/'))
                ->openUrlInNewTab(),
                
            Actions\Action::make('reset')
                ->label('Reset ke Default')
                ->icon('heroicon-o-arrow-path')
                ->color('warning')
                ->requiresConfirmation()
                ->modalHeading('Reset Pengaturan Website')
                ->modalDescription('Apakah Anda yakin ingin mereset semua pengaturan ke nilai default? Tindakan ini tidak dapat dibatalkan.')
                ->action(function () {
                    $this->record->update([
                        'site_name' => 'Astacita.co',
                        'site_tagline' => 'Portal Berita Terpercaya',
                        'about_description' => null,
                        'visi' => null,
                        'misi' => null,
                        'about_short_description' => null,
                        'year_established' => null,
                        'editorial_team' => null,
                        'editorial_statement' => null,
                        'ethics_code' => null,
                        'ethics_last_updated' => null,
                        'cyber_media_guidelines' => null,
                        'guidelines_last_updated' => null,
                        'guidelines_reference' => null,
                        'contact_email' => null,
                        'contact_phone' => null,
                        'contact_address' => null,
                        'maps_embed_code' => null,
                        'social_facebook' => null,
                        'social_twitter' => null,
                        'social_instagram' => null,
                        'social_youtube' => null,
                        'social_linkedin' => null,
                    ]);
                    
                    Notification::make()
                        ->title('Pengaturan berhasil direset')
                        ->success()
                        ->send();
                        
                    $this->fillForm();
                }),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Pengaturan website berhasil disimpan')
            ->body('Perubahan pengaturan website telah disimpan dan akan terlihat di frontend.');
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Ensure editorial_team is properly formatted
        if (isset($data['editorial_team']) && is_array($data['editorial_team'])) {
            $data['editorial_team'] = array_values(array_filter($data['editorial_team'], function ($member) {
                return !empty($member['name']) && !empty($member['position']);
            }));
        }

        // Auto-update guidelines_last_updated if cyber_media_guidelines is changed
        if (isset($data['cyber_media_guidelines']) && 
            $data['cyber_media_guidelines'] !== $this->record->cyber_media_guidelines) {
            $data['guidelines_last_updated'] = now()->toDateString();
        }

        // Auto-update ethics_last_updated if ethics_code is changed
        if (isset($data['ethics_code']) && 
            $data['ethics_code'] !== $this->record->ethics_code) {
            $data['ethics_last_updated'] = now()->toDateString();
        }

        return $data;
    }
}