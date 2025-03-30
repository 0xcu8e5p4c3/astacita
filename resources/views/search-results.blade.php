<x-layout>
<div class="container mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-4">Search Results for "{{ $query }}"</h2>

    @if($results->isEmpty())
        <p class="text-gray-500">No results found.</p>
    @else
        <ul class="space-y-4">
            @foreach($results as $article)
                <li class="p-4 border rounded-lg hover:bg-gray-100">
                    <a href="{{ route('category.show', $article->slug) }}" class="text-lg font-semibold text-blue-600">
                        {{ $article->title }}
                    </a>
                    <p class="text-sm text-gray-500">{{ $article->created_at->format('M d, Y') }}</p>
                </li>
            @endforeach
        </ul>
    @endif
</div>
</x-layout>
