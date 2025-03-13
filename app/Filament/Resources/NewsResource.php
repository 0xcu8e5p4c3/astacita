<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsResource\Pages;
use App\Filament\Resources\NewsResource\RelationManagers;
use App\Models\Article;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use FilamentTiptapEditor\TiptapEditor;
use Filament\Forms\Components\Select;
use App\Models\User;
use App\Models\Editor;
use App\Models\Category;
use App\Models\Tags;

class NewsResource extends Resource
{
    protected static ?string $model = Article::class;

    public static function getNavigationSort(): int
    {
        return 2;
    }

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\FileUpload::make('cover_image')
                ->label('Cover Artikel')
                ->directory('uploads/covers') // Direktori penyimpanan
                ->image() // Hanya menerima gambar
                ->maxSize(2048) // Maksimal 2MB
                ->columnSpanFull(),
            Forms\Components\TextInput::make('title')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('slug')
                ->required()
                ->maxLength(255),
            TiptapEditor::make('content')
                ->profile('default')
                ->columnSpanFull()
                ->extraAttributes([
                    'style' => 'min-height: 500px; height: auto; max-height: 500px; overflow: auto;'
                ])
                ->required(),
                Forms\Components\Select::make('author_id')
                ->label('Author')
                ->options(user::pluck('name', 'id')) // Ambil data dari tabel authors
                ->searchable()
                ->preload()
                ->placeholder('Tidak ada'),
            
            Forms\Components\Select::make('editor_id')
                ->label('Editor')
                ->options(user::pluck('name', 'id')) // Ambil data dari tabel editors
                ->searchable()
                ->preload()
                ->placeholder('Tidak ada'),
            
            Forms\Components\Select::make('category_id')
                ->label('Category')
                ->options(Category::pluck('name', 'id')) // Ambil data dari tabel categories
                ->searchable()
                ->preload()
                ->placeholder('Tidak ada'),
            
            Forms\Components\Select::make('tags_id')
                ->label('Tags')
                ->multiple() // Jika bisa memilih lebih dari satu tag
                ->options(Tags::pluck('name', 'id')) // Ambil data dari tabel tags
                ->searchable()
                ->preload()
                ->placeholder('Tidak ada'),
            Forms\Components\Toggle::make('published')
                ->required(),
            Forms\Components\DateTimePicker::make('published_at'),

    ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('title')
                ->searchable(),
            Tables\Columns\TextColumn::make('slug')
                ->searchable(),
            Tables\Columns\TextColumn::make('author_id')
                ->numeric()
                ->sortable(),
            Tables\Columns\TextColumn::make('category_id')
                ->numeric()
                ->sortable(),
            Tables\Columns\IconColumn::make('published')
                ->boolean(),
            Tables\Columns\TextColumn::make('published_at')
                ->dateTime()
                ->sortable(),
            Tables\Columns\TextColumn::make('created_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\TextColumn::make('updated_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
        ])
        ->filters([
            //
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
            ]),
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
            'index' => Pages\ListNews::route('/'),
            'create' => Pages\CreateNews::route('/create'),
            'edit' => Pages\EditNews::route('/{record}/edit'),
        ];
    }
}
