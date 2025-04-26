<script src="{{ asset('js/loadmore2.js') }}"></script>
<h1 class="text-xl font-bold mb-4">
    Discover
</h1>

<div class="flex flex-col md:flex-row space-y-6 md:space-y-0 md:space-x-12">
    <div id="article-container" class="flex-1 space-y-6">
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

<div class="fter:h-px my-14 flex items-center before:h-px before:flex-1 before:bg-gray-300 before:content-[''] after:h-px after:flex-1 after:bg-gray-300 after:content-['']">
    <button id="load-more" 
            type="button"
            data-url="{{ route('articles.loadmore') }}"
            data-page="2"
            class="flex items-center rounded-full border border-gray-300 bg-secondary-50 px-3 py-2 text-center text-sm font-medium text-gray-900 hover:bg-gray-100">
        
        <!-- ICON (tetap ada) -->
        <svg xmlns="http://www.w3.org/2000/svg" 
             viewBox="0 0 20 20" 
             fill="currentColor" 
             class="mr-1 h-4 w-4">
            <path fill-rule="evenodd" 
                  d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" 
                  clip-rule="evenodd" /> 
        </svg>

        <!-- TEXT (bisa berubah tanpa ganggu SVG) -->
        <span id="load-more-text">View More</span>
    </button>
</div>


