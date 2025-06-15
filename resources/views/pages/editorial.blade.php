<x-layout>

<div class="container mx-auto px-4 py-12">
    <div class="max-w-6xl mx-auto">
        <!-- Header Section -->
        <div class="text-center mb-12 fade-in">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Tim Redaksi</h1>
            <div class="w-24 h-1 bg-blue-600 mx-auto rounded-full mb-6"></div>
            <p class="text-xl text-gray-600 leading-relaxed max-w-3xl mx-auto">
                Mengenal para profesional di balik setiap artikel berkualitas yang kami sajikan
            </p>
        </div>

        <!-- Editorial Statement -->
        @if($setting->editorial_statement)
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8 mb-12 fade-in">
                <h2 class="text-2xl font-semibold text-gray-900 mb-6 text-center">Pernyataan Editorial</h2>
                <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed text-center">
                    {!! $setting->editorial_statement !!}
                </div>
            </div>
        @endif

        <!-- Editorial Team -->
        @if($setting->editorial_team && count($setting->editorial_team) > 0)
            <div class="mb-12 fade-in">
                <h2 class="text-3xl font-bold text-gray-900 text-center mb-8">Tim Editorial</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($setting->editorial_team_with_photos as $member)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow duration-300">
                            <!-- Photo Section -->
                            <div class="relative h-64 bg-gradient-to-br from-blue-50 to-indigo-100">
                                @if(isset($member['photo_url']))
                                    <img src="{{ $member['photo_url'] }}" 
                                         alt="{{ $member['name'] ?? 'Tim Member' }}" 
                                         class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <div class="w-20 h-20 bg-blue-200 rounded-full flex items-center justify-center">
                                            <svg class="w-10 h-10 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            
                            <!-- Info Section -->
                            <div class="p-6">
                                @if(isset($member['name']))
                                    <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $member['name'] }}</h3>
                                @endif
                                
                                @if(isset($member['position']))
                                    <p class="text-blue-600 font-medium mb-3">{{ $member['position'] }}</p>
                                @endif
                                
                                @if(isset($member['bio']))
                                    <p class="text-gray-600 text-sm leading-relaxed mb-4">{{ $member['bio'] }}</p>
                                @endif
                                
                                @if(isset($member['experience']))
                                    <div class="text-xs text-gray-500">
                                        <span class="font-medium">Pengalaman:</span> {{ $member['experience'] }}
                                    </div>
                                @endif
                                
                                <!-- Social Links -->
                                @if(isset($member['social_links']) && is_array($member['social_links']))
                                    <div class="flex space-x-3 mt-4 pt-4 border-t border-gray-100">
                                        @foreach($member['social_links'] as $platform => $url)
                                            @if($url)
                                                <a href="{{ $url }}" target="_blank" 
                                                   class="text-gray-400 hover:text-blue-600 transition-colors">
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                        <circle cx="10" cy="10" r="8"/>
                                                    </svg>
                                                </a>
                                            @endif
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-16 fade-in">
                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Tim Redaksi Sedang Dipersiapkan</h3>
                <p class="text-gray-600">Informasi lengkap tentang tim redaksi akan segera tersedia.</p>
            </div>
        @endif

        <!-- Contact Section -->

    </div>
</div>


</x-layout>