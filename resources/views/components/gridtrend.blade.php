<link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ asset('css/carouselitem.css') }}">

<style>

@keyframes swipeMove {
  0% { transform: translateX(0); opacity: 1; }
  50% { transform: translateX(-5px); opacity: 0.7; }
  100% { transform: translateX(0); opacity: 1; }
}
.animate-bounce-swipe {
  animation: swipeMove 1.5s infinite;
}

@media (max-width: 768px) {
    .carousel {
        padding-bottom: 0.5rem;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        scroll-snap-type: x mandatory;
    }
    .carousel-item {
        flex: 0 0 auto;
        scroll-snap-align: start;
        padding: 0 0.5rem;
    }
    .mobile-title {
        display: block;
    }
}

.scrollbar-hide::-webkit-scrollbar {
    display: none;
}
.scrollbar-hide {
    -ms-overflow-style: none;
    scrollbar-width: none;
}

/* Biar mobile carousel hilang dan desktop carousel muncul */
@media (min-width: 768px) {
    .flex.items-center.overflow-x-auto {
        display: none;
    }
}
</style>


<div class="relative">
    <!-- Trending + List -->
    <div class="border-t border-b py-2 flex items-center md:hidden overflow-x-auto scrollbar-hide relative">
        <div class="text-xs font-bold text-red-600 mr-2 flex-shrink-0">
            TRENDING:
        </div>
        <div class="flex items-center space-x-2 flex-1">
            @foreach ($hometrend as $article)
                <a href="{{ route('article.show', ['categorySlug' => $article->category->slug, 'articleSlug' => $article->slug]) }}" 
                   class="flex-shrink-0 text-xs font-semibold text-gray-800 hover:text-blue-600 whitespace-nowrap">
                    {{ $article->title }}
                </a>
                @if (!$loop->last)
                    <span class="flex-shrink-0 text-gray-400">|</span>
                @endif
            @endforeach
        </div>

        <!-- Geser Animation di Pojok Kanan -->
        <div class="absolute right-0 top-1/2 -translate-y-1/2 flex items-center space-x-1 animate-bounce-swipe bg-white pl-2 pr-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            <span class="text-xs text-gray-400">Geser</span>
        </div>
    </div>
</div>


        <!-- Desktop carousel -->
        <div class="hidden md:block">
            <h1 class="text-xl font-bold mb-4">Trending</h1>
            <div class="carousel carousel-end rounded-box">
                @foreach ($hometrend as $article)
                    <a href="{{ route('article.show', ['categorySlug' => $article->category->slug, 'articleSlug' => $article->slug]) }}" class="carousel-item relative">
                        <img src="{{ $article->media->file_path ?? asset('storage/default.jpg') }}" 
                            alt="{{ $article->title }}" 
                            class="w-full h-40 object-cover" />
                        <div class="absolute bottom-0 left-0 w-full bg-black bg-opacity-50 text-white p-4 text-center">
                            <span class="block text-xs font-bold uppercase">
                                {{ $article->category->name ?? 'Uncategorized' }}
                            </span>
                            <h3 class="text-lg font-semibold">{{ $article->title }}</h3>
                            <p class="text-sm">{{ Str::limit($article->summary, 100) }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>




<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
