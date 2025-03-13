<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Dashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function getNavigationSort(): int
    {
        return 1;
    }

    protected static string $view = 'filament.pages.dashboard';
}
