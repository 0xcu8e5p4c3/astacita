<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use App\Http\Middleware\FilamentAdminMiddleware;
use App\Http\Middleware\IsEditor;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('astacita')
            ->path('astacita')
            ->login()
            ->passwordReset()
            ->profile()
            ->colors([
                'primary' => Color::Indigo
            ])
            ->favicon(asset('images/logotitle.png'))
            ->brandLogo(asset('images/astacitalogo.png'))
            ->brandLogoHeight('45px')
            ->brandName('Astacita')
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                // Widgets\FilamentInfoWidget::class,
                // Widgets\ViewsStatsOverview::class,
                // Widgets\TopArticlesChart::class,
                // Widgets\ViewsOverTimeChart::class,
            ])
            
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
                
            ])
            ->authMiddleware([
                Authenticate::class,
                IsEditor::class,
            ]);
    }
}