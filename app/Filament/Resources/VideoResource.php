<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VideoResource\Pages;
use App\Models\Video;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class VideoResource extends Resource
{
    protected static ?string $model = Video::class;

    protected static ?string $navigationIcon = 'heroicon-o-video-camera';

    public static function getNavigationSort(): int
    {
        return 3;
    }

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\Select::make('platform')
                            ->options([
                                'youtube' => 'YouTube',
                                'tiktok' => 'TikTok',
                            ])
                            ->required()
                            ->reactive(),

                        Forms\Components\TextInput::make('url')
                            ->required()
                            ->url()
                            ->maxLength(1000)
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set, $get) {
                                if (empty($state)) {
                                    return;
                                }

                                $platform = $get('platform');
                                $url = $state;
                                
                                // Generate title from URL if possible
                                if (empty($get('title'))) {
                                    $title = '';
                                    
                                    if ($platform === 'youtube') {
                                        // Extract video ID
                                        $pattern = '/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/';
                                        if (preg_match($pattern, $url, $matches)) {
                                            $videoId = $matches[1];
                                            
                                            // Try to fetch video info
                                            try {
                                                $apiUrl = "https://www.youtube.com/oembed?url=https://www.youtube.com/watch?v={$videoId}&format=json";
                                                $response = file_get_contents($apiUrl);
                                                $data = json_decode($response, true);
                                                
                                                if (isset($data['title'])) {
                                                    $title = $data['title'];
                                                }
                                            } catch (\Exception $e) {
                                                // Silent fail
                                            }
                                        }
                                    } elseif ($platform === 'tiktok') {
                                        // For TikTok, we can't easily get the title, so we'll create a generic one
                                        $title = 'TikTok Video - ' . Str::random(6);
                                    }
                                    
                                    if (!empty($title)) {
                                        $set('title', $title);
                                    }
                                }
                            }),

                        Forms\Components\TextInput::make('views_count')
                            ->numeric()
                            ->default(0)
                            ->minValue(0),

                        Forms\Components\Toggle::make('status')
                            ->default(true)
                            ->label('Active'),
                    ])
                    ->columns(1),

                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Placeholder::make('preview')
                            ->label('Video Preview')
                            ->content(function ($get) {
                                $url = $get('url');
                                $platform = $get('platform');
                                
                                if (empty($url) || empty($platform)) {
                                    return 'Enter a video URL to see a preview';
                                }
                                
                                if ($platform === 'youtube') {
                                    $pattern = '/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/';
                                    if (preg_match($pattern, $url, $matches)) {
                                        $videoId = $matches[1];
                                        return new \Illuminate\Support\HtmlString(
                                            '<div class="aspect-w-16 aspect-h-9">
                                                <iframe src="https://www.youtube.com/embed/' . $videoId . '" 
                                                    frameborder="0" 
                                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                                    allowfullscreen
                                                    class="w-full h-64">
                                                </iframe>
                                            </div>'
                                        );
                                    }
                                } elseif ($platform === 'tiktok') {
                                    $pattern = '/(?:https?:\/\/)?(?:www\.)?(?:tiktok\.com\/@[\w.-]+\/video\/(\d+))/';
                                    if (preg_match($pattern, $url, $matches)) {
                                        $videoId = $matches[1];
                                        return new \Illuminate\Support\HtmlString(
                                            '<div class="aspect-w-9 aspect-h-16">
                                                <iframe src="https://www.tiktok.com/embed/v2/' . $videoId . '" 
                                                    frameborder="0" 
                                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                                    allowfullscreen
                                                    class="w-full h-96">
                                                </iframe>
                                            </div>'
                                        );
                                    }
                                }
                                
                                return 'Invalid video URL';
                            }),
                    ])
                    ->visible(fn ($get) => !empty($get('url')) && !empty($get('platform')))
                    ->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->limit(30),
                
                Tables\Columns\BadgeColumn::make('platform')
                    ->colors([
                        'primary' => 'youtube',
                        'danger' => 'tiktok',
                    ]),
                
                Tables\Columns\TextColumn::make('views_count')
                    ->sortable(),
                
                Tables\Columns\ToggleColumn::make('status')
                    ->label('Active'),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('platform')
                    ->options([
                        'youtube' => 'YouTube',
                        'tiktok' => 'TikTok',
                    ]),
                
                Tables\Filters\TernaryFilter::make('status')
                    ->label('Active'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListVideos::route('/'),
            'create' => Pages\CreateVideo::route('/create'),
            'edit' => Pages\EditVideo::route('/{record}/edit'),
        ];
    }
}