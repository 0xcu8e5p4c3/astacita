<script src="{{ asset('js/loadmore2.js') }}"></script>

<h1 class="text-xl font-bold mb-4">
    Discover
</h1>

<div class="flex flex-col md:flex-row space-y-6 md:space-y-0 md:space-x-12">
    <!-- Artikel -->
    <div id="article-container" class="flex-1 space-y-4 md:space-y-6">
        @foreach ($articles as $article)
            <div class="flex items-start space-x-3 p-2 md:p-4 bg-white rounded-lg shadow-md md:flex-row">
                <img src="{{ $article->media ? route('image.show', $article->media->file_path) : asset('storage/default_image.jpg') }}"
                     alt="{{ $article->title }}"
                     class="w-20 h-20 object-cover rounded-md flex-shrink-0 md:w-24 md:h-24">

                <div class="flex-1">
                    <!-- Mobile: Tanggal -->
                    <p class="text-xs text-gray-500 mb-1">
                        {{ $article->created_at->format('d-M-Y') }} | {{ $article->created_at->format('H:i') }}
                    </p>

                    <!-- Judul -->
                    <h2 class="font-semibold text-sm md:text-lg text-gray-900 leading-tight">
                        <a href="{{ route('article.show', ['categorySlug' => $article->category->slug, 'articleSlug' => $article->slug]) }}"
                           class="hover:text-blue-600 transition duration-200 block">
                            {{ Str::limit($article->title, 60) }}
                        </a>
                    </h2>

                    <!-- Mobile: Nama kategori -->
                    <p class="text-xs text-gray-500 mt-1">
                        {{ $article->category->name }}
                    </p>

                    <!-- Desktop tambahan konten -->
                    <p class="hidden md:block text-gray-600 mt-2 text-sm">
                        {{ Str::limit(strip_tags($article->content), 100) }}
                    </p>

                    <!-- Desktop: Author dan Views -->
                    <div class="hidden md:flex items-center text-gray-500 text-sm mt-2">
                        <img src="{{ $article->author->avatar ?? 'https://placehold.co/20x20' }}" class="w-5 h-5 rounded-full" alt="{{ $article->author->name ?? 'Author' }}">
                        <span class="ml-2">{{ $article->author->name ?? 'Unknown' }}</span>
                        <span class="mx-1">|</span>
                        <span>{{ $article->created_at->diffForHumans() }}</span>
                        <span class="mx-1">|</span>
                        <span><i class="fas fa-eye"></i> {{ $article->views_count }} Views</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Sidebar disembunyikan di mobile -->
    <div class="hidden md:block w-full md:w-80">
        <x-sidebarcard />
    </div>
</div>

<div class="fter:h-px my-4 flex items-center before:h-px before:flex-1 before:bg-gray-300 before:content-[''] after:h-px after:flex-1 after:bg-gray-300 after:content-['']">
    <button id="load-more" 
            type="button"
            data-url="{{ route('articles.loadmore') }}"
            data-page="2"
            class="flex items-center rounded-full border border-gray-300 bg-secondary-50 px-3 py-2 text-center text-sm font-medium text-gray-900 hover:bg-gray-100">
        
        <!-- ICON -->
        <svg xmlns="http://www.w3.org/2000/svg" 
             viewBox="0 0 20 20" 
             fill="currentColor" 
             class="mr-1 h-4 w-4">
            <path fill-rule="evenodd" 
                  d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" 
                  clip-rule="evenodd" /> 
        </svg>

        <!-- TEXT -->
        <span id="load-more-text">View More</span>
    </button>
</div>
