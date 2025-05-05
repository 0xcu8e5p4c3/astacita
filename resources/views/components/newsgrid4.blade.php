<!-- SwiperJS -->
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<div class="relative lg:pt-3 lg:pb-6">
  <div class="absolute inset-0">
    <div class="h-1/3 bg-white sm:h-2/3"></div>
  </div>
  <div class="relative mx-auto max-w-7xl">
    <div class="container mx-auto px-4">
      <h1 class="text-xl font-bold mb-4">
        Most Viewed
      </h1>

      <!-- Desktop: Grid 3 -->
      <div class="hidden md:grid mx-auto grid max-w-lg gap-5 lg:max-w-none lg:grid-cols-3">
        @foreach ($news as $item)
        <div class="flex flex-col overflow-hidden rounded-lg shadow-md bg-white">
          <div class="flex-shrink-0">
            <img class="h-48 w-full object-cover" src="{{ $item->thumbnail ? asset('storage/'.$item->thumbnail) : 'https://picsum.photos/seed/'.$item->id.'/800/450' }}" alt="{{ $item->title }}">
          </div>
          <div class="flex flex-1 flex-col justify-between p-4">
            <div class="flex-1">
              <span class="text-xs font-semibold text-indigo-600">{{ $item->category->name ?? 'News' }}</span>
              <a href="{{ route('article.show', ['categorySlug' => $item->category->slug, 'articleSlug' => $item->slug]) }}" class="mt-2 block">
                <p class="text-lg font-bold text-gray-900 hover:text-blue-600 transition duration-300">
                  {{ $item->title }}
                </p>
                <p class="mt-2 text-sm text-gray-500">
                  {{ Str::limit(strip_tags($item->content), 100) }}
                </p>
              </a>
            </div>
            <div class="mt-4 flex items-center">
              <img class="h-8 w-8 rounded-full" src="{{ $item->author->profile_photo ?? 'https://ui-avatars.com/api/?name=' . urlencode($item->author->name) }}" alt="{{ $item->author->name }}">
              <div class="ml-3">
                <p class="text-xs font-semibold text-gray-900">{{ $item->author->name }}</p>
                <p class="text-xs text-gray-500">{{ $item->created_at->diffForHumans() }}</p>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>

      <!-- Mobile: Swiper -->
      <div class="md:hidden">
        <div class="swiper mySwiper">
          <div class="swiper-wrapper">
            @foreach ($news as $item)
            <div class="swiper-slide">
              <div class="bg-white rounded-lg overflow-hidden shadow-md">
                <img class="h-52 w-full object-cover" src="{{ $item->thumbnail ? asset('storage/'.$item->thumbnail) : 'https://picsum.photos/seed/'.$item->id.'/800/450' }}" alt="{{ $item->title }}">
                <div class="p-4">
                  <span class="text-xs text-gray-500">{{ $item->category->name ?? 'News' }}</span>
                  <h2 class="text-lg font-bold text-gray-800 mt-2">
                    <a href="{{ route('article.show', ['categorySlug' => $item->category->slug, 'articleSlug' => $item->slug]) }}" class="hover:underline">
                      {{ $item->title }}
                    </a>
                  </h2>
                  <p class="text-sm text-gray-600 mt-2 line-clamp-2">
                    {{ Str::limit(strip_tags($item->content), 80) }}
                  </p>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<script>
  var swiper = new Swiper(".mySwiper", {
    slidesPerView: 1,
    spaceBetween: 16,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    loop: true,
    autoplay: {
      delay: 3000,
      disableOnInteraction: false,
    },
  });
</script>

<!-- Line Clamp Style -->
<style>
  .line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }
</style>
