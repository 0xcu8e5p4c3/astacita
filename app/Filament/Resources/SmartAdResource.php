<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SmartAdResource\Pages;
use App\Models\SmartAd;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

use Filament\Notifications\Notification;

class SmartAdResource extends Resource
{
    protected static ?string $model = SmartAd::class;
    protected static ?string $navigationIcon = 'heroicon-o-megaphone';
    protected static ?string $navigationLabel = 'Smart Ads';
    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Ads Information')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255),
                        
                        Forms\Components\Select::make('type')
                            ->options([
                                'banner' => 'Banner',
                                'popup' => 'Popup',
                                'sidebar' => 'Sidebar',
                                'inline' => 'Inline',
                            ])
                            ->required(),
                        
                        Forms\Components\Select::make('position')
                            ->options([
                                'top' => 'Top',
                                'bottom' => 'Bottom',
                                'left' => 'Left',
                                'right' => 'Right',
                                'center' => 'Center',
                            ])
                            ->required(),
                        
                        Forms\Components\TextInput::make('priority')
                            ->numeric()
                            ->default(1)
                            ->minValue(1)
                            ->maxValue(10),
                        
                        Forms\Components\Toggle::make('is_active')
                            ->default(true),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Content')
                    ->schema([
                        Forms\Components\KeyValue::make('content')
                            ->keyLabel('Property')
                            ->valueLabel('Value')
                            ->default([
                                'image_url' => '',
                                'link_url' => '#',
                                'alt_text' => '',
                            ])
                            ->required(),
                    ])
                    ->columns(1),

                Forms\Components\Section::make('Schedule & Targeting')
                    ->schema([
                        Forms\Components\DateTimePicker::make('start_date')
                            ->label('Start Date'),
                        
                        Forms\Components\DateTimePicker::make('end_date')
                            ->label('End Date'),
                        
                        Forms\Components\TextInput::make('target_pages')
                            ->label('Target Pages (comma separated)')
                            ->placeholder('home,about,blog')
                            ->helperText('Leave empty to show on all pages'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\BadgeColumn::make('type')
                    ->colors([
                        'primary' => 'banner',
                        'success' => 'popup',
                        'warning' => 'sidebar',
                        'info' => 'inline',
                    ]),
                
                Tables\Columns\BadgeColumn::make('position'),
                
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
                
                Tables\Columns\TextColumn::make('priority')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('analytics.impressions')
                    ->label('Impressions')
                    ->sum('analytics', 'impressions')
                    ->default(0),
                
                Tables\Columns\TextColumn::make('analytics.clicks')
                    ->label('Clicks')
                    ->sum('analytics', 'clicks')
                    ->default(0),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->options([
                        'banner' => 'Banner',
                        'popup' => 'Popup',
                        'sidebar' => 'Sidebar',
                        'inline' => 'Inline',
                    ]),
                
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('toggle_status')
                        ->label('Toggle Status')
                        ->icon('heroicon-o-arrow-path')
                        ->action(function ($records) {
                            foreach ($records as $record) {
                                $record->update(['is_active' => !$record->is_active]);
                            }
                            
                            Notification::make()
                                ->title('Status updated successfully')
                                ->success()
                                ->send();
                        }),
                    
                    Tables\Actions\BulkAction::make('clear_cache')
                        ->label('Clear Cache')
                        ->icon('heroicon-o-arrow-path')
                        ->action(function () {
                            SmartAd::clearCache();
                            
                            Notification::make()
                                ->title('Cache cleared successfully')
                                ->success()
                                ->send();
                        }),
                ]),
            ])
            ->headerActions([
                Tables\Actions\Action::make('clear_all_cache')
                    ->label('Clear All Cache')
                    ->icon('heroicon-o-arrow-path')
                    ->color('warning')
                    ->action(function () {
                        SmartAd::clearCache();
                        
                        Notification::make()
                            ->title('All ads cache cleared successfully')
                            ->success()
                            ->send();
                    }),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSmartAds::route('/'),
            'create' => Pages\CreateSmartAd::route('/create'),
            'view' => Pages\ViewSmartAd::route('/{record}'),
            'edit' => Pages\EditSmartAd::route('/{record}/edit'),
            'analytics' => Pages\SmartAdAnalytics::route('/analytics'),
        ];
    }
}