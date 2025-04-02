<x-layout>
  <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
  <script src="{{ asset('js/loadmore.js') }}"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="{{ asset('css/carouselitem.css') }}">

  <div class="container mx-auto p-6">
    <div class="flex flex-col md:flex-row gap-6">
      <!-- Trending category AI -->
      <div class="flex-1">
        @if(isset($trending) && count($trending) > 0)
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
        @else
        <p class="text-center text-gray-500">Tidak ada berita trending.</p>
        @endif

        <!-- All article filter yang paling atas yg terbaru -->
    <div class="grid grid-cols-1 gap-6 max-w-6xl mx-auto pt-6">
      <div id="news-container">
          @if(isset($articles) && count($articles) > 0)
          @foreach ($articles as $article)
    <div class="relative bg-white shadow-md rounded-lg overflow-hidden flex flex-col md:flex-row mb-2">
        <!-- Menampilkan gambar thumbnail artikel -->
        <a href="{{ route('article.show', ['categorySlug' => $article->category->slug, 'articleSlug' => $article->slug]) }}" class="w-full md:w-1/3">
            <img src="{{ $article->thumbnail ? asset('storage/'.$article->thumbnail) : 'https://picsum.photos/seed/'.$article->id.'/400/250' }}" 
                alt="{{ $article->title }}" class="w-full h-48 md:h-full object-cover">
        </a>
        <div class="p-4 w-full md:w-2/3 flex flex-col justify-between">
            <div>
                <span class="text-xs font-bold uppercase text-gray-600">
                    {{ $article->category->name ?? 'Uncategorized' }}
                </span>
                <h3 class="text-lg font-semibold mt-1">
                    <!-- Link artikel menuju ke artikel detail -->
                    <a href="{{ route('article.show', ['categorySlug' => $article->category->slug, 'articleSlug' => $article->slug]) }}" class="hover:text-blue-500">
                        {{ $article->title }}
                    </a>
                </h3>
                <p class="text-sm text-gray-600 mt-2">
                    {{ Str::limit(strip_tags($article->content), 100) }}
                </p>
            </div>
            <div class="mt-3 flex items-center text-sm text-gray-500">
                <img src="{{ $article->author->avatar ?? 'https://ui-avatars.com/api/?name='.urlencode($article->author->name) }}" 
                    alt="Author Avatar" class="w-8 h-8 rounded-full mr-2">
                <span>
                    Ditulis oleh <strong>{{ $article->author->name ?? 'Anonim' }}</strong> 
                    pada {{ $article->created_at->format('d M Y') }}
                </span>
            </div>
        </div>
    </div>
@endforeach

          @else
              <p class="text-center text-gray-500">Tidak ada berita terbaru.</p>
          @endif
      </div>
  </div>


        @if(isset($articles) && count($articles) > 0)
    <div class="fter:h-px my-24 flex items-center before:h-px before:flex-1  before:bg-gray-300 before:content-[''] after:h-px after:flex-1 after:bg-gray-300  after:content-['']">
    <button id="load-more" type="button"
        data-url="{{ route('category.loadmore', $category->slug) }}"
        class="flex items-center rounded-full border border-gray-300 bg-secondary-50 px-3 py-2 text-center text-sm font-medium text-gray-900 hover:bg-gray-100">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="mr-1 h-4 w-4">
            <path fill-rule="evenodd"
                d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                clip-rule="evenodd" />
        </svg>
        View More
    </button>
</div>
        @endif
      </div> 

      <div class="w-full md:w-80">
        <x-sidebarcard />
      </div>

    </div>
  </div>
</x-layout>
