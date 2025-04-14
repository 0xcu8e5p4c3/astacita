<h1 class="text-xl font-bold mb-4">
            Discover
        </h1>
        <div class="flex flex-col md:flex-row space-y-6 md:space-y-0 md:space-x-12">
    <div class="flex-1 space-y-6">
        @foreach ($articles as $article)
            <div class="bg-white p-4 rounded-lg shadow-md">
                <div class="flex space-x-4">
                <img src="{{ $article->thumbnail ? asset('storage/'.$article->thumbnail) : 'https://picsum.photos/seed/'.$article->id.'/800/450' }}"
                  class="w-24 h-24 rounded-lg object-cover mt-0 self-center"
                  alt="{{ $article->title }}">
                    <div>
                    <p class="text-sm font-medium text-indigo-600">
                <span class="bg-white shadow-md text-xs font-bold px-3 py-1 rounded">{{ strtoupper($article->category->name) }}</span>
              </p>
                        <h2 class="text-lg font-semibold mt-2">
                            <a href="{{ route('article.show', ['categorySlug' => $article->category->slug, 'articleSlug' => $article->slug]) }}"
                               class="text-gray-900 hover:text-blue-600 transition duration-200">
                                {{ Str::limit($article->title, 60) }}
                            </a>
                        </h2>
                        <p class="text-gray-600 mt-1">
                            {{ Str::limit(strip_tags($article->content), 100) }}
                        </p>
                        <div class="flex items-center text-gray-500 text-sm mt-2">
                            <img src="{{ $article->author->avatar ?? 'https://placehold.co/20x20' }}"
                                 class="w-5 h-5 rounded-full" alt="{{ $article->author->name ?? 'Author' }}">
                            <span class="ml-2">{{ $article->author->name ?? 'Unknown' }}</span>
                            <span class="mx-1">|</span>
                            <span>{{ $article->created_at->diffForHumans() }}</span>
                            <span class="mx-1">|</span>
                            <span><i class="fas fa-eye"></i> {{ $article->views_count }} Views</span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="w-full md:w-80">
        <x-sidebarcard />
    </div>
</div>
