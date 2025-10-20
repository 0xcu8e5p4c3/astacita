  <h1 class="text-xl font-bold">News</h1>

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 md:gap-6">
    
    <!-- Featured Article - Full width on mobile -->
    <div class="lg:col-span-1">
      <div class="relative h-[400px] md:h-[520px] rounded-2xl overflow-hidden shadow-xl group border border-gray-200">
        <img 
          src="{{ $featuredArticle->media ? route('image.show', $featuredArticle->media->file_path) : asset('storage/default_image.jpg') }}" 
          alt="{{ $featuredArticle->title }}"
          class="absolute inset-0 w-full h-full object-cover transition-all duration-500 group-hover:scale-110 group-hover:brightness-75" 
        />
        
        <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/60 to-transparent"></div>
        
        <div class="absolute top-4 left-4">
          <span class="px-3 py-1.5 bg-gray-900/80 backdrop-blur-sm text-white text-xs font-semibold rounded-full border border-gray-700">
            Featured
          </span>
        </div>
        
        <div class="absolute bottom-0 left-0 right-0 p-5 md:p-7">
          <a 
            href="{{ route('article.show', ['categorySlug' => $featuredArticle->category->slug, 'articleSlug' => $featuredArticle->slug]) }}" 
            class="block text-lg md:text-xl font-bold text-white hover:text-gray-300 transition line-clamp-3 mb-3 leading-tight"
          >
            {{ $featuredArticle->title }}
          </a>
          
          <div class="flex flex-wrap items-center gap-2 text-xs md:text-sm text-gray-300">
            <span class="font-semibold text-white">Astacita.co</span>
            <span class="text-gray-500">•</span>
            <span>{{ $featuredArticle->author->name ?? 'Anonim' }}</span>
            <span class="text-gray-500">•</span>
            <span>{{ $featuredArticle->created_at->diffForHumans() }}</span>
          </div>
        </div>
      </div>
    </div>

    <!-- Trending Section -->
    <div class="lg:col-span-1">
      <div class="bg-white rounded-2xl shadow-lg overflow-hidden h-[400px] md:h-[520px] flex flex-col border border-gray-200">
        <div class="bg-gradient-to-br from-gray-800 to-gray-900 px-5 py-4 border-b border-gray-700">
          <h3 class="font-bold text-white flex items-center gap-2.5 text-base">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"/>
            </svg>
            <span>Trending di Crypto</span>
          </h3>
        </div>
        
        <div class="overflow-y-auto flex-1 p-4 space-y-2 bg-gray-50">
          @foreach ($trendingArticles as $article)
            <div class="flex gap-3 pb-3 border-b border-gray-200 last:border-0 hover:bg-white rounded-xl transition-all duration-200 p-3 -m-1 cursor-pointer group">
              <div class="relative flex-shrink-0">
                <img 
                  src="{{ $article->media ? route('image.show', $article->media->file_path) : asset('storage/default_image.jpg') }}" 
                  class="w-20 h-20 md:w-24 md:h-24 rounded-xl object-cover border border-gray-200 group-hover:border-gray-300 transition" 
                  alt="{{ $article->title }}"
                />
              </div>
              
              <div class="flex-1 min-w-0">
                <a 
                  href="{{ route('article.show', ['categorySlug' => $article->category->slug, 'articleSlug' => $article->slug]) }}" 
                  class="font-semibold text-sm md:text-base text-gray-900 group-hover:text-gray-600 transition line-clamp-2 mb-2 block leading-snug"
                >
                  {{ $article->title }}
                </a>
                
                <div class="flex items-center gap-2 text-xs text-gray-500">
                  <span class="flex items-center gap-1">
                      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                      </svg>
                    {{ $article->views_count }}
                  </span>
                  <span class="text-gray-400">•</span>
                  <span>{{ $article->created_at->diffForHumans() }}</span>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>

    <!-- Latest Section -->
    <div class="lg:col-span-1">
      <div class="bg-white rounded-2xl shadow-lg overflow-hidden h-[400px] md:h-[520px] flex flex-col border border-gray-200">
        <div class="bg-gradient-to-br from-gray-700 to-gray-800 px-5 py-4 border-b border-gray-600">
          <h3 class="font-bold text-white flex items-center gap-2.5 text-base">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"/>
            </svg>
            <span>Terbaru di News</span>
          </h3>
        </div>
        
        <div class="overflow-y-auto flex-1 p-4 space-y-2 bg-gray-50">
          @foreach ($latestArticles as $article)
            <div class="flex gap-3 pb-3 border-b border-gray-200 last:border-0 hover:bg-white rounded-xl transition-all duration-200 p-3 -m-1 cursor-pointer group">
              <div class="relative flex-shrink-0">
                <img 
                  src="{{ $article->media ? route('image.show', $article->media->file_path) : asset('storage/default_image.jpg') }}" 
                  class="w-20 h-20 md:w-24 md:h-24 rounded-xl object-cover border border-gray-200 group-hover:border-gray-300 transition" 
                  alt="{{ $article->title }}"
                />
              </div>
              
              <div class="flex-1 min-w-0">
                <a 
                  href="{{ route('article.show', ['categorySlug' => $article->category->slug, 'articleSlug' => $article->slug]) }}" 
                  class="font-semibold text-sm md:text-base text-gray-900 group-hover:text-gray-600 transition line-clamp-2 mb-2 block leading-snug"
                >
                  {{ $article->title }}
                </a>
                
                <div class="flex items-center gap-2 text-xs text-gray-500">
                  <span class="flex items-center gap-1">
                      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                      </svg>
                    {{ $article->views_count }}
                  </span>
                  <span class="text-gray-400">•</span>
                  <span>{{ $article->created_at->diffForHumans() }}</span>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>

  </div>
</div>