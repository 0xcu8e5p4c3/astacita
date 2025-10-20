<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"/>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="container mx-auto">
        <div class="bg-white shadow-sm rounded-xl overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-3 divide-y lg:divide-y-0 lg:divide-x divide-gray-200">
                
                <!-- OKEGAS Section -->
                <div class="p-4 lg:p-6">
                    <div class="flex items-center mb-5">
                        <h2 class="text-xs lg:text-sm font-bold tracking-wider text-gray-900">OKEGAS</h2>
                        <div class="flex-grow h-px bg-gray-300 ml-3"></div>
                    </div>
                    
                    @if ($okegas->count() > 0)
                    <!-- Featured Article - Hidden on mobile -->
                    <div class="hidden lg:block relative mb-6 group overflow-hidden rounded-lg">
                        <img alt="{{ $okegas[0]->title }}" 
                             class="w-full h-56 object-cover transition-transform duration-300 group-hover:scale-105" 
                             src="{{ $okegas[0]->media ? route('image.show', $okegas[0]->media->file_path) : asset('storage/default_image.jpg') }}"/>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-4">
                            <a href="{{ route('article.show', ['categorySlug' => $okegas[0]->category->slug, 'articleSlug' => $okegas[0]->slug]) }}" 
                               class="text-base font-bold text-white hover:text-gray-200 transition line-clamp-2">
                                {{ $okegas[0]->title }}
                            </a>
                            <p class="text-gray-300 text-xs mt-1">
                                {{ $okegas[0]->author->name ?? 'Anonim' }} • {{ \Carbon\Carbon::parse($okegas[0]->created_at)->format('d M Y') }}
                            </p>
                        </div>
                    </div>
                    @endif
                    
                    <!-- Article List -->
                    <div class="space-y-4">
                        @foreach ($okegas->skip(0) as $article)
                        <div class="flex gap-3 group">
                            <img alt="{{ $article->title }}" 
                                 class="w-20 h-20 lg:w-24 lg:h-24 object-cover flex-shrink-0 transition-opacity group-hover:opacity-80 rounded-lg" 
                                 src="{{ $article->media ? route('image.show', $article->media->file_path) : asset('storage/default_image.jpg') }}"/>
                            <div class="flex-1 min-w-0">
                                <a href="{{ route('article.show', ['categorySlug' => $article->category->slug, 'articleSlug' => $article->slug]) }}" 
                                   class="text-sm lg:text-base font-semibold text-gray-900 hover:text-gray-600 transition line-clamp-2 lg:line-clamp-3">
                                    {{ $article->title }}
                                </a>
                                <p class="text-gray-500 text-xs mt-1">
                                    <span class="hidden lg:inline">{{ $article->author->name ?? 'Anonim' }} • </span>{{ \Carbon\Carbon::parse($article->created_at)->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- BUMN Section -->
                <div class="p-4 lg:p-6">
                    <div class="flex items-center mb-5">
                        <h2 class="text-xs lg:text-sm font-bold tracking-wider text-gray-900">BUMN</h2>
                        <div class="flex-grow h-px bg-gray-300 ml-3"></div>
                    </div>
                    
                    @if ($bumn->count() > 0)
                    <!-- Featured Article - Hidden on mobile -->
                    <div class="hidden lg:block relative mb-6 group overflow-hidden rounded-lg">
                        <img alt="{{ $bumn[0]->title }}" 
                             class="w-full h-56 object-cover transition-transform duration-300 group-hover:scale-105" 
                             src="{{ $bumn[0]->media ? route('image.show', $bumn[0]->media->file_path) : asset('storage/default_image.jpg') }}"/>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-4">
                            <a href="{{ route('article.show', ['categorySlug' => $bumn[0]->category->slug, 'articleSlug' => $bumn[0]->slug]) }}" 
                               class="text-base font-bold text-white hover:text-gray-200 transition line-clamp-2">
                                {{ $bumn[0]->title }}
                            </a>
                            <p class="text-gray-300 text-xs mt-1">
                                {{ $bumn[0]->author->name ?? 'Anonim' }} • {{ \Carbon\Carbon::parse($bumn[0]->created_at)->diffForHumans() }}
                            </p>
                        </div>
                    </div>
                    @endif
                    
                    <!-- Article List -->
                    <div class="space-y-4">
                        @foreach ($bumn->skip(0) as $article)
                        <div class="flex gap-3 group">
                            <img alt="{{ $article->title }}" 
                                 class="w-20 h-20 lg:w-24 lg:h-24 object-cover flex-shrink-0 transition-opacity group-hover:opacity-80 rounded-lg" 
                                 src="{{ $article->media ? route('image.show', $article->media->file_path) : asset('storage/default_image.jpg') }}"/>
                            <div class="flex-1 min-w-0">
                                <a href="{{ route('article.show', ['categorySlug' => $article->category->slug, 'articleSlug' => $article->slug]) }}" 
                                   class="text-sm lg:text-base font-semibold text-gray-900 hover:text-gray-600 transition line-clamp-2 lg:line-clamp-3">
                                    {{ $article->title }}
                                </a>
                                <p class="text-gray-500 text-xs mt-1">
                                    <span class="hidden lg:inline">{{ $article->author->name ?? 'Anonim' }} • </span>{{ \Carbon\Carbon::parse($article->created_at)->format('d/m/Y') }}
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- KABINET Section -->
                <div class="p-4 lg:p-6">
                    <div class="flex items-center mb-5">
                        <h2 class="text-xs lg:text-sm font-bold tracking-wider text-gray-900">KABINET</h2>
                        <div class="flex-grow h-px bg-gray-300 ml-3"></div>
                    </div>
                    
                    @if ($kabinet->count() > 0)
                    <!-- Featured Article - Hidden on mobile -->
                    <div class="hidden lg:block relative mb-6 group overflow-hidden rounded-lg">
                        <img alt="{{ $kabinet[0]->title }}" 
                             class="w-full h-56 object-cover transition-transform duration-300 group-hover:scale-105" 
                             src="{{ $kabinet[0]->media ? route('image.show', $kabinet[0]->media->file_path) : asset('storage/default_image.jpg') }}"/>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-4">
                            <a href="{{ route('article.show', ['categorySlug' => $kabinet[0]->category->slug, 'articleSlug' => $kabinet[0]->slug]) }}" 
                               class="text-base font-bold text-white hover:text-gray-200 transition line-clamp-2">
                                {{ $kabinet[0]->title }}
                            </a>
                            <p class="text-gray-300 text-xs mt-1">
                                {{ $kabinet[0]->author->name ?? 'Anonim' }} • {{ \Carbon\Carbon::parse($kabinet[0]->created_at)->format('d M Y') }}
                            </p>
                        </div>
                    </div>
                    @endif
                    
                    <!-- Article List -->
                    <div class="space-y-4">
                        @foreach ($kabinet->skip(0) as $article)
                        <div class="flex gap-3 group">
                            <img alt="{{ $article->title }}" 
                                 class="w-20 h-20 lg:w-24 lg:h-24 object-cover flex-shrink-0 transition-opacity group-hover:opacity-80 rounded-lg" 
                                 src="{{ $article->media ? route('image.show', $article->media->file_path) : asset('storage/default_image.jpg') }}"/>
                            <div class="flex-1 min-w-0">
                                <a href="{{ route('article.show', ['categorySlug' => $article->category->slug, 'articleSlug' => $article->slug]) }}" 
                                   class="text-sm lg:text-base font-semibold text-gray-900 hover:text-gray-600 transition line-clamp-2 lg:line-clamp-3">
                                    {{ $article->title }}
                                </a>
                                <p class="text-gray-500 text-xs mt-1">
                                    <span class="hidden lg:inline">{{ $article->author->name ?? 'Anonim' }} • </span>{{ \Carbon\Carbon::parse($article->created_at)->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>
</html>