<div class="container mx-auto p-4">
    
    @if($type == 'all' || $type == 'tiktok')
    <!-- TikTok Section (selalu tampil) -->
    <h1 class="text-xl font-bold mb-4">TikTok Video</h1>
    <div class="flex space-x-4 overflow-x-auto mb-8">
        @if($type == 'all')
            @foreach($videos['tiktok'] as $video)
                <div class="w-60 flex-shrink-0">
                    <div class="w-full h-96 rounded-lg overflow-hidden">
                        @php $tiktokId = $getTikTokId($video->url); @endphp
                        @if($tiktokId)
                              <iframe 
                                  class="w-full h-full"
                                  src="https://www.tiktok.com/embed/v2/{{ $tiktokId }}" 
                                  frameborder="0" 
                                  allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                  allowfullscreen>
                              </iframe>
                        @else
                            <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                <p>Invalid TikTok URL</p>
                            </div>
                        @endif
                    </div>
                    <p class="mt-2 text-sm font-semibold">{{ Str::limit($video->title, 30) }}</p>
                    <p class="text-xs text-gray-600">{{ $video->views_count ?? '0' }} x ditonton</p>
                </div>
            @endforeach
        @else
            @foreach($videos as $video)
                <div class="w-60 flex-shrink-0">
                    <div class="w-full h-96 rounded-lg overflow-hidden">
                        @php $tiktokId = $getTikTokId($video->url); @endphp
                        @if($tiktokId)
                            <iframe 
                                class="w-full h-full"
                                src="https://www.tiktok.com/embed/v2/{{ $tiktokId }}" 
                                frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                allowfullscreen>
                            </iframe>
                        @else
                            <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                <p>Invalid TikTok URL</p>
                            </div>
                        @endif
                    </div>
                    <p class="mt-2 text-sm font-semibold">{{ Str::limit($video->title, 30) }}</p>
                    <p class="text-xs text-gray-600">{{ $video->views_count ?? '0' }} x ditonton</p>
                </div>
            @endforeach
        @endif
    </div>
    @endif

    @if(($type == 'all' || $type == 'youtube') && (isset($videos['youtube']) || ($type == 'youtube' && !empty($videos))))
    <!-- YouTube Section (hanya tampil di md ke atas) -->
    <div class="hidden md:block">
        <h1 class="text-xl font-bold mb-4">YouTube Video</h1>
        <div class="flex space-x-4 overflow-x-auto">
            @if($type == 'all')
                @foreach($videos['youtube'] as $video)
                    <div class="w-96 flex-shrink-0">
                        <div class="w-full h-60 rounded-lg overflow-hidden">
                            @php $youtubeId = $getYouTubeId($video->url); @endphp
                            @if($youtubeId)
                                <iframe 
                                    class="w-full h-full"
                                    src="https://www.youtube.com/embed/{{ $youtubeId }}" 
                                    frameborder="0" 
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                    allowfullscreen>
                                </iframe>
                            @else
                                <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                    <p>Invalid YouTube URL</p>
                                </div>
                            @endif
                        </div>
                        <p class="mt-2 text-sm font-semibold">{{ Str::limit($video->title, 30) }}</p>
                        <p class="text-xs text-gray-600">{{ $video->views_count ?? '0' }} x ditonton</p>
                    </div>
                @endforeach
            @else
                @foreach($videos as $video)
                    <div class="w-96 flex-shrink-0">
                        <div class="w-full h-60 rounded-lg overflow-hidden">
                            @php $youtubeId = $getYouTubeId($video->url); @endphp
                            @if($youtubeId)
                                <iframe 
                                    class="w-full h-full"
                                    src="https://www.youtube.com/embed/{{ $youtubeId }}" 
                                    frameborder="0" 
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                    allowfullscreen>
                                </iframe>
                            @else
                                <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                    <p>Invalid YouTube URL</p>
                                </div>
                            @endif
                        </div>
                        <p class="mt-2 text-sm font-semibold">{{ Str::limit($video->title, 30) }}</p>
                        <p class="text-xs text-gray-600">{{ $video->views_count ?? '0' }} x ditonton</p>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    @endif

</div>
