<script src="https://cdn.tailwindcss.com"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&amp;display=swap" rel="stylesheet"/>
<style>
    body {
        font-family: 'Roboto', sans-serif;
    }
</style>
</head>
<body class="bg-gray-100 p-4">
    <div class="container mx-auto">
        <div class="bg-white rounded-lg p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- OKEGAS Section -->
                <div>
                    <div class="flex items-center mb-4">
                        <div class="text-black font-bold text-sm">
                            OKEGAS
                        </div>
                        <div class="border-b-2 border-blue-500 flex-grow ml-2"></div>
                    </div>
                    @if ($okegas->count() > 0)
                    <div class="relative mb-4">
                        <img alt="{{ $okegas[0]->title }}" class="w-full h-auto rounded-lg" height="400" src="{{ $okegas[0]->thumbnail ? asset('storage/'.$okegas[0]->thumbnail) : 'https://picsum.photos/seed/'.$okegas[0]->id.'/800/450' }}" width="600"/>
                        <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-50 p-4 rounded-b-lg">
                            <a href="{{ route('article.show', ['categorySlug' => $okegas[0]->category->slug, 'articleSlug' => $okegas[0]->slug]) }}" class="text-lg font-bold text-white hover:text-blue-500 transition duration-300">
                                {{ $okegas[0]->title }}
                            </a>
                            <p class="text-gray-300 text-xs">
                            {{ $okegas[0]->author->name ?? 'Anonim' }} - {{ \Carbon\Carbon::parse($okegas[0]->created_at)->format('d M Y') }}
                            </p>
                        </div>
                    </div>
                    @endif
                    <div class="space-y-4">
                        @foreach ($okegas->skip(1) as $article)
                        <div class="flex items-start">
                            <img alt="{{ $article->title }}" class="w-24 h-24 object-cover mr-4 rounded-lg" height="100" src="{{ $article->thumbnail ? asset('storage/'.$article->thumbnail) : 'https://picsum.photos/seed/'.$article->id.'/100/100' }}" width="100"/>
                            <div>
                                <a href="{{ route('article.show', ['categorySlug' => $article->category->slug, 'articleSlug' => $article->slug]) }}" class="text-md font-bold hover:text-blue-500 transition duration-300 text-sm">
                                    {{ $article->title }}
                                </a>
                                <p class="text-gray-600 text-xs">
                                {{ $article->author->name ?? 'Anonim' }} - {{ \Carbon\Carbon::parse($article->created_at)->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- BUMN Section -->
                <div>
                    <div class="flex items-center mb-4">
                        <div class="text-black font-bold text-sm">
                            BUMN
                        </div>
                        <div class="border-b-2 border-blue-500 flex-grow ml-2"></div>
                    </div>
                    @if ($bumn->count() > 0)
                    <div class="relative mb-4">
                        <img alt="{{ $bumn[0]->title }}" class="w-full h-auto rounded-lg" height="400" src="{{ $bumn[0]->thumbnail ? asset('storage/'.$bumn[0]->thumbnail) : 'https://picsum.photos/seed/'.$bumn[0]->id.'/800/450' }}" width="600"/>
                        <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-50 p-4 rounded-b-lg">
                            <a href="{{ route('article.show', ['categorySlug' => $bumn[0]->category->slug, 'articleSlug' => $bumn[0]->slug]) }}" class="text-lg font-bold text-white hover:text-blue-500 transition duration-300">
                                {{ $bumn[0]->title }}
                            </a>
                            <p class="text-gray-300 text-xs">
                            {{ $bumn[0]->author->name ?? 'Anonim' }} - {{ \Carbon\Carbon::parse($bumn[0]->created_at)->diffForHumans() }}
                            </p>
                        </div>
                    </div>
                    @endif
                    <div class="space-y-4">
                        @foreach ($bumn->skip(1) as $article)
                        <div class="flex items-start">
                            <img alt="{{ $article->title }}" class="w-24 h-24 object-cover mr-4 rounded-lg" height="100" src="{{ $article->thumbnail ? asset('storage/'.$article->thumbnail) : 'https://picsum.photos/seed/'.$article->id.'/100/100' }}" width="100"/>
                            <div>
                                <a href="{{ route('article.show', ['categorySlug' => $article->category->slug, 'articleSlug' => $article->slug]) }}" class="text-md font-bold hover:text-blue-500 transition duration-300 text-sm">
                                    {{ $article->title }}
                                </a>
                                <p class="text-gray-600 text-xs">
                                {{ $article->author->name ?? 'Anonim' }} - {{ \Carbon\Carbon::parse($article->created_at)->format('d/m/Y') }}
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- KABINET Section -->
                <div>
                    <div class="flex items-center mb-4">
                        <div class="text-black font-bold text-sm">
                            KABINET
                        </div>
                        <div class="border-b-2 border-blue-500 flex-grow ml-2"></div>
                    </div>
                    @if ($kabinet->count() > 0)
                    <div class="relative mb-4">
                        <img alt="{{ $kabinet[0]->title }}" class="w-full h-auto rounded-lg" height="400" src="{{ $kabinet[0]->thumbnail ? asset('storage/'.$kabinet[0]->thumbnail) : 'https://picsum.photos/seed/'.$kabinet[0]->id.'/800/450' }}" width="600"/>
                        <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-50 p-4 rounded-b-lg">
                            <a href="{{ route('article.show', ['categorySlug' => $kabinet[0]->category->slug, 'articleSlug' => $kabinet[0]->slug]) }}" class="text-lg font-bold text-white hover:text-blue-500 transition duration-300">
                                {{ $kabinet[0]->title }}
                            </a>
                            <p class="text-gray-300 text-xs">
                            {{ $kabinet[0]->author->name ?? 'Anonim' }} - {{ \Carbon\Carbon::parse($kabinet[0]->created_at)->format('d M Y') }}
                            </p>
                        </div>
                    </div>
                    @endif
                    <div class="space-y-4">
                        @foreach ($kabinet->skip(1) as $article)
                        <div class="flex items-start">
                            <img alt="{{ $article->title }}" class="w-24 h-24 object-cover mr-4 rounded-lg" height="100" src="{{ $article->thumbnail ? asset('storage/'.$article->thumbnail) : 'https://picsum.photos/seed/'.$article->id.'/100/100' }}" width="100"/>
                            <div>
                                <a href="{{ route('article.show', ['categorySlug' => $article->category->slug, 'articleSlug' => $article->slug]) }}" class="text-md font-bold hover:text-blue-500 transition duration-300 text-sm">
                                    {{ $article->title }}
                                </a>
                                <p class="text-gray-600 text-xs">
                                {{ $article->author->name ?? 'Anonim' }} - {{ \Carbon\Carbon::parse($article->created_at)->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
