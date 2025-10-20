<div class="max-w-7xl mx-auto">
    <!-- Hero Section - Desktop -->
    <div class="hidden lg:grid lg:grid-cols-3 gap-6 mb-6">
        <!-- Main Featured Article (2 cols) -->
        <div class="lg:col-span-2">
            <div class="relative group overflow-hidden rounded-2xl bg-gray-100 h-[480px]">
                <img src="{{ $leftArticle->media ? route('image.show', $leftArticle->media->file_path) : asset('storage/default_image.jpg') }}" 
                    alt="{{ $leftArticle->title }}" 
                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" />
                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/30 to-transparent"></div>
                <div class="absolute bottom-0 left-0 right-0 p-8">
                    <span class="text-xs font-semibold text-gray-400">
                        {{ $leftArticle->category->name }}
                    </span>
                    <h2 class="text-white text-3xl font-bold mb-3 line-clamp-2 leading-tight">
                        <a href="{{ route('article.show', ['categorySlug' => $leftArticle->category->slug, 'articleSlug' => $leftArticle->slug]) }}" 
                           class="hover:text-gray-300 transition-colors">
                            {{ $leftArticle->title }}
                        </a>
                    </h2>
                    <p class="text-gray-300 text-base line-clamp-2 leading-relaxed">{{ Str::limit(strip_tags($leftArticle->content), 140) }}</p>
                </div>
            </div>
        </div>

        <!-- Side Featured Article (1 col) -->
        <div class="space-y-6">
            <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden h-[480px] flex flex-col hover:border-gray-300 transition-colors">
                <div class="relative overflow-hidden flex-shrink-0">
                    <img src="{{ $rightArticle->media ? route('image.show', $rightArticle->media->file_path) : asset('storage/default_image.jpg') }}" 
                        alt="{{ $rightArticle->title }}" 
                        class="w-full h-56 object-cover transition-transform duration-700 hover:scale-105" />
                </div>
                <div class="p-6 flex-1 flex flex-col">
                    <span class="text-xs font-semibold text-gray-400">
                        {{ $rightArticle->category->name }}
                    </span>
                    <h3 class="text-xl font-bold mb-3 line-clamp-3 flex-1 leading-snug">
                        <a href="{{ route('article.show', ['categorySlug' => $rightArticle->category->slug, 'articleSlug' => $rightArticle->slug]) }}" 
                           class="hover:text-gray-600 transition-colors">
                            {{ $rightArticle->title }}
                        </a>
                    </h3>
                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ Str::limit(strip_tags($rightArticle->content), 100) }}</p>
                    <div class="flex items-center text-gray-400 text-xs mt-auto pt-4 border-t border-gray-100">
                        <img src="{{ $rightArticle->author->avatar }}" alt="{{ $rightArticle->author->name }}" 
                             class="w-7 h-7 rounded-full mr-2.5 border border-gray-200" />
                        <span class="font-medium text-gray-600">{{ $rightArticle->author->name }}</span>
                        <span class="mx-2">•</span>
                        <span>{{ $rightArticle->created_at->diffForHumans() }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Slider -->
    <div class="lg:hidden mb-8">
        <div class="swiper mySwiper rounded-xl overflow-hidden border border-gray-200">
            <div class="swiper-wrapper">
                <!-- Left Article Slide -->
                <div class="swiper-slide">
                    <div class="relative h-72 bg-gray-100">
                        <img src="{{ $leftArticle->media ? route('image.show', $leftArticle->media->file_path) : asset('storage/default_image.jpg') }}" 
                            alt="{{ $leftArticle->title }}" 
                            class="w-full h-full object-cover" />
                        <div class="absolute inset-0 bg-gradient-to-t from-black/85 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-5">
                            <span class="inline-block text-xs font-bold tracking-wider uppercase mb-2 text-gray-300">
                                {{ $leftArticle->category->name }}
                            </span>
                            <h2 class="text-white text-lg font-bold line-clamp-2 leading-snug">
                                <a href="{{ route('article.show', ['categorySlug' => $leftArticle->category->slug, 'articleSlug' => $leftArticle->slug]) }}">
                                    {{ $leftArticle->title }}
                                </a>
                            </h2>
                        </div>
                    </div>
                </div>

                <!-- Right Article Slide -->
                <div class="swiper-slide">
                    <div class="relative h-72 bg-gray-100">
                        <img src="{{ $rightArticle->media ? route('image.show', $rightArticle->media->file_path) : asset('storage/default_image.jpg') }}" 
                            alt="{{ $rightArticle->title }}" 
                            class="w-full h-full object-cover" />
                        <div class="absolute inset-0 bg-gradient-to-t from-black/85 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-5">
                            <span class="inline-block text-xs font-bold tracking-wider uppercase mb-2 text-gray-300">
                                {{ $rightArticle->category->name }}
                            </span>
                            <h2 class="text-white text-lg font-bold line-clamp-2 leading-snug">
                                <a href="{{ route('article.show', ['categorySlug' => $rightArticle->category->slug, 'articleSlug' => $rightArticle->slug]) }}">
                                    {{ $rightArticle->title }}
                                </a>
                            </h2>
                        </div>
                    </div>
                </div>

                <!-- News Articles Slides -->
                @foreach($news->take(3) as $article)
                <div class="swiper-slide">
                    <div class="relative h-72 bg-gray-100">
                        <img src="{{ $article->media ? route('image.show', $article->media->file_path) : asset('storage/default_image.jpg') }}" 
                            alt="{{ $article->title }}" 
                            class="w-full h-full object-cover" />
                        <div class="absolute inset-0 bg-gradient-to-t from-black/85 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-5">
                            <span class="inline-block text-xs font-bold tracking-wider uppercase mb-2 text-gray-300">
                                {{ $article->category->name }}
                            </span>
                            <h2 class="text-white text-lg font-bold line-clamp-2 leading-snug">
                                <a href="{{ route('article.show', ['categorySlug' => $article->category->slug, 'articleSlug' => $article->slug]) }}">
                                    {{ $article->title }}
                                </a>
                            </h2>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>

    <!-- News Grid - Desktop Only -->
    <div class="hidden lg:grid grid-cols-4 gap-8">
        @foreach($news as $article)
        <div class="group">
            <div class="bg-white border border-gray-200 rounded-xl overflow-hidden transition-all duration-300 hover:border-gray-300 hover:-translate-y-1">
                <div class="relative overflow-hidden bg-gray-100">
                    <img src="{{ $article->media ? route('image.show', $article->media->file_path) : asset('storage/default_image.jpg') }}" 
                        alt="{{ $article->title }}" 
                        class="w-full h-48 object-cover transition-transform duration-700 group-hover:scale-110" />
                </div>
                <div class="p-5">
                    <span class="text-xs font-semibold text-gray-400">
                        {{ $article->category->name }}
                    </span>
                    <h3 class="text-base font-bold line-clamp-2 mb-3 leading-snug">
                        <a href="{{ route('article.show', ['categorySlug' => $article->category->slug, 'articleSlug' => $article->slug]) }}" 
                           class="hover:text-gray-600 transition-colors">
                            {{ $article->title }}
                        </a>
                    </h3>
                    <p class="text-gray-400 text-xs font-medium">{{ $article->created_at->format('d M Y') }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- News List - Mobile Only -->
    <div class="lg:hidden space-y-3">
        @foreach($news as $article)
        <div class="bg-white border border-gray-200 rounded-lg overflow-hidden hover:border-gray-300 transition-colors">
            <div class="flex gap-4 p-4">
                <div class="flex-shrink-0">
                    <div class="w-24 h-24 bg-gray-100 rounded-lg overflow-hidden">
                        <img src="{{ $article->media ? route('image.show', $article->media->file_path) : asset('storage/default_image.jpg') }}" 
                            alt="{{ $article->title }}" 
                            class="w-full h-full object-cover" />
                    </div>
                </div>
                <div class="flex-1 flex flex-col justify-between min-w-0">
                    <div>
                        <span class="inline-block text-xs font-bold tracking-wider uppercase mb-2 text-gray-400">
                            {{ $article->category->name }}
                        </span>
                        <h3 class="text-sm font-bold line-clamp-2 leading-snug">
                            <a href="{{ route('article.show', ['categorySlug' => $article->category->slug, 'articleSlug' => $article->slug]) }}" 
                               class="hover:text-gray-600 transition-colors">
                                {{ $article->title }}
                            </a>
                        </h3>
                    </div>
                    <p class="text-gray-400 text-xs font-medium mt-2">{{ $article->created_at->format('d M Y • H:i') }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Swiper JS Initialization -->
<script>
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 1,
        spaceBetween: 0,
        loop: true,
        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
    });
</script>

<!-- Custom Styles -->
<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .swiper-pagination-bullet {
        background: white;
        opacity: 0.6;
        width: 8px;
        height: 8px;
    }
    
    .swiper-pagination-bullet-active {
        opacity: 1;
        background: white;
    }
</style>