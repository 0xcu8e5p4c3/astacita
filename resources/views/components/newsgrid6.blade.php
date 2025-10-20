<script src="{{ asset('js/loadmore2.js') }}"></script>

<h1 class="text-2xl font-bold mt-6 mb-6 text-gray-900">
    Discover
</h1>

<div class="flex flex-col lg:flex-row gap-6">
    <!-- Artikel -->
    <div id="article-container" class="flex-1 space-y-4">
        @foreach ($articles as $article)
            <article class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden">
                <a href="{{ route('article.show', ['categorySlug' => $article->category->slug, 'articleSlug' => $article->slug]) }}" 
                   class="flex gap-4 p-4">
                    
                    <!-- Thumbnail -->
                    <div class="flex-shrink-0">
                        <img src="{{ $article->media ? route('image.show', $article->media->file_path) : asset('storage/default_image.jpg') }}"
                             alt="{{ $article->title }}"
                             class="w-24 h-24 lg:w-32 lg:h-32 object-cover rounded-lg">
                    </div>

                    <!-- Content -->
                    <div class="flex-1 min-w-0">
                        <!-- Category & Date - Mobile -->
                        <div class="flex items-center gap-2 mb-2 lg:mb-3">
                            <span class="text-xs font-semibold text-gray-400">
                                {{ $article->category->name }}
                            </span>
                            <span class="text-xs text-gray-500">
                                {{ $article->created_at->format('d M Y') }}
                            </span>
                        </div>

                        <!-- Title -->
                        <h2 class="font-semibold text-base lg:text-lg text-gray-900 leading-snug mb-2 line-clamp-2 hover:text-blue-600 transition-colors">
                            {{ $article->title }}
                        </h2>

                        <!-- Excerpt - Desktop Only -->
                        <p class="hidden lg:block text-sm text-gray-600 mb-3 line-clamp-2">
                            {{ Str::limit(strip_tags($article->content), 120) }}
                        </p>

                        <!-- Meta Info - Desktop Only -->
                        <div class="hidden lg:flex items-center gap-3 text-xs text-gray-500">
                            <div class="flex items-center gap-1.5">
                                <img src="{{ $article->author->avatar ?? 'https://placehold.co/24x24' }}" 
                                     class="w-5 h-5 rounded-full" 
                                     alt="{{ $article->author->name ?? 'Author' }}">
                                <span>{{ $article->author->name ?? 'Unknown' }}</span>
                            </div>
                            <span class="text-gray-300">•</span>
                            <span>{{ $article->created_at->diffForHumans() }}</span>
                            <span class="text-gray-300">•</span>
                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                <span>{{ $article->views_count }}</span>
                            </div>
                        </div>

                        <!-- Mobile: Views Only -->
                        <div class="flex lg:hidden items-center gap-1 text-xs text-gray-500 mt-2">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            <span>{{ $article->views_count }} views</span>
                        </div>
                    </div>
                </a>
            </article>
        @endforeach
    </div>

    <!-- Sidebar - Hidden on Mobile -->
    <aside class="hidden lg:block w-80 flex-shrink-0">
        <div class="sticky top-6">
            <x-sidebarcard />
        </div>
    </aside>
</div>

<!-- Load More Button -->
<div class="flex justify-center mt-8 mb-6">
    <button id="load-more" 
            type="button"
            data-url="{{ route('articles.loadmore') }}"
            data-page="2"
            class="group inline-flex items-center gap-2 px-6 py-3 bg-white border border-gray-200 rounded-full text-sm font-medium text-gray-700 hover:bg-gray-50 hover:border-gray-300 transition-all duration-200 shadow-sm">
        
        <span id="load-more-text">View More</span>
        
        <svg xmlns="http://www.w3.org/2000/svg" 
             viewBox="0 0 20 20" 
             fill="currentColor" 
             class="w-4 h-4 group-hover:translate-y-0.5 transition-transform duration-200">
            <path fill-rule="evenodd" 
                  d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" 
                  clip-rule="evenodd" /> 
        </svg>
    </button>
</div>