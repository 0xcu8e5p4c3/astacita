<x-layout>
    <div class="container mx-auto mt-10 px-4 md:px-6 grid grid-cols-1 md:grid-cols-3 gap-6">
        
        <!-- Main Content -->
        <div class="md:col-span-2">
            <h2 class="text-3xl font-bold mb-6 text-gray-800">Hasil Pencarian untuk: <span class="text-blue-600">"{{ $query }}"</span></h2>

            @if($results->isEmpty())
                <div class="bg-yellow-100 text-yellow-800 p-4 rounded-lg shadow-sm">
                    Tidak ditemukan hasil yang cocok. Coba gunakan kata kunci lain.
                </div>
            @else
                <div class="space-y-6">
                    @foreach($results as $article)
                        <!-- Desktop View -->
                        <div class="hidden md:flex relative bg-white shadow-md rounded-lg overflow-hidden flex-col md:flex-row mt-5">
                            <a href="{{ route('article.show', ['categorySlug' => $article->category->slug, 'articleSlug' => $article->slug]) }}" class="w-full md:w-1/3">
                                <img src="{{ $article->thumbnail ? asset('storage/'.$article->thumbnail) : 'https://picsum.photos/seed/'.$article->id.'/400/250' }}" 
                                     alt="{{ $article->title }}" class="w-full h-48 md:h-full object-cover">
                            </a>
                            <div class="p-4 flex flex-col justify-between w-full md:w-2/3">
                                <div>
                                    <span class="text-xs font-bold uppercase text-gray-600">{{ $article->category->name ?? 'Uncategorized' }}</span>
                                    <h3 class="text-lg font-semibold mt-1">
                                        <a href="{{ route('article.show', ['categorySlug' => $article->category->slug, 'articleSlug' => $article->slug]) }}" class="hover:text-blue-500">
                                            {{ $article->title }}
                                        </a>
                                    </h3>
                                    <p class="text-sm text-gray-600 mt-2">{{ Str::limit(strip_tags($article->content), 100) }}</p>
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

                        <!-- Mobile View -->
                        <div class="flex md:hidden items-center gap-4 border-b pb-3 mb-3">
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
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="w-full md:w-80">
            <x-sidebarcard />
        </div>
    </div>
</x-layout>
