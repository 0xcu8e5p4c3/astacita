<div class="max-w-7xl mx-auto py-6">
    <div class="grid grid-cols-1 md:grid-cols-[2fr_1fr] gap-6">
        <!-- Left Image Section -->
        <div class="relative overflow-hidden rounded-lg carousel-item">
            <img src="{{ $leftArticle->thumbnail ? asset('storage/'.$leftArticle->thumbnail) : 'https://picsum.photos/seed/'.$leftArticle->id.'/400/250' }}" 
                alt="{{ $leftArticle->title }}" 
                class="w-full aspect-[16/9] object-cover" />
            <div class="absolute bottom-0 left-0 w-full bg-black bg-opacity-50 text-white p-4 text-center">
                <span class="block text-xs font-bold uppercase">{{ $leftArticle->category->name }}</span>
                <h3 class="text-lg font-semibold">
                    <a href="{{ route('article.show', ['categorySlug' => $leftArticle->category->slug, 'articleSlug' => $leftArticle->slug]) }}" class="no-underline">{{ $featured->title }}</a>
                </h3>
                <p class="text-sm">{{ Str::limit($leftArticle->content, 100) }}</p>
            </div>
        </div>

        <!-- Right Text Section -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <img src="{{ $rightArticle->thumbnail ? asset('storage/'.$rightArticle->thumbnail) : 'https://picsum.photos/seed/'.$rightArticle->id.'/400/250' }}" 
                alt="{{ $rightArticle->title }}" 
                class="w-full aspect-[16/9] object-cover rounded-lg mb-4" />
            <span class="bg-white shadow-md text-xs font-bold px-3 py-1 rounded">{{ $rightArticle->category->name }}</span>
            <h2 class="text-xl font-bold my-2">
                <a href="{{ route('article.show', ['categorySlug' => $rightArticle->category->slug, 'articleSlug' => $rightArticle->slug]) }}" class="hover:text-blue-500 no-underline">{{ $featured->title }}</a>
            </h2>
            <p class="text-gray-600 text-base mb-4">{{ Str::limit(strip_tags($featured->content), 100) }}</p>
            <div class="flex items-center text-gray-500 text-sm">
                <img src="{{ $rightArticle->author->avatar }}" alt="{{ $rightArticle->author->name }}" class="w-8 h-8 rounded-full mr-2" />
                <span>{{ $rightArticle->author->name }}</span>
                <span class="mx-2">|</span>
                <span>{{ $rightArticle->created_at->format('d M Y') }}</span>
            </div>
        </div>
    </div>

    <!-- Bottom Section -->
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6 mt-6">
        @foreach($news as $article)
            <div class="relative overflow-hidden rounded-lg carousel-item">
                <img src="{{ $article->thumbnail ? asset('storage/'.$article->thumbnail) : 'https://picsum.photos/seed/'.$article->id.'/400/250' }}" 
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
</div>
