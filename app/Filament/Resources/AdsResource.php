<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdsResource\Pages;
use App\Filament\Resources\AdsResource\RelationManagers;
use App\Models\Ads;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;


class AdsResource extends Resource
{
    protected static ?string $model = Ads::class;

    public static function getNavigationSort(): int
    {
        return 3;
    }

    public static function getNavigationLabel(): string
    {
        return 'Manage Ads'; 
    }


    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\TextInput::make('kode')
                ->required()
                ->unique(Ads::class, 'kode')
                ->label('Kode'),
            Forms\Components\TextInput::make('posisi')
                ->required()
                ->label('Posisi'),
            Forms\Components\Select::make('media_device')
                ->options([
                    'desktop' => 'Desktop',
                    'mobile' => 'Mobile',
                ])
                ->required()
                ->label('Media / Device'),
            TextInput::make('link_iklan')
                ->label('Link Iklan')
                ->url()
                ->placeholder('https://contoh.com')
                ->required(),
            Forms\Components\Toggle::make('active')
                ->label('Active')
                ->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            TextColumn::make('id')->sortable(),
            TextColumn::make('kode')->label('Kode')->sortable(),
            TextColumn::make('posisi')->label('Posisi')->sortable(),
            TextColumn::make('media_device')->label('Media / Device')->sortable(),
            BooleanColumn::make('active')->label('Active'),
        ])
        ->actions([
            EditAction::make(),
            DeleteAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
        ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAds::route('/'),
            'create' => Pages\CreateAds::route('/create'),
            'edit' => Pages\EditAds::route('/{record}/edit'),
        ];
    }
}
