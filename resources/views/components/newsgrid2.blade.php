<div class="container">
    @if(($type == 'all' || $type == 'youtube') && (isset($videos['youtube']) || ($type == 'youtube' && !empty($videos))))
    
    <!-- YouTube Section -->
    <div class="mb-6">
        <h1 class="text-xl font-bold mb-4">YouTube Video</h1>
        
        <!-- Desktop View (md and up) -->
        <div class="hidden md:block relative group">
            <div class="flex gap-10 overflow-x-auto scrollbar-hide scroll-smooth pb-4" id="desktop-slider">
                @if($type == 'all')
                    @foreach($videos['youtube'] as $video)
                        <div class="min-w-[360px] flex-shrink-0">
                            <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300 overflow-hidden">
                                <div class="relative w-full aspect-video bg-gray-100">
                                    @php $youtubeId = $getYouTubeId($video->url); @endphp
                                    @if($youtubeId)
                                        <iframe 
                                            class="absolute inset-0 w-full h-full"
                                            src="https://www.youtube.com/embed/{{ $youtubeId }}" 
                                            frameborder="0" 
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                            allowfullscreen>
                                        </iframe>
                                    @else
                                        <div class="absolute inset-0 flex items-center justify-center text-gray-500">
                                            <p>Invalid YouTube URL</p>
                                        </div>
                                    @endif
                                </div>
                                <div class="p-4">
                                    <h3 class="font-semibold text-gray-800 mb-2 line-clamp-2">{{ $video->title }}</h3>
                                    <p class="text-sm text-gray-600">{{ number_format($video->views_count ?? 0) }} x ditonton</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    @foreach($videos as $video)
                        <div class="min-w-[360px] flex-shrink-0">
                            <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300 overflow-hidden">
                                <div class="relative w-full aspect-video bg-gray-100">
                                    @php $youtubeId = $getYouTubeId($video->url); @endphp
                                    @if($youtubeId)
                                        <iframe 
                                            class="absolute inset-0 w-full h-full"
                                            src="https://www.youtube.com/embed/{{ $youtubeId }}" 
                                            frameborder="0" 
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                            allowfullscreen>
                                        </iframe>
                                    @else
                                        <div class="absolute inset-0 flex items-center justify-center text-gray-500">
                                            <p>Invalid YouTube URL</p>
                                        </div>
                                    @endif
                                </div>
                                <div class="p-4">
                                    <h3 class="font-semibold text-gray-800 mb-2 line-clamp-2">{{ $video->title }}</h3>
                                    <p class="text-sm text-gray-600">{{ number_format($video->views_count ?? 0) }} x ditonton</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            
            <!-- Navigation Buttons Desktop -->
            <button onclick="slideDesktop('left')" class="hidden group-hover:flex absolute left-0 top-1/2 -translate-y-1/2 -translate-x-4 bg-white rounded-full p-3 shadow-lg hover:bg-gray-100 transition-all z-10 items-center justify-center">
                <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>
            <button onclick="slideDesktop('right')" class="hidden group-hover:flex absolute right-0 top-1/2 -translate-y-1/2 translate-x-4 bg-white rounded-full p-3 shadow-lg hover:bg-gray-100 transition-all z-10 items-center justify-center">
                <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>
        </div>

        <!-- Mobile View (below md) -->
        <div class="md:hidden relative group">
            <div class="flex gap-4 overflow-x-auto scrollbar-hide scroll-smooth snap-x snap-mandatory pb-4" id="mobile-slider">
                @if($type == 'all')
                    @foreach($videos['youtube'] as $video)
                        <div class="min-w-[85%] flex-shrink-0 snap-center">
                            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                                <div class="relative w-full aspect-video bg-gray-100">
                                    @php $youtubeId = $getYouTubeId($video->url); @endphp
                                    @if($youtubeId)
                                        <iframe 
                                            class="absolute inset-0 w-full h-full"
                                            src="https://www.youtube.com/embed/{{ $youtubeId }}" 
                                            frameborder="0" 
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                            allowfullscreen>
                                        </iframe>
                                    @else
                                        <div class="absolute inset-0 flex items-center justify-center text-gray-500 text-sm">
                                            <p>Invalid YouTube URL</p>
                                        </div>
                                    @endif
                                </div>
                                <div class="p-3">
                                    <h3 class="font-semibold text-gray-800 text-sm mb-1 line-clamp-2">{{ $video->title }}</h3>
                                    <p class="text-xs text-gray-600">{{ number_format($video->views_count ?? 0) }} x ditonton</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    @foreach($videos as $video)
                        <div class="min-w-[85%] flex-shrink-0 snap-center">
                            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                                <div class="relative w-full aspect-video bg-gray-100">
                                    @php $youtubeId = $getYouTubeId($video->url); @endphp
                                    @if($youtubeId)
                                        <iframe 
                                            class="absolute inset-0 w-full h-full"
                                            src="https://www.youtube.com/embed/{{ $youtubeId }}" 
                                            frameborder="0" 
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                            allowfullscreen>
                                        </iframe>
                                    @else
                                        <div class="absolute inset-0 flex items-center justify-center text-gray-500 text-sm">
                                            <p>Invalid YouTube URL</p>
                                        </div>
                                    @endif
                                </div>
                                <div class="p-3">
                                    <h3 class="font-semibold text-gray-800 text-sm mb-1 line-clamp-2">{{ $video->title }}</h3>
                                    <p class="text-xs text-gray-600">{{ number_format($video->views_count ?? 0) }} x ditonton</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            
            <!-- Navigation Buttons Mobile -->
            <button onclick="slideMobile('left')" class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-2 bg-white rounded-full p-2 shadow-lg hover:bg-gray-100 transition-all z-10 flex items-center justify-center">
                <svg class="w-5 h-5 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>
            <button onclick="slideMobile('right')" class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-2 bg-white rounded-full p-2 shadow-lg hover:bg-gray-100 transition-all z-10 flex items-center justify-center">
                <svg class="w-5 h-5 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>
        </div>
    </div>
    
    @endif
</div>

<style>
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }
    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>

<script>
    function slideDesktop(direction) {
        const slider = document.getElementById('desktop-slider');
        const scrollAmount = 400;
        
        if (direction === 'left') {
            slider.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
        } else {
            slider.scrollBy({ left: scrollAmount, behavior: 'smooth' });
        }
    }
    
    function slideMobile(direction) {
        const slider = document.getElementById('mobile-slider');
        const cardWidth = slider.querySelector('div').offsetWidth;
        
        if (direction === 'left') {
            slider.scrollBy({ left: -(cardWidth + 16), behavior: 'smooth' });
        } else {
            slider.scrollBy({ left: cardWidth + 16, behavior: 'smooth' });
        }
    }
</script>