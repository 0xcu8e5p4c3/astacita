<x-layout>
  <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
  <script src="{{ asset('js/loadmore.js') }}"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <style>
    @media (max-width: 768px) {
      .desktop-carousel {
        display: none;
      }
      .mobile-trending-list {
        display: block;
      }
      .sidebar-desktop {
        display: none;
      }
      .desktop-article-card {
        display: none;
      }
      .mobile-article-list {
        display: block;
      }
    }
    @media (min-width: 769px) {
      .mobile-trending-list,
      .mobile-article-list {
        display: none;
      }
      .desktop-article-card {
        display: block;
      }
    }
  </style>

  <div class="container mx-auto p-6">
    <div class="flex flex-col md:flex-row gap-6">

      <!-- Trending Area -->
      <div class="flex-1">
        @if(isset($trending) && count($trending) > 0)

        <!-- Desktop Carousel -->
        <div class="desktop-carousel">
          <div class="carousel carousel-end rounded-box">
            @foreach($trending as $item)
            <a href="{{ route('article.show', ['categorySlug' => $item->category->slug, 'articleSlug' => $item->slug]) }}" class="carousel-item relative">
              <img src="{{ $item->thumbnail ? asset('storage/'.$item->thumbnail) : 'https://picsum.photos/seed/'.$item->id.'/800/450' }}" 
                   alt="{{ $item->title }}" class="w-full h-48 object-cover" />
              <div class="absolute bottom-0 left-0 w-full bg-black bg-opacity-50 text-white p-4 text-center">
                <span class="block text-xs font-bold uppercase">{{ $item->category->name ?? 'Uncategorized' }}</span>
                <h3 class="text-lg font-semibold">{{ $item->title }}</h3>
                <p class="text-sm">{{ Str::limit(strip_tags($item->content), 50) }}</p>
              </div>
            </a>
            @endforeach
          </div>
        </div>

        <!-- Mobile Trending List -->
        <div class="mobile-trending-list space-y-4">
          @foreach($trending as $item)
          <div class="flex items-center gap-4 border-b pb-3">
            <a href="{{ route('article.show', ['categorySlug' => $item->category->slug, 'articleSlug' => $item->slug]) }}" class="w-24 flex-shrink-0">
              <img src="{{ $item->thumbnail ? asset('storage/'.$item->thumbnail) : 'https://picsum.photos/seed/'.$item->id.'/400/250' }}" 
                   alt="{{ $item->title }}" class="w-24 h-16 object-cover rounded-md">
            </a>
            <div class="flex-1">
              <span class="text-xs font-semibold uppercase text-gray-500">{{ $item->category->name ?? 'Uncategorized' }}</span>
              <h3 class="text-sm font-bold leading-snug">
                <a href="{{ route('article.show', ['categorySlug' => $item->category->slug, 'articleSlug' => $item->slug]) }}" class="hover:text-blue-500">
                  {{ Str::limit($item->title, 50) }}
                </a>
              </h3>
            </div>
          </div>
          @endforeach
        </div>

        @else
          <p class="text-center text-gray-500">Tidak ada berita trending.</p>
        @endif

        <!-- Garis pembatas -->
        <div class="border-t my-6"></div>

        <!-- Artikel List -->
        <div class="grid grid-cols-1 gap-6">
          <div id="news-container">
            @if(isset($articles) && count($articles) > 0)
              <!-- Artikel Mobile List -->
              <div class="mobile-article-list space-y-4">
                @foreach ($articles as $article)
                <div class="flex items-center gap-4 border-b pb-3">
                  <a href="{{ route('article.show', ['categorySlug' => $article->category->slug, 'articleSlug' => $article->slug]) }}" class="w-24 flex-shrink-0">
                    <img src="{{ $article->thumbnail ? asset('storage/'.$article->thumbnail) : 'https://picsum.photos/seed/'.$article->id.'/400/250' }}" 
                         alt="{{ $article->title }}" class="w-24 h-16 object-cover rounded-md">
                  </a>
                  <div class="flex-1">
                    <span class="text-xs font-semibold uppercase text-gray-500">{{ $article->category->name ?? 'Uncategorized' }}</span>
                    <h3 class="text-sm font-bold leading-snug">
                      <a href="{{ route('article.show', ['categorySlug' => $article->category->slug, 'articleSlug' => $article->slug]) }}" class="hover:text-blue-500">
                        {{ Str::limit($article->title, 50) }}
                      </a>
                    </h3>
                  </div>
                </div>
                @endforeach
              </div>

              <!-- Artikel Desktop Card -->
              <div class="desktop-article-card space-y-6">
                @foreach ($articles as $article)
                <div class="relative bg-white shadow-md rounded-lg overflow-hidden flex flex-col md:flex-row">
                  <a href="{{ route('article.show', ['categorySlug' => $article->category->slug, 'articleSlug' => $article->slug]) }}" class="w-full md:w-1/3">
                    <img src="{{ $article->thumbnail ? asset('storage/'.$article->thumbnail) : 'https://picsum.photos/seed/'.$article->id.'/400/250' }}" 
                         alt="{{ $article->title }}" class="w-full h-48 md:h-full object-cover">
                  </a>
                  <div class="p-4 flex flex-col justify-between w-full md:w-2/3">
                    <div>
                      <span class="text-xs font-bold uppercase text-gray-600">{{ $article->category->name ?? 'Uncategorized' }}</span>
                      <h3 class="text-lg font-semibold mt-1">
                        <a href="{{ route('article.show', ['categorySlug' => $article->category->slug, 'articleSlug' => $article->slug]) }}" class="hover:text-blue-500">
                          {{ $article->title }}
                        </a>
                      </h3>
                      <p class="text-sm text-gray-600 mt-2">{{ Str::limit(strip_tags($article->content), 100) }}</p>
                    </div>
                    <div class="mt-3 flex items-center text-sm text-gray-500">
                      <img src="{{ $article->author->foto_profile ?? 'https://ui-avatars.com/api/?name='.urlencode($article->author->name) }}" 
                           alt="Author Avatar" class="w-8 h-8 rounded-full mr-2">
                      <span>
                        Ditulis oleh <strong>{{ $article->author->name ?? 'Anonim' }}</strong> 
                        pada {{ $article->created_at->format('d M Y') }}
                      </span>
                    </div>
                  </div>
                </div>
                @endforeach
              </div>
            @else
              <p class="text-center text-gray-500">Tidak ada berita terbaru.</p>
            @endif
          </div>
        </div>

        <!-- Tombol Load More -->
        @if(isset($articles) && count($articles) > 0)
    <div class="fter:h-px my-4 flex items-center before:h-px before:flex-1 before:bg-gray-300 before:content-[''] after:h-px after:flex-1 after:bg-gray-300 after:content-['']">
        <button id="load-more" 
                type="button"
                data-url="{{ route('category.loadmore', $category->slug) }}"
                data-page="2"
                class="flex items-center rounded-full border border-gray-300 bg-secondary-50 px-3 py-2 text-center text-sm font-medium text-gray-900 hover:bg-gray-100">
            
            <!-- ICON -->
            <svg xmlns="http://www.w3.org/2000/svg" 
                 viewBox="0 0 20 20" 
                 fill="currentColor" 
                 class="mr-1 h-4 w-4">
                <path fill-rule="evenodd" 
                      d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" 
                      clip-rule="evenodd" /> 
            </svg>

            <!-- TEXT -->
            <span id="load-more-text">View More</span>
        </button>
    </div>
@endif

      </div>

      <!-- Sidebar Desktop Only -->
      <div class="sidebar-desktop w-full md:w-80">
        <x-sidebarcard />
      </div>

    </div>
  </div>
</x-layout>
