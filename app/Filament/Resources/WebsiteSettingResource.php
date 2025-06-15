<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WebsiteSettingResource\Pages;
use App\Models\WebsiteSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class WebsiteSettingResource extends Resource
{
    protected static ?string $model = WebsiteSetting::class;
    
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    
    protected static ?int $navigationSort = 100;
    
    protected static ?string $navigationLabel = 'Website Settings';
    
    protected static ?string $modelLabel = 'Website Setting';
    
    protected static ?string $pluralModelLabel = 'Website Settings';
    
    protected static ?string $slug = 'website-settings';

    public static function getNavigationGroup(): ?string
    {
        return 'Management';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Website Settings')
                    ->tabs([
                        // Tab 1: About Astacita.co
                        Forms\Components\Tabs\Tab::make('Tentang Astacita.co')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                Forms\Components\Grid::make(2)
                                    ->schema([
                                        Forms\Components\TextInput::make('site_name')
                                            ->label('Nama Situs')
                                            ->placeholder('Astacita.co')
                                            ->maxLength(255),
                                            
                                        Forms\Components\TextInput::make('site_tagline')
                                            ->label('Tagline Situs')
                                            ->placeholder('Portal Berita Terpercaya')
                                            ->maxLength(255),
                                    ]),
                                    
                                Forms\Components\Grid::make(2)
                                    ->schema([
                                        Forms\Components\FileUpload::make('site_logo')
                                            ->label('Logo Situs')
                                            ->image()
                                            ->directory('site-assets')
                                            ->visibility('public')
                                            ->imageResizeMode('contain')
                                            ->imageCropAspectRatio('16:9')
                                            ->imageResizeTargetWidth('400')
                                            ->imageResizeTargetHeight('225'),
                                            
                                        Forms\Components\FileUpload::make('site_favicon')
                                            ->label('Favicon')
                                            ->image()
                                            ->directory('site-assets')
                                            ->visibility('public')
                                            ->imageResizeMode('contain')
                                            ->imageCropAspectRatio('1:1')
                                            ->imageResizeTargetWidth('32')
                                            ->imageResizeTargetHeight('32'),
                                    ]),
                                    
                                Forms\Components\RichEditor::make('about_description')
                                    ->label('Deskripsi Tentang Kami')
                                    ->toolbarButtons([
                                        'blockquote', 'bold', 'bulletList', 'h2', 'h3', 
                                        'italic', 'link', 'orderedList', 'redo', 
                                        'strike', 'underline', 'undo',
                                    ])
                                    ->fileAttachmentsDisk('public')
                                    ->fileAttachmentsDirectory('about-uploads')
                                    ->columnSpanFull(),

                                Forms\Components\Grid::make(2)
                                    ->schema([
                                        Forms\Components\RichEditor::make('visi')
                                            ->label('Visi')
                                            ->toolbarButtons([
                                                'blockquote', 'bold', 'bulletList', 'h2', 'h3', 
                                                'italic', 'link', 'orderedList', 'redo', 
                                                'strike', 'underline', 'undo',
                                            ]),
                                            
                                        Forms\Components\RichEditor::make('misi')
                                            ->label('Misi')
                                            ->toolbarButtons([
                                                'blockquote', 'bold', 'bulletList', 'h2', 'h3', 
                                                'italic', 'link', 'orderedList', 'redo', 
                                                'strike', 'underline', 'undo',
                                            ]),
                                    ]),

                                Forms\Components\Grid::make(2)
                                    ->schema([
                                        Forms\Components\Textarea::make('about_short_description')
                                            ->label('Deskripsi Singkat (untuk SEO)')
                                            ->rows(3)
                                            ->maxLength(255)
                                            ->helperText('Maksimal 255 karakter untuk SEO meta description'),
                                            
                                        Forms\Components\TextInput::make('year_established')
                                            ->label('Tahun Berdiri')
                                            ->numeric()
                                            ->minValue(1900)
                                            ->maxValue(date('Y')),
                                    ]),
                            ]),
                        
                        // Tab 2: Editorial Team
                        Forms\Components\Tabs\Tab::make('Tim Redaksi')
                            ->icon('heroicon-o-users')
                            ->schema([
                                Forms\Components\Repeater::make('editorial_team')
                                    ->label('Tim Redaksi')
                                    ->schema([
                                        Forms\Components\Grid::make(2)
                                            ->schema([
                                                Forms\Components\TextInput::make('name')
                                                    ->label('Nama Lengkap')
                                                    ->required()
                                                    ->maxLength(255),
                                                    
                                                Forms\Components\TextInput::make('position')
                                                    ->label('Jabatan')
                                                    ->required()
                                                    ->maxLength(255),
                                            ]),
                                            
                                        Forms\Components\TextInput::make('email')
                                            ->label('Email')
                                            ->email()
                                            ->maxLength(255),
                                            
                                        Forms\Components\Textarea::make('bio')
                                            ->label('Biografi Singkat')
                                            ->rows(3)
                                            ->maxLength(500),
                                            
                                        Forms\Components\FileUpload::make('photo')
                                            ->label('Foto Profil')
                                            ->image()
                                            ->directory('editorial-team')
                                            ->visibility('public')
                                            ->imageResizeMode('cover')
                                            ->imageCropAspectRatio('1:1')
                                            ->imageResizeTargetWidth('300')
                                            ->imageResizeTargetHeight('300'),
                                    ])
                                    ->itemLabel(fn (array $state): ?string => $state['name'] ?? 'Anggota Tim')
                                    ->collapsible()
                                    ->reorderableWithButtons()
                                    ->addActionLabel('Tambah Anggota Tim')
                                    ->columnSpanFull(),
                                    
                                Forms\Components\RichEditor::make('editorial_statement')
                                    ->label('Pernyataan Redaksi')
                                    ->toolbarButtons([
                                        'blockquote', 'bold', 'bulletList', 'h2', 'h3', 
                                        'italic', 'link', 'orderedList', 'redo', 
                                        'strike', 'underline', 'undo',
                                    ])
                                    ->columnSpanFull(),
                            ]),
                            
                        // Tab 3: Ethics Code
                        Forms\Components\Tabs\Tab::make('Kode Etik')
                            ->icon('heroicon-o-document-text')
                            ->schema([
                                Forms\Components\RichEditor::make('ethics_code')
                                    ->label('Kode Etik Jurnalistik')
                                    ->toolbarButtons([
                                        'blockquote', 'bold', 'bulletList', 'h2', 'h3', 
                                        'italic', 'link', 'orderedList', 'redo', 
                                        'strike', 'underline', 'undo',
                                    ])
                                    ->fileAttachmentsDisk('public')
                                    ->fileAttachmentsDirectory('ethics-uploads')
                                    ->columnSpanFull(),
                                    
                                Forms\Components\DatePicker::make('ethics_last_updated')
                                    ->label('Terakhir Diperbarui')
                                    ->default(now())
                                    ->native(false),
                            ]),
                            
                        // Tab 4: Cyber Media Guidelines
                        Forms\Components\Tabs\Tab::make('Pedoman Media Cyber')
                            ->icon('heroicon-o-globe-alt')
                            ->schema([
                                Forms\Components\RichEditor::make('cyber_media_guidelines')
                                    ->label('Pedoman Media Cyber')
                                    ->toolbarButtons([
                                        'blockquote', 'bold', 'bulletList', 'h2', 'h3', 
                                        'italic', 'link', 'orderedList', 'redo', 
                                        'strike', 'underline', 'undo',
                                    ])
                                    ->fileAttachmentsDisk('public')
                                    ->fileAttachmentsDirectory('cyber-media-uploads')
                                    ->columnSpanFull(),
                                    
                                Forms\Components\Grid::make(2)
                                    ->schema([
                                        Forms\Components\DatePicker::make('guidelines_last_updated')
                                            ->label('Terakhir Diperbarui')
                                            ->default(now())
                                            ->native(false),
                                            
                                        Forms\Components\TextInput::make('guidelines_reference')
                                            ->label('Referensi')
                                            ->placeholder('Contoh: Dewan Pers Indonesia')
                                            ->maxLength(255),
                                    ]),
                            ]),
                            
                        // Tab 5: Contact Information
                        Forms\Components\Tabs\Tab::make('Kontak & Media Sosial')
                            ->icon('heroicon-o-phone')
                            ->schema([
                                Forms\Components\Section::make('Informasi Kontak')
                                    ->schema([
                                        Forms\Components\Grid::make(2)
                                            ->schema([
                                                Forms\Components\TextInput::make('contact_email')
                                                    ->label('Email Kontak')
                                                    ->email()
                                                    ->maxLength(255),
                                                    
                                                Forms\Components\TextInput::make('contact_phone')
                                                    ->label('Nomor Telepon')
                                                    ->tel()
                                                    ->maxLength(20),
                                            ]),
                                            
                                        Forms\Components\Textarea::make('contact_address')
                                            ->label('Alamat Lengkap')
                                            ->rows(3)
                                            ->maxLength(500)
                                            ->columnSpanFull(),
                                            
                                        Forms\Components\Textarea::make('maps_embed_code')
                                            ->label('Kode Embed Google Maps')
                                            ->placeholder('Masukkan kode embed HTML dari Google Maps')
                                            ->rows(4)
                                            ->columnSpanFull()
                                            ->helperText('Salin kode embed dari Google Maps untuk menampilkan lokasi'),
                                    ]),
                                    
                                Forms\Components\Section::make('Media Sosial')
                                    ->schema([
                                        Forms\Components\Grid::make(2)
                                            ->schema([
                                                Forms\Components\TextInput::make('social_facebook')
                                                    ->label('Facebook')
                                                    ->url()
                                                    ->placeholder('https://facebook.com/username')
                                                    ->maxLength(255),
                                                    
                                                Forms\Components\TextInput::make('social_twitter')
                                                    ->label('Twitter / X')
                                                    ->url()
                                                    ->placeholder('https://twitter.com/username')
                                                    ->maxLength(255),
                                                    
                                                Forms\Components\TextInput::make('social_instagram')
                                                    ->label('Instagram')
                                                    ->url()
                                                    ->placeholder('https://instagram.com/username')
                                                    ->maxLength(255),
                                                    
                                                Forms\Components\TextInput::make('social_youtube')
                                                    ->label('YouTube')
                                                    ->url()
                                                    ->placeholder('https://youtube.com/channel/...')
                                                    ->maxLength(255),
                                                    
                                                Forms\Components\TextInput::make('social_linkedin')
                                                    ->label('LinkedIn')
                                                    ->url()
                                                    ->placeholder('https://linkedin.com/company/...')
                                                    ->maxLength(255),
                                            ]),
                                    ])
                                    ->collapsible(),
                            ]),
                    ])
                    ->columnSpanFull()
                    ->persistTabInQueryString(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('site_name')
                    ->label('Nama Situs')
                    ->searchable()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('site_tagline')
                    ->label('Tagline')
                    ->searchable()
                    ->limit(50),
                    
                Tables\Columns\ImageColumn::make('site_logo')
                    ->label('Logo')
                    ->circular(),
                    
                Tables\Columns\TextColumn::make('contact_email')
                    ->label('Email Kontak')
                    ->searchable(),
                    
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Terakhir Diperbarui')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Edit Pengaturan'),
            ])
            ->bulkActions([
                // Disable bulk actions for single record
            ])
            ->paginated(false); // Disable pagination since we only have one record
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
            'index' => Pages\ListWebsiteSettings::route('/'),
            'edit' => Pages\EditWebsiteSetting::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        // Prevent creating multiple records
        return WebsiteSetting::count() === 0;
    }
}