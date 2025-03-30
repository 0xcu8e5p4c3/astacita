@foreach($articles as $article)
<div class="bg-white rounded-xl shadow-md overflow-hidden transition-all duration-300 hover:shadow-lg group">
    <div class="md:flex">
        <div class="md:shrink-0">
            <img class="h-48 w-full object-cover md:h-full md:w-48 transition-all duration-300 group-hover:scale-105" 
                 src="{{ asset('storage/'.$article->covers) }}" alt="{{ $article->title }}">
        </div>
        <div class="p-6">
            <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">
                {{ $article->category->name }}
            </div>
            <a href="{{ route('category.show', $article->slug) }}" class="block mt-1 text-lg leading-tight font-medium text-black relative group">
                {{ $article->title }}
                <span class="absolute left-0 bottom-0 w-0 h-[2px] bg-indigo-500 transition-all duration-300 group-hover:w-full"></span>
            </a>
            <p class="mt-2 text-slate-500">
                {{ Str::limit(strip_tags($article->content), 100) }}
            </p>
        </div>
    </div>
</div>
@endforeach
