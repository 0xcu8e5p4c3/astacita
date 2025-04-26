<div class="flex items-center gap-4 border-b pb-3 mb-3">
    <!-- Gambar Thumbnail -->
    <a href="{{ route('article.show', ['categorySlug' => $article->category->slug, 'articleSlug' => $article->slug]) }}" class="w-24 flex-shrink-0">
        <img src="{{ $article->thumbnail ? asset('storage/'.$article->thumbnail) : 'https://picsum.photos/seed/'.$article->id.'/400/250' }}" 
             alt="{{ $article->title }}" 
             class="w-24 h-16 object-cover rounded-md">
    </a>

    <!-- Konten -->
    <div class="flex-1">
        <span class="text-xs font-semibold uppercase text-gray-500">
            {{ $article->category->name ?? 'Uncategorized' }}
        </span>
        <h3 class="text-sm font-bold leading-snug mt-1">
            <a href="{{ route('article.show', ['categorySlug' => $article->category->slug, 'articleSlug' => $article->slug]) }}" 
               class="hover:text-blue-500">
                {{ Str::limit($article->title, 50) }}
            </a>
        </h3>
    </div>
</div>
