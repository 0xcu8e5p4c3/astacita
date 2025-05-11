<div class="max-w-7xl mx-auto py-6">
    <!-- Headline Section -->
    <div class="grid grid-cols-1 md:grid-cols-[2fr_1fr] gap-6">
        <!-- Left Article (Desktop) -->
        <div class="relative overflow-hidden rounded-lg hidden md:block">
            <img src="{{ $leftArticle->file_path ? asset('storage/'.$leftArticle->file_path) : 'https://picsum.photos/seed/'.$leftArticle->id.'/600/400' }}" 
                alt="{{ $leftArticle->title }}" 
                class="w-full aspect-[16/9] object-cover" />
            <div class="absolute bottom-0 left-0 w-full bg-black bg-opacity-50 text-white p-4 text-center">
                <span class="block text-xs font-bold uppercase">{{ $leftArticle->category->name }}</span>
                <h3 class="text-lg font-semibold">
                    <a href="{{ route('article.show', ['categorySlug' => $leftArticle->category->slug, 'articleSlug' => $leftArticle->slug]) }}" class="no-underline">{{ $leftArticle->title }}</a>
                </h3>
                <p class="text-sm">{{ Str::limit($leftArticle->content, 100) }}</p>
            </div>
        </div>

        <!-- Right Article (Desktop) -->
        <div class="bg-white p-6 rounded-lg shadow-md hidden md:block">
            <img src="{{ $rightArticle->file_path ? asset('storage/'.$rightArticle->file_path) : 'https://picsum.photos/seed/'.$rightArticle->id.'/600/400' }}" 
                alt="{{ $rightArticle->title }}" 
                class="w-full aspect-[16/9] object-cover rounded-lg mb-4" />
            <span class="bg-white shadow-md text-xs font-bold px-3 py-1 rounded">{{ $rightArticle->category->name }}</span>
            <h2 class="text-xl font-bold my-2">
                <a href="{{ route('article.show', ['categorySlug' => $rightArticle->category->slug, 'articleSlug' => $rightArticle->slug]) }}" class="hover:text-blue-500 no-underline">{{ $rightArticle->title }}</a>
            </h2>
            <p class="text-gray-600 text-base mb-4">{{ Str::limit(strip_tags($rightArticle->content), 100) }}</p>
            <div class="flex items-center text-gray-500 text-sm">
                <img src="{{ $rightArticle->author->avatar }}" alt="{{ $rightArticle->author->name }}" class="w-8 h-8 rounded-full mr-2" />
                <span>{{ $rightArticle->author->name }}</span>
                <span class="mx-2">|</span>
                <span>{{ $rightArticle->created_at->diffForHumans() }}</span>
            </div>
        </div>

        <!-- Swiper (Mobile Only) -->
        <div class="md:hidden mb-6 w-full">
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    <!-- Slide Left Article -->
                    <div class="swiper-slide rounded-lg overflow-hidden shadow-md">
                        <img src="{{ $leftArticle->file_path ? asset('storage/'.$leftArticle->file_path) : 'https://picsum.photos/seed/'.$leftArticle->id.'/600/400' }}" 
                            alt="{{ $leftArticle->title }}" 
                            class="w-full h-52 object-cover" />
                        <div class="p-4">
                            <span class="text-xs text-gray-400">{{ $leftArticle->created_at->format('d M Y') }} | {{ $leftArticle->category->name }}</span>
                            <h2 class="text-lg font-bold mt-2 leading-tight">
                                <a href="{{ route('article.show', ['categorySlug' => $leftArticle->category->slug, 'articleSlug' => $leftArticle->slug]) }}" class="hover:underline">
                                    {{ $leftArticle->title }}
                                </a>
                            </h2>
                            <p class="text-sm text-gray-600 mt-2 line-clamp-2">{{ Str::limit(strip_tags($leftArticle->content), 100) }}</p>
                        </div>
                    </div>

                    <!-- Slide dari $news -->
                    @foreach($news->take(4) as $article)
                    <div class="swiper-slide rounded-lg overflow-hidden shadow-md">
                        <img src="{{ $article->file_path ? asset('storage/'.$article->file_path) : 'https://picsum.photos/seed/'.$article->id.'/600/400' }}" 
                            alt="{{ $article->title }}" 
                            class="w-full h-52 object-cover" />
                        <div class="p-4">
                            <span class="text-xs text-gray-400">{{ $article->created_at->format('d M Y') }} | {{ $article->category->name }}</span>
                            <h2 class="text-lg font-bold mt-2 leading-tight">
                                <a href="{{ route('article.show', ['categorySlug' => $article->category->slug, 'articleSlug' => $article->slug]) }}" class="hover:underline">
                                    {{ $article->title }}
                                </a>
                            </h2>
                            <p class="text-sm text-gray-600 mt-2 line-clamp-2">{{ Str::limit(strip_tags($article->content), 100) }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- BOTTOM SECTION -->
    <!-- Desktop: Grid 2-4 -->
    <div class="hidden md:grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6 mt-6">
        @foreach($news as $article)
            <div class="relative overflow-hidden rounded-lg carousel-item">
                <img src="{{ $article->file_path ? asset('storage/'.$article->file_path) : 'https://picsum.photos/seed/'.$article->id.'/400/250' }}" 
                    alt="{{ $article->title }}" 
                    class="w-full aspect-square object-cover" />
                <div class="absolute bottom-0 left-0 w-full bg-black bg-opacity-50 text-white p-3 text-center">
                    <span class="block text-xs font-bold uppercase">{{ $article->category->name }}</span>
                    <h3 class="text-sm font-semibold">
                        <a href="{{ route('article.show', ['categorySlug' => $article->category->slug, 'articleSlug' => $article->slug]) }}" class="no-underline">{{ $article->title }}</a>
                    </h3>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Mobile: List -->
    <div class="grid gap-4 md:hidden mt-1">
        @foreach($news as $article)
            <div class="flex items-start gap-4 border-b pb-4">
                <img src="{{ $article->file_path ? asset('storage/'.$article->file_path) : 'https://picsum.photos/seed/'.$article->id.'/150/150' }}" 
                    alt="{{ $article->title }}" 
                    class="w-24 h-20 object-cover flex-shrink-0 rounded-md" />
                <div class="flex flex-col justify-between">
                    <div class="text-xs text-gray-400 mb-1">
                        {{ $article->created_at->format('d-M-Y | H:i') }}
                    </div>
                    <h3 class="text-sm font-semibold leading-snug mb-1 line-clamp-2">
                        <a href="{{ route('article.show', ['categorySlug' => $article->category->slug, 'articleSlug' => $article->slug]) }}" class="hover:underline">
                            {{ $article->title }}
                        </a>
                    </h3>
                    <div class="text-xs text-gray-500">{{ $article->category->name }}</div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- SwiperJS Init -->
<script>
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 1,
        spaceBetween: 16,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        loop: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
    });
</script>

<!-- Tailwind Line Clamp -->
<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
