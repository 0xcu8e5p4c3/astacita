<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingResource\Pages;
use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;
    protected static ?string $navigationIcon = 'heroicon-o-cog';
    protected static ?int $navigationSort = 100;
    public static function getNavigationGroup(): ?string
    {
        return 'Management';
    }
    protected static ?string $navigationLabel = 'Website Settings';
    protected static ?string $modelLabel = 'Website Setting';
    protected static ?string $pluralModelLabel = 'Website Settings';
    protected static ?string $slug = 'website-settings';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Settings')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Tentang Astacita.co')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                Forms\Components\TextInput::make('site_name')
                                    ->label('Site Name'),
                                Forms\Components\TextInput::make('site_tagline')
                                    ->label('Site Tagline'),
                                Forms\Components\FileUpload::make('site_logo')
                                    ->label('Site Logo')
                                    ->image()
                                    ->directory('site-assets')
                                    ->visibility('public'),
                                Forms\Components\FileUpload::make('site_favicon')
                                    ->label('Site Favicon')
                                    ->image()
                                    ->directory('site-assets')
                                    ->visibility('public'),
                                Forms\Components\RichEditor::make('about_description')
                                    ->label('About Description')
                                    ->toolbarButtons([
                                        'blockquote',
                                        'bold',
                                        'bulletList',
                                        'h2',
                                        'h3',
                                        'italic',
                                        'link',
                                        'orderedList',
                                        'redo',
                                        'strike',
                                        'underline',
                                        'undo',
                                    ])
                                    ->fileAttachmentsDisk('public')
                                    ->fileAttachmentsDirectory('about-uploads')
                                    ->columnSpanFull(),

                                    Forms\Components\RichEditor::make('visi')
                                    ->label('Visi')
                                    ->toolbarButtons([
                                        'blockquote',
                                        'bold',
                                        'bulletList',
                                        'h2',
                                        'h3',
                                        'italic',
                                        'link',
                                        'orderedList',
                                        'redo',
                                        'strike',
                                        'underline',
                                        'undo',
                                    ])
                                    ->columnSpanFull(),

                                    Forms\Components\RichEditor::make('misi')
                                    ->label('Misi')
                                    ->toolbarButtons([
                                        'blockquote',
                                        'bold',
                                        'bulletList',
                                        'h2',
                                        'h3',
                                        'italic',
                                        'link',
                                        'orderedList',
                                        'redo',
                                        'strike',
                                        'underline',
                                        'undo',
                                    ])
                                    ->columnSpanFull(),

                                Forms\Components\Textarea::make('about_short_description')
                                    ->label('Short Description (for SEO)')
                                    ->rows(3)
                                    ->maxLength(255)
                                    ->columnSpanFull(),
                                Forms\Components\TextInput::make('year_established')
                                    ->label('Year Established')
                                    ->numeric(),
                            ]),
                        
                        Forms\Components\Tabs\Tab::make('Redaksi')
                            ->icon('heroicon-o-users')
                            ->schema([
                                Forms\Components\Repeater::make('editorial_team')
                                    ->label('Tim Redaksi')
                                    ->schema([
                                        Forms\Components\TextInput::make('name')
                                            ->label('Nama')
                                            ->required(),
                                        Forms\Components\TextInput::make('position')
                                            ->label('Jabatan')
                                            ->required(),
                                        Forms\Components\TextInput::make('email')
                                            ->label('Email')
                                            ->email(),
                                        Forms\Components\Textarea::make('bio')
                                            ->label('Biografi Singkat')
                                            ->rows(3),
                                        Forms\Components\FileUpload::make('photo')
                                            ->label('Foto')
                                            ->image()
                                            ->directory('editorial-team')
                                            ->visibility('public'),
                                    ])
                                    ->itemLabel(fn (array $state): ?string => $state['name'] ?? null)
                                    ->collapsible()
                                    ->reorderableWithButtons()
                                    ->columnSpanFull(),
                                Forms\Components\RichEditor::make('editorial_statement')
                                    ->label('Pernyataan Redaksi')
                                    ->toolbarButtons([
                                        'blockquote',
                                        'bold',
                                        'bulletList',
                                        'h2',
                                        'h3',
                                        'italic',
                                        'link',
                                        'orderedList',
                                        'redo',
                                        'strike',
                                        'underline',
                                        'undo',
                                    ])
                                    ->columnSpanFull(),
                            ]),
                            
                        Forms\Components\Tabs\Tab::make('Kode Etik')
                            ->icon('heroicon-o-document-text')
                            ->schema([
                                Forms\Components\RichEditor::make('ethics_code')
                                    ->label('Kode Etik Jurnalistik')
                                    ->toolbarButtons([
                                        'blockquote',
                                        'bold',
                                        'bulletList',
                                        'h2',
                                        'h3',
                                        'italic',
                                        'link',
                                        'orderedList',
                                        'redo',
                                        'strike',
                                        'underline',
                                        'undo',
                                    ])
                                    ->fileAttachmentsDisk('public')
                                    ->fileAttachmentsDirectory('ethics-uploads')
                                    ->columnSpanFull(),
                                Forms\Components\TextInput::make('ethics_last_updated')
                                    ->label('Terakhir Diperbarui')
                                    ->type('date'),
                            ]),
                            
                        Forms\Components\Tabs\Tab::make('Pedoman Media Cyber')
                            ->icon('heroicon-o-globe-alt')
                            ->schema([
                                Forms\Components\RichEditor::make('cyber_media_guidelines')
                                    ->label('Pedoman Media Cyber')
                                    ->toolbarButtons([
                                        'blockquote',
                                        'bold',
                                        'bulletList',
                                        'h2',
                                        'h3',
                                        'italic',
                                        'link',
                                        'orderedList',
                                        'redo',
                                        'strike',
                                        'underline',
                                        'undo',
                                    ])
                                    ->fileAttachmentsDisk('public')
                                    ->fileAttachmentsDirectory('cyber-media-uploads')
                                    ->columnSpanFull(),
                                Forms\Components\TextInput::make('guidelines_last_updated')
                                    ->label('Terakhir Diperbarui')
                                    ->type('date'),
                                Forms\Components\TextInput::make('guidelines_reference')
                                    ->label('Referensi')
                                    ->placeholder('Contoh: Dewan Pers Indonesia'),
                            ]),
                            
                        Forms\Components\Tabs\Tab::make('Kontak')
                            ->icon('heroicon-o-phone')
                            ->schema([
                                Forms\Components\TextInput::make('contact_email')
                                    ->label('Email')
                                    ->email(),
                                Forms\Components\TextInput::make('contact_phone')
                                    ->label('No. Telepon')
                                    ->tel(),
                                Forms\Components\Textarea::make('contact_address')
                                    ->label('Alamat')
                                    ->rows(3)
                                    ->columnSpanFull(),
                                Forms\Components\TextInput::make('maps_embed_code')
                                    ->label('Google Maps Embed Code')
                                    ->placeholder('Masukkan kode embed Google Maps')
                                    ->columnSpanFull(),
                                Forms\Components\Section::make('Social Media')
                                    ->schema([
                                        Forms\Components\TextInput::make('social_facebook')
                                            ->label('Facebook URL'),
                                        Forms\Components\TextInput::make('social_twitter')
                                            ->label('Twitter URL'),
                                        Forms\Components\TextInput::make('social_instagram')
                                            ->label('Instagram URL'),
                                        Forms\Components\TextInput::make('social_youtube')
                                            ->label('YouTube URL'),
                                        Forms\Components\TextInput::make('social_linkedin')
                                            ->label('LinkedIn URL'),
                                    ])
                                    ->columns(2)
                                    ->collapsible(),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('key')
                    ->label('Setting Key')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('value')
                    ->label('Value')
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->dateTime()
                    ->sortable(),
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
            'index' => Pages\ListSettings::route('/'),
            'create' => Pages\CreateSetting::route('/create'),
            'edit' => Pages\EditSetting::route('/{record}/edit'),
        ];
    }
}