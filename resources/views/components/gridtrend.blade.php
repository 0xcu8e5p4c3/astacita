<style>
/* Custom scrollbar untuk desktop */
.trending-scroll::-webkit-scrollbar {
    height: 6px;
}
.trending-scroll::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}
.trending-scroll::-webkit-scrollbar-thumb {
    background: #6b7280;
    border-radius: 10px;
}
.trending-scroll::-webkit-scrollbar-thumb:hover {
    background: #4b5563;
}

/* Hide scrollbar on mobile */
@media (max-width: 768px) {
    .trending-scroll::-webkit-scrollbar {
        display: none;
    }
    .trending-scroll {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
}

/* Smooth scroll */
.trending-scroll {
    scroll-behavior: smooth;
}

/* Swipe indicator animation */
@keyframes swipeHint {
    0%, 100% { transform: translateX(0); opacity: 1; }
    50% { transform: translateX(-8px); opacity: 0.6; }
}
.swipe-hint {
    animation: swipeHint 2s ease-in-out infinite;
}
</style>

<div class="bg-white">
    <!-- Mobile Version -->
    <div class="md:hidden py-4">
        <div class="">
            <div class="flex items-center gap-2 mb-3">
                <div class="flex items-center gap-1.5">
                    <span class="text-xs font-bold text-black uppercase tracking-wider">Trending</span>
                </div>
                <div class="h-4 w-px bg-gray-300"></div>
                <div class="flex items-center gap-1 text-gray-400 swipe-hint">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    <span class="text-xs">Geser</span>
                </div>
            </div>
            
            <div class="trending-scroll flex gap-3 overflow-x-auto pb-2">
                @foreach ($hometrend as $article)
                    <a href="{{ route('article.show', ['categorySlug' => $article->category->slug, 'articleSlug' => $article->slug]) }}" 
                       class="flex-shrink-0 w-64 group">
                        <div class="relative overflow-hidden rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300">
                            <img src="{{ $article->media ? route('image.show', $article->media->file_path) : asset('storage/default_image.jpg') }}" 
                                 alt="{{ $article->title }}"
                                 class="w-full h-36 object-cover group-hover:scale-105 transition-transform duration-300 grayscale"/>
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
                            <div class="absolute bottom-0 left-0 right-0 p-3">
                                <span class="inline-block px-2 py-0.5 bg-gray-500 text-white text-xs font-semibold rounded mb-1.5">
                                    {{ $article->category->name ?? 'Uncategorized' }}
                                </span>
                                <h3 class="text-white text-sm font-bold line-clamp-2 leading-snug">
                                    {{ $article->title }}
                                </h3>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Desktop Version -->
    <div class="hidden md:block">
        <div class="container mx-auto px-4 pb-6">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-2">
                    <h2 class="text-xl font-bold text-gray-900">Trending</h2>
                </div>
                
                <div class="flex items-center gap-2">
                    <button onclick="scrollTrending('left')" 
                            class="p-2 rounded-full bg-gray-100 hover:bg-gray-200 transition-colors duration-200">
                        <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </button>
                    <button onclick="scrollTrending('right')" 
                            class="p-2 rounded-full bg-gray-100 hover:bg-gray-200 transition-colors duration-200">
                        <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>
                </div>
            </div>

            <div id="trendingContainer" class="trending-scroll flex gap-4 overflow-x-auto pb-3">
                @foreach ($hometrend as $article)
                    <a href="{{ route('article.show', ['categorySlug' => $article->category->slug, 'articleSlug' => $article->slug]) }}" 
                       class="flex-shrink-0 w-80 group">
                        <div class="relative overflow-hidden rounded-xl shadow-md hover:shadow-xl transition-all duration-300">
                            <img src="{{ $article->media ? route('image.show', $article->media->file_path) : asset('storage/default_image.jpg') }}" 
                                 alt="{{ $article->title }}"
                                 class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500 grayscale"/>
                            <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/50 to-transparent"></div>
                            <div class="absolute bottom-0 left-0 right-0 p-5">
                                <span class="inline-block px-3 py-1 bg-gray-400 text-white text-xs font-bold rounded-full mb-2 uppercase tracking-wide">
                                    {{ $article->category->name ?? 'Uncategorized' }}
                                </span>
                                <h3 class="text-white text-lg font-bold line-clamp-2 leading-tight mb-2 group-hover:text-gray-300 transition-colors">
                                    {{ $article->title }}
                                </h3>
                                <p class="text-gray-200 text-sm line-clamp-2">
                                    {{ Str::limit($article->summary, 80) }}
                                </p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script>
function scrollTrending(direction) {
    const container = document.getElementById('trendingContainer');
    const scrollAmount = 340; // Width of card + gap
    
    if (direction === 'left') {
        container.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
    } else {
        container.scrollBy({ left: scrollAmount, behavior: 'smooth' });
    }
}

// Auto-hide swipe hint after user scrolls on mobile
let hasScrolled = false;
document.addEventListener('DOMContentLoaded', function() {
    const mobileScroll = document.querySelector('.trending-scroll');
    if (mobileScroll && window.innerWidth < 768) {
        mobileScroll.addEventListener('scroll', function() {
            if (!hasScrolled) {
                hasScrolled = true;
                const hint = document.querySelector('.swipe-hint');
                if (hint) {
                    hint.style.opacity = '0';
                    setTimeout(() => hint.style.display = 'none', 300);
                }
            }
        }, { once: true });
    }
});
</script>