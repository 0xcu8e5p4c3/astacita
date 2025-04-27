<div class="flex items-start space-x-3 p-2 md:p-4 bg-white rounded-lg shadow-md md:flex-row">
    <img src="{{ $article->thumbnail ? asset('storage/'.$article->thumbnail) : 'https://picsum.photos/seed/'.$article->id.'/800/450' }}"
         class="w-20 h-20 object-cover rounded-md flex-shrink-0 md:w-24 md:h-24"
         alt="{{ $article->title }}">

    <div class="flex-1">
        <!-- Mobile: Tanggal -->
        <p class="text-xs text-gray-500 mb-1">
            {{ $article->created_at->format('d-M-Y') }} | {{ $article->created_at->format('H:i') }}
        </p>

        <!-- Judul -->
        <h2 class="font-semibold text-sm md:text-lg text-gray-900 leading-tight">
            <a href="{{ route('article.show', ['categorySlug' => optional($article->category)->slug ?? 'unknown', 'articleSlug' => $article->slug]) }}"
               class="hover:text-blue-600 transition duration-200 block">
                {{ Str::limit($article->title, 60) }}
            </a>
        </h2>

        <!-- Mobile: Nama kategori -->
        <p class="text-xs text-gray-500 mt-1">
            {{ strtoupper(optional($article->category)->name ?? 'Unknown') }}
        </p>

        <!-- Desktop tambahan konten -->
        <p class="hidden md:block text-gray-600 mt-2 text-sm">
            {{ Str::limit(strip_tags($article->content), 100) }}
        </p>

        <!-- Desktop: Author dan Views -->
        <div class="hidden md:flex items-center text-gray-500 text-sm mt-2">
            <img src="{{ optional($article->author)->avatar ?? 'https://placehold.co/20x20' }}"
                 class="w-5 h-5 rounded-full" alt="{{ optional($article->author)->name ?? 'Author' }}">
            <span class="ml-2">{{ optional($article->author)->name ?? 'Unknown' }}</span>
            <span class="mx-1">|</span>
            <span>{{ $article->created_at->diffForHumans() }}</span>
            <span class="mx-1">|</span>
            <span><i class="fas fa-eye"></i> {{ $article->views_count }} Views</span>
        </div>
    </div>
</div>
