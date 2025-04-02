<link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ asset('css/carouselitem.css') }}">

<div class="bg-white">
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-bold mb-4">Trending</h1>
        <div class="carousel carousel-end rounded-box">
        @foreach ($hometrend as $article)
            <a href="{{ route('article.show', ['categorySlug' => $article->category->slug, 'articleSlug' => $article->slug]) }}" class="carousel-item relative">
                <img src="{{ $article->media->file_path ?? asset('storage/default.jpg') }}" 
                    alt="{{ $article->title }}" 
                    class="w-full h-40 object-cover" />

                <div class="absolute bottom-0 left-0 w-full bg-black bg-opacity-50 text-white p-4 text-center">
                    <span class="block text-xs font-bold uppercase">
                        {{ $article->category->name ?? 'Uncategorized' }}
                    </span>
                    <h3 class="text-lg font-semibold">{{ $article->title }}</h3>
                    <p class="text-sm">{{ Str::limit($article->summary, 100) }}</p>
                </div>
            </a>
        @endforeach

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
