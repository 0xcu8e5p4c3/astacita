<div class="relative lg:pt-3 lg:pb-6">
  <div class="absolute inset-0">
    <div class="h-1/3 bg-white sm:h-2/3"></div>
  </div>
  <div class="relative mx-auto max-w-7xl">
    <div class="container mx-auto px-4">
    <h1 class="text-xl font-bold mb-4">
            Most Viewed
        </h1>
      <div class="mx-auto grid max-w-lg gap-5 lg:max-w-none lg:grid-cols-3">
        @foreach ($news as $item)
        <div class="flex flex-col overflow-hidden rounded-lg shadow-lg">
          <div class="flex-shrink-0">
            <img class="h-48 w-full object-cover" src="{{ $item->thumbnail ? asset('storage/'.$item->thumbnail) : 'https://picsum.photos/seed/'.$item->id.'/800/450' }}" alt="{{ $item->title }}">
          </div>
          <div class="flex flex-1 flex-col justify-between bg-white p-6">
            <div class="flex-1">
              <p class="text-sm font-medium text-indigo-600">
                <span class="bg-white shadow-md text-xs font-bold px-3 py-1 rounded">{{ $item->category->name ?? 'News' }}</span>
              </p>
              <a href="{{ route('article.show', ['categorySlug' => $item->category->slug, 'articleSlug' => $item->slug]) }}" class="mt-2 block">
                <p class="text-xl font-semibold text-gray-900 hover:text-blue-600 transition duration-300">
                  {{ $item->title }}
                </p>
                <p class="mt-3 text-base text-gray-500">
                  {{ Str::limit(strip_tags($item->content), 120) }}
                </p>
              </a>
            </div>
            <div class="mt-6 flex items-center">
              <div class="flex-shrink-0">
                <img class="h-10 w-10 rounded-full" src="{{ $item->author->profile_photo ?? 'https://ui-avatars.com/api/?name=' . urlencode($item->author->name) }}" alt="{{ $item->author->name }}">
              </div>
              <div class="ml-3">
                <p class="text-sm font-medium text-gray-900">
                  <a href="#" class="hover:underline">{{ $item->author->name }}</a>
                </p>
                <div class="flex space-x-1 text-sm text-gray-500">
                  <time datetime="{{ $item->created_at->toDateString() }}">{{ $item->created_at->format('M d, Y') }}</time>
                  <span aria-hidden="true">·</span>
                  <span>{{ rand(4, 12) }} min read</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
