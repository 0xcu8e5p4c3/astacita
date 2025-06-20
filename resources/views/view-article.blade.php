<link rel="stylesheet" href="{{ asset('css/tiptap.css') }}">

<x-layout>

<!-- cover -->
<div class="max-w-screen-xl mx-auto p-4 sm:p-8 md:p-12 relative">
    <!-- Tambahkan data attribute untuk article ID sebagai backup -->
    <article data-article-id="{{ $viewarticle->id }}" class="w-full">
        <div class="bg-cover bg-center text-center overflow-hidden rounded-lg"
            style="min-height: 550px; background-image: url('{{ $viewarticle->media ? route('image.show', $viewarticle->media->file_path) : asset('storage/default_image.jpg') }}')"
            title="{{ $viewarticle->title }}">
        </div>

        <!-- title -->
        <div class="max-w-3xl mx-auto">
            <div class="mt-3 bg-white rounded-lg flex flex-col justify-between leading-normal">
                <div class="bg-white relative top-0 -mt-24 p-4 sm:p-8">
                    <h1 class="text-gray-900 font-bold text-2xl sm:text-3xl mb-2">{{ $viewarticle->title }}</h1>

                    <!-- Penulis -->
                    <p class="text-gray-700 text-sm mt-2">Written By:
                        <a href="#" class="text-indigo-600 font-medium hover:text-gray-900">
                            {{ $viewarticle->author->name }}
                        </a> In 
                        <a href="#" class="text-indigo-600 font-medium hover:text-gray-900">
                            {{ $viewarticle->category->name }}
                        </a>
                    </p>

                    <!-- View count display -->
                    <div class="flex items-center text-gray-600 text-sm mt-2">
                        <span>{{ $viewarticle->created_at->format('d M Y') }}</span>
                        <span class="mx-2">|</span>
                        <span id="view-count">{{ $viewarticle->views_count }} views</span>
                    </div>

                    <!-- Tombol Bagikan -->
                    <div class="mt-4">
                        <button 
                            id="openModalBtn" 
                            class="flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-md transition-all shadow hover:shadow-lg"
                            onclick="openShareModal()"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 8a3 3 0 11-6 0 3 3 0 016 0zM15 16a3 3 0 11-6 0 3 3 0 016 0zM12 13v-2" />
                            </svg>
                            Bagikan
                        </button>
                    </div>

                    <!-- content -->
                    <div class="tiptap-content my-5 text-base leading-relaxed">
                        {!! $viewarticle->content !!}
                    </div>

                    <!-- Tags -->
                    <div class="flex flex-wrap gap-2 mt-4">
                        @foreach ($viewarticle->tags as $tag)
                            <a href="{{ route('category.show', ['slug' => $viewarticle->slug]) }}"
                                class="text-xs text-indigo-600 font-medium hover:text-gray-900">
                                #{{ $tag->name }}
                            </a>
                        @endforeach
                    </div>

                    <!-- Penulis Card -->
                    <div class="pt-5 flex items-center w-full">
                        <div class="bg-gray-100 dark:bg-gray-700 shadow-md hover:shadow-xl transition-all rounded-lg p-5 flex flex-col sm:flex-row items-center gap-4 w-full max-w-md">
                            <img src="{{ $viewarticle->author->profile_photo ?? 'https://ui-avatars.com/api/?name=' . urlencode($viewarticle->author->name) }}"
                                class="w-24 h-24 rounded-full object-cover object-center transition-all" />

                            <div class="text-center sm:text-left">
                                <h2 class="text-gray-600 dark:text-gray-200 font-bold">{{ $viewarticle->author->name }}</h2>
                                <p class="text-gray-400">Astacita.co</p>
                                <p class="text-xs text-gray-500 dark:text-gray-200">{{ $viewarticle->author->email }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
</div>

<!-- Container Modal -->
<div id="shareModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center">
    <!-- Modal Content -->
    <div class="bg-white w-full mx-4 p-4 rounded-xl md:w-1/2 lg:w-1/3">
        <!-- Header -->
        <div class="flex justify-between items-center border-b border-gray-200 py-1">
            <p class="text-xl font-bold text-gray-800">Bagikan</p>
            <div class="bg-gray-300 hover:bg-gray-500 text-gray-700 hover:text-white w-8 h-8 flex items-center justify-center rounded-full cursor-pointer" onclick="closeShareModal()">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                <line x1="18" y1="6" x2="6" y2="18" />
                <line x1="6" y1="6" x2="18" y2="18" />
            </svg>
        </div>
    </div>

    <!-- Body -->
    <div class="my-4">
            <p class="text-sm">Bagikan tautan melalui:</p>

        <div class="flex justify-around my-4">
        <!-- Facebook Icon -->
        <div class="border hover:bg-[#1877f2] w-12 h-12 fill-[#1877f2] hover:fill-white border-blue-200 rounded-full flex items-center justify-center shadow-xl hover:shadow-blue-500/50 cursor-pointer">
            <a id="share-fb" href="#" onclick="shareToFacebook(event)" target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M13.397 20.997v-8.196h2.765l.411-3.209h-3.176V7.548c0-.926.258-1.56 1.587-1.56h1.684V3.127A22.336 22.336 0 0 0 14.201 3c-2.444 0-4.122 1.492-4.122 4.231v2.355H7.332v3.209h2.753v8.202h3.312z"></path>
                </svg>
            </a>
        </div>

        <!-- Twitter Icon -->
        <div class="border hover:bg-[#1d9bf0] w-12 h-12 fill-[#1d9bf0] hover:fill-white border-blue-200 rounded-full flex items-center justify-center shadow-xl hover:shadow-sky-500/50 cursor-pointer">
            <a id="share-tw" href="#" onclick="shareToTwitter(event)" target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M19.633 7.997c.013.175.013.349.013.523 0 5.325-4.053 11.461-11.46 11.461-2.282 0-4.402-.661-6.186-1.809.324.037.636.05.973.05a8.07 8.07 0 0 0 5.001-1.721 4.036 4.036 0 0 1-3.767-2.793c.249.037.499.062.761.062.361 0 .724-.05 1.061-.137a4.027 4.027 0 0 1-3.23-3.953v-.05c.537.299 1.16.486 1.82.511a4.022 4.022 0 0 1-1.796-3.354c0-.748.199-1.434.548-2.032a11.457 11.457 0 0 0 8.306 4.215c-.062-.3-.1-.611-.1-.923a4.026 4.026 0 0 1 4.028-4.028c1.16 0 2.207.486 2.943 1.272a7.957 7.957 0 0 0 2.556-.973 4.02 4.02 0 0 1-1.771 2.22 8.073 8.073 0 0 0 2.319-.624 8.645 8.645 0 0 1-2.019 2.083z"></path>
                </svg>
            </a>
        </div>

        <!-- Instagram Icon -->
        <div class="border hover:bg-[#bc2a8d] w-12 h-12 fill-[#bc2a8d] hover:fill-white border-pink-200 rounded-full flex items-center justify-center shadow-xl hover:shadow-pink-500/50 cursor-pointer">
            <a id="share-ig" href="#" onclick="shareToInstagram(event)" target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M11.999 7.377a4.623 4.623 0 1 0 0 9.248 4.623 4.623 0 0 0 0-9.248zm0 7.627a3.004 3.004 0 1 1 0-6.008 3.004 3.004 0 0 1 0 6.008z"></path>
                    <circle cx="16.806" cy="7.207" r="1.078"></circle>
                    <path d="M20.533 6.111A4.605 4.605 0 0 0 17.9 3.479a6.606 6.606 0 0 0-2.186-.42c-.963-.042-1.268-.054-3.71-.054s-2.755 0-3.71.054a6.554 6.554 0 0 0-2.184.42 4.6 4.6 0 0 0-2.633 2.632 6.585 6.585 0 0 0-.419 2.186c-.043.962-.056 1.267-.056 3.71 0 2.442 0 2.753.056 3.71.015.748.156 1.486.419 2.187a4.61 4.61 0 0 0 2.634 2.632 6.584 6.584 0 0 0 2.185.45c.963.042 1.268.055 3.71.055s2.755 0 3.71-.055a6.615 6.615 0 0 0 2.186-.419 4.613 4.613 0 0 0 2.633-2.633c.263-.7.404-1.438.419-2.186.043-.962.056-1.267.056-3.71s0-2.753-.056-3.71a6.581 6.581 0 0 0-.421-2.217zm-1.218 9.532a5.043 5.043 0 0 1-.311 1.688 2.987 2.987 0 0 1-1.712 1.711 4.985 4.985 0 0 1-1.67.311c-.95.044-1.218.055-3.654.055-2.438 0-2.687 0-3.655-.055a4.96 4.96 0 0 1-1.669-.311 2.985 2.985 0 0 1-1.719-1.711 5.08 5.08 0 0 1-.311-1.669c-.043-.95-.053-1.218-.053-3.654 0-2.437 0-2.686.053-3.655a5.038 5.038 0 0 1 .311-1.687c.305-.789.93-1.41 1.719-1.712a5.01 5.01 0 0 1 1.669-.311c.951-.043 1.218-.055 3.655-.055s2.687 0 3.654.055a4.96 4.96 0 0 1 1.67.311 2.991 2.991 0 0 1 1.712 1.712 5.08 5.08 0 0 1 .311 1.669c.043.951.054 1.218.054 3.655 0 2.436 0 2.698-.043 3.654h-.011z"></path>
                </svg>
            </a>
        </div>

        <!-- WhatsApp Icon -->
        <div class="border hover:bg-[#25D366] w-12 h-12 fill-[#25D366] hover:fill-white border-green-200 rounded-full flex items-center justify-center shadow-xl hover:shadow-green-500/50 cursor-pointer">
            <a id="share-wa" href="#" onclick="shareToWhatsApp(event)" target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M18.403 5.633A8.919 8.919 0 0 0 12.053 3c-4.948 0-8.976 4.027-8.978 8.977 0 1.582.413 3.126 1.198 4.488L3 21.116l4.759-1.249a8.981 8.981 0 0 0 4.29 1.093h.004c4.947 0 8.975-4.027 8.977-8.977a8.926 8.926 0 0 0-2.627-6.35m-6.35 13.812h-.003a7.446 7.446 0 0 1-3.798-1.041l-.272-.162-2.824.741.753-2.753-.177-.282a7.448 7.448 0 0 1-1.141-3.971c.002-4.114 3.349-7.461 7.465-7.461a7.413 7.413 0 0 1 5.275 2.188 7.42 7.42 0 0 1 2.183 5.279c-.002 4.114-3.349 7.462-7.461 7.462m4.093-5.589c-.225-.113-1.327-.655-1.533-.73-.205-.075-.354-.112-.504.112s-.58.729-.711.879-.262.168-.486.056-.947-.349-1.804-1.113c-.667-.595-1.117-1.329-1.248-1.554s-.014-.346.099-.458c.101-.1.224-.262.336-.393.112-.131.149-.224.224-.374s.038-.281-.019-.393c-.056-.113-.505-1.217-.692-1.666-.181-.435-.366-.377-.504-.383a9.65 9.65 0 0 0-.429-.008.826.826 0 0 0-.599.28c-.206.225-.785.767-.785 1.871s.804 2.171.916 2.321c.112.15 1.582 2.415 3.832 3.387.536.231.954.369 1.279.473.537.171 1.026.146 1.413.089.431-.064 1.327-.542 1.514-1.066.187-.524.187-.973.131-1.067-.056-.094-.207-.151-.43-.263"></path>
                </svg>
            </a>
        </div>

        <!-- Telegram Icon -->
        <div class="border hover:bg-[#229ED9] w-12 h-12 fill-[#229ED9] hover:fill-white border-sky-200 rounded-full flex items-center justify-center shadow-xl hover:shadow-sky-500/50 cursor-pointer">
            <a id="share-tg" href="#" onclick="shareToTelegram(event)" target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path d="m20.665 3.717-17.73 6.837c-1.21.486-1.203 1.161-.222 1.462l4.552 1.42 10.532-6.645c.498-.303.953-.14.579.192l-8.533 7.701h-.002l.002.001-.314 4.692c.46 0 .663-.211.921-.46l2.211-2.15 4.599 3.397c.848.467 1.457.227 1.668-.785l3.019-14.228c.309-1.239-.473-1.8-1.282-1.434z"></path>
                </svg>
            </a>
        </div>
    </div>


        <!-- Copy Link -->
        <p class="text-sm">Atau salin tautan</p>
        <div class="border-2 border-gray-200 flex justify-between items-center mt-4 py-2 px-2 rounded-md">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="24"
          height="24"
          viewBox="0 0 24 24"
          class="fill-gray-500 ml-2"
        >
          <path
            d="M8.465 11.293c1.133-1.133 3.109-1.133 4.242 0l.707.707 1.414-1.414-.707-.707c-.943-.944-2.199-1.465-3.535-1.465s-2.592.521-3.535 1.465L4.929 12a5.008 5.008 0 0 0 0 7.071 4.983 4.983 0 0 0 3.535 1.462A4.982 4.982 0 0 0 12 19.071l.707-.707-1.414-1.414-.707.707a3.007 3.007 0 0 1-4.243 0 3.005 3.005 0 0 1 0-4.243l2.122-2.121z"
          ></path>
          <path
            d="m12 4.929-.707.707 1.414 1.414.707-.707a3.007 3.007 0 0 1 4.243 0 3.005 3.005 0 0 1 0 4.243l-2.122 2.121c-1.133 1.133-3.109 1.133-4.242 0L10.586 12l-1.414 1.414.707.707c.943.944 2.199 1.465 3.535 1.465s2.592-.521 3.535-1.465L19.071 12a5.008 5.008 0 0 0 0-7.071 5.006 5.006 0 0 0-7.071 0z"
          ></path>
        </svg>
            <input id="shareLink" class="w-full outline-none bg-transparent px-2" type="text" value="" readonly>
            <button 
                class="bg-indigo-500 text-white rounded text-sm py-2 px-5 hover:bg-indigo-600"
                onclick="copyLink()"
            >Copy</button>
        </div>
    </div>
</div>
</div>

</x-layout>

<script>
    // Get article data
    const articleId = {{ $viewarticle->id }};
    const articleTitle = @json($viewarticle->title);
    const currentUrl = window.location.href;

    function openShareModal() {
        document.getElementById('shareModal').classList.remove('hidden');
        // Track modal open event
        trackEvent('share_modal_opened', {
            article_id: articleId,
            article_title: articleTitle
        });
    }

    function closeShareModal() {
        document.getElementById('shareModal').classList.add('hidden');
    }

    // Tracking function - customize this based on your analytics setup
    function trackEvent(eventName, eventData = {}) {
        // Google Analytics 4 tracking
        if (typeof gtag !== 'undefined') {
            gtag('event', eventName, eventData);
        }

        // Custom tracker (if you have one)
        if (window.tracker && typeof window.tracker.trackEvent === 'function') {
            window.tracker.trackEvent(eventName, eventData);
        }

        // Facebook Pixel tracking
        if (typeof fbq !== 'undefined') {
            fbq('track', 'CustomEvent', {
                event_name: eventName,
                ...eventData
            });
        }

        // Console log for debugging
        console.log('Event tracked:', eventName, eventData);
    }

    // Social sharing functions with tracking
    function shareToFacebook(event) {
        event.preventDefault();
        trackEvent('social_share', {
            platform: 'facebook',
            article_id: articleId,
            article_title: articleTitle
        });
        
        const shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(currentUrl)}`;
        window.open(shareUrl, '_blank', 'width=600,height=400');
    }

    function shareToTwitter(event) {
        event.preventDefault();
        trackEvent('social_share', {
            platform: 'twitter',
            article_id: articleId,
            article_title: articleTitle
        });
        
        const shareUrl = `https://twitter.com/intent/tweet?url=${encodeURIComponent(currentUrl)}&text=${encodeURIComponent(articleTitle)}`;
        window.open(shareUrl, '_blank', 'width=600,height=400');
    }

    function shareToInstagram(event) {
        event.preventDefault();
        trackEvent('social_share', {
            platform: 'instagram',
            article_id: articleId,
            article_title: articleTitle
        });
        
        // Instagram doesn't have direct URL sharing, so copy to clipboard
        copyLink();
        alert('Link disalin! Buka Instagram dan paste link di bio atau story Anda.');
    }

    function shareToWhatsApp(event) {
        event.preventDefault();
        trackEvent('social_share', {
            platform: 'whatsapp',
            article_id: articleId,
            article_title: articleTitle
        });
        
        const shareText = `${articleTitle} - ${currentUrl}`;
        const shareUrl = `https://wa.me/?text=${encodeURIComponent(shareText)}`;
        window.open(shareUrl, '_blank');
    }

    function shareToTelegram(event) {
        event.preventDefault();
        trackEvent('social_share', {
            platform: 'telegram',
            article_id: articleId,
            article_title: articleTitle
        });
        
        const shareUrl = `https://t.me/share/url?url=${encodeURIComponent(currentUrl)}&text=${encodeURIComponent(articleTitle)}`;
        window.open(shareUrl, '_blank');
    }

    function copyLink() {
        const input = document.getElementById("shareLink");
        input.value = currentUrl;
        input.select();
        input.setSelectionRange(0, 99999);
        
        navigator.clipboard.writeText(input.value)
            .then(() => {
                trackEvent('social_share', {
                    platform: 'copy_link',
                    article_id: articleId,
                    article_title: articleTitle
                });
                alert("Link disalin ke clipboard!");
            })
            .catch(err => {
                console.error('Failed to copy: ', err);
                // Fallback for older browsers
                document.execCommand('copy');
                alert("Link disalin ke clipboard!");
            });
    }

    // Track page view on load
    document.addEventListener('DOMContentLoaded', function() {
        trackEvent('article_view', {
            article_id: articleId,
            article_title: articleTitle,
            author: @json($viewarticle->author->name),
            category: @json($viewarticle->category->name)
        });
    });

    // Track scroll depth
    let maxScrollDepth = 0;
    let scrollTracked = false;

    window.addEventListener('scroll', function() {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        const docHeight = document.documentElement.scrollHeight - window.innerHeight;
        const scrollPercent = Math.round((scrollTop / docHeight) * 100);
        
        if (scrollPercent > maxScrollDepth) {
            maxScrollDepth = scrollPercent;
        }

        // Track when user scrolls 50% and 90% of the article
        if (!scrollTracked && (scrollPercent >= 50 || scrollPercent >= 90)) {
            if (scrollPercent >= 90) {
                trackEvent('article_read_complete', {
                    article_id: articleId,
                    scroll_depth: scrollPercent
                });
            } else if (scrollPercent >= 50) {
                trackEvent('article_read_half', {
                    article_id: articleId,
                    scroll_depth: scrollPercent
                });
            }
        }
    });

    // Track time spent on page
    let startTime = Date.now();
    
    window.addEventListener('beforeunload', function() {
        const timeSpent = Math.round((Date.now() - startTime) / 1000); // in seconds
        trackEvent('article_time_spent', {
            article_id: articleId,
            time_spent: timeSpent,
            max_scroll_depth: maxScrollDepth
        });
    });
</script>