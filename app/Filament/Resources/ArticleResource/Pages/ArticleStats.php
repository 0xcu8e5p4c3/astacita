<?php

namespace App\Filament\Resources\ArticleResource\Pages;

use App\Filament\Resources\ArticleResource;
use Filament\Resources\Pages\Page;

class ArticleStats extends Page
{
    protected static string $resource = ArticleResource::class;

    protected static string $view = 'filament.resources.article-resource.pages.article-stats';
}
