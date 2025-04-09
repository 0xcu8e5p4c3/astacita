<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsResource\Pages;
use App\Models\Article;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use FilamentTiptapEditor\TiptapEditor;
use Filament\Forms\Components\Select;
use App\Models\User;
use App\Models\Category;
use App\Models\Tags;

class NewsResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationSort(): int
    {
        return 2;
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\FileUpload::make('cover')
            ->label('Cover Artikel')
            ->directory('covers') // Simpan di storage/app/public/covers
            ->image() // Hanya menerima gambar
            ->maxSize(2048) // Maksimal 2MB
            ->visibility('public') // Agar bisa diakses via URL
            ->columnSpanFull(), // Biar lebar penuh
        
            Forms\Components\TextInput::make('title')
                ->required()
                ->maxLength(255)
                ->reactive() // Membuat title bisa langsung memengaruhi slug
                ->afterStateUpdated(fn ($state, callable $set) => 
                    $set('slug', \Illuminate\Support\Str::slug($state))
                ),
            
            Forms\Components\TextInput::make('slug')
                ->required()
                ->maxLength(255)
                ->unique(Article::class, 'slug')
                ->dehydrateStateUsing(fn ($state) => \Illuminate\Support\Str::slug($state)) // Pastikan slug tetap format URL-friendly
                ->disabled(),
            

            TiptapEditor::make('content')
                ->profile('default')
                ->columnSpanFull()
                ->extraAttributes([
                    'style' => 'min-height: 500px; height: auto; max-height: 500px; overflow: auto;',
                ])
                ->required(),

                Select::make('author_id')
                ->label('Author')
                ->relationship('author', 'name', function ($query) {
                    $query->where('role', 'author');
                })
                ->searchable()
                ->preload()
                ->placeholder('Pilih Author')
                ->required(),
            
            Select::make('editor_id')
                ->label('Editor')
                ->relationship('editor', 'name', function ($query) {
                    $query->where('role', 'editor');
                })
                ->searchable()
                ->preload()
                ->placeholder('Pilih Editor')
                ->required(),

            Select::make('category_id')
                ->label('Kategori')
                ->relationship('category', 'name')
                ->searchable()
                ->preload()
                ->placeholder('Pilih Kategori')
                ->required(),

            Select::make('tags')
                ->label('Tags')
                ->multiple()
                ->relationship('tags', 'name')
                ->searchable()
                ->preload()
                ->placeholder('Pilih Tags'),

            Select::make('status')
                ->label('Status')
                ->options([
                    'draft' => 'Draft',
                    'scheduled' => 'Terjadwal',
                    'published' => 'Dipublikasikan',
                ])
                ->default('draft')
                ->live()
                ->required(),

                Forms\Components\DateTimePicker::make('scheduled_at')
                ->visible(fn (Get $get) => $get('status') === 'scheduled')
                ->required(fn (Get $get) => $get('status') === 'scheduled'),
            
            

            Forms\Components\DateTimePicker::make('published_at')
                ->label('Waktu Publikasi')
                ->nullable()
                ->hidden(fn ($get) => $get('status') !== 'published'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('slug')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('author.name')
                    ->label('Author')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('category.name')
                    ->label('Kategori')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'draft' => 'Draft',
                        'scheduled' => 'Terjadwal',
                        'published' => 'Dipublikasikan',
                    })
                    ->colors([
                        'draft' => 'gray',
                        'scheduled' => 'yellow',
                        'published' => 'green',
                    ])
                    ->sortable(),

                Tables\Columns\TextColumn::make('scheduled_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Terjadwal')
                    ->toggleable(),

                Tables\Columns\TextColumn::make('published_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Dipublikasikan')
                    ->toggleable(),

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
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'scheduled' => 'Terjadwal',
                        'published' => 'Dipublikasikan',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
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
