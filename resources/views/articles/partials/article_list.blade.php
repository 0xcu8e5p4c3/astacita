<div class="relative bg-white shadow-md rounded-lg overflow-hidden flex flex-col md:flex-row mb-2">
    <a href="{{ route('article.show', ['categorySlug' => $article->category->slug, 'articleSlug' => $article->slug]) }}" class="w-full md:w-1/3">
        <img src="{{ $article->thumbnail ? asset('storage/'.$article->thumbnail) : 'https://picsum.photos/seed/'.$article->id.'/400/250' }}" 
            alt="{{ $article->title }}" class="w-full h-48 md:h-full object-cover rounded-l-lg md:rounded-l-lg">
    </a>
    <div class="p-4 w-full md:w-2/3 flex flex-col justify-between">
        <div>
            <span class="text-xs font-bold uppercase text-gray-600">
                {{ $article->category->name ?? 'Uncategorized' }}
            </span>
            <h3 class="text-lg font-semibold mt-1">
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
