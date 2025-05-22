<div class=" p-6 font-sans">
<h1 class="text-xl font-bold mb-4">
            News
        </h1>

  <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <!-- Kiri - Berita Utama -->
    <div class="relative h-[520px] w-full rounded-xl overflow-hidden shadow-md">
      <!-- Gambar Berita Utama -->
      <img src="{{ $featuredArticle->media ? route('image.show', $featuredArticle->media->file_path) : asset('storage/default_image.jpg') }}" alt="Berita Utama"
        class="absolute inset-0 w-full h-full object-cover" />

      <!-- Overlay bagian bawah -->
      <div class="absolute bottom-0 w-full bg-gradient-to-t from-black/70 to-black/10 text-white p-5">
        <a href="{{ route('article.show', ['categorySlug' => $featuredArticle->category->slug, 'articleSlug' => $featuredArticle->slug]) }}" class="text-lg font-bold hover:text-blue-400 transition">
          {{ $featuredArticle->title }}
        </a>
        <div class="text-sm text-gray-300 flex items-center gap-2 mt-1">
          <span class="text-purple-300 font-bold">Astacita.co</span>
          |
          <span class="text-white font-semibold">{{ $featuredArticle->author->name ?? 'Anonim' }}</span>
          |
          <span class="text-white">{{ $featuredArticle->created_at->diffForHumans() }}</span>
        </div>
      </div>
    </div>

    <!-- Tengah - Trending -->
    <div>
      <div class="bg-white rounded-xl shadow p-4 h-[520px] flex flex-col">
        <h3 class="font-semibold text-lg mb-2 border-b pb-2">🔹 Trending di Crypto</h3>
        <div class="overflow-y-auto flex-1 space-y-4 pr-2">
          @foreach ($trendingArticles as $article)
            <div class="flex gap-3">
              <div class="flex-1">
                <a href="{{ route('article.show', ['categorySlug' => $article->category->slug, 'articleSlug' => $article->slug]) }}" class="font-semibold text-sm hover:text-blue-500 transition">
                  {{ $article->title }}
                </a>
                <div class="text-xs text-gray-500 mt-1">Astacita.co ✔ | {{ $article->views_count }} Views | {{ $article->created_at->diffForHumans() }}</div>
              </div>
              <img src="{{ $article->media ? route('image.show', $article->media->file_path) : asset('storage/default_image.jpg') }}" class="w-16 h-16 rounded object-cover" />
            </div>
          @endforeach
        </div>
      </div>
    </div>

    <!-- Kanan - Terbaru -->
    <div>
      <div class="bg-white rounded-xl shadow p-4 h-[520px] flex flex-col">
        <h3 class="font-semibold text-lg mb-2 border-b pb-2">🔹 Terbaru di News</h3>
        <div class="overflow-y-auto flex-1 space-y-4 pr-2">
          @foreach ($latestArticles as $article)
            <div class="flex gap-3">
              <div class="flex-1">
                <a href="{{ route('article.show', ['categorySlug' => $article->category->slug, 'articleSlug' => $article->slug]) }}" class="font-semibold text-sm hover:text-blue-500 transition">
                  {{ $article->title }}
                </a>
                <div class="text-xs text-gray-500 mt-1">Astacita.co ✔ | {{ $article->views_count }} Views | {{ $article->created_at->diffForHumans() }}</div>
              </div>
              <img src="{{ $article->media ? route('image.show', $article->media->file_path) : asset('storage/default_image.jpg') }}" class="w-16 h-16 rounded object-cover" />
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
