<link rel="stylesheet" href="{{ asset('css/tiptap.css') }}">
<x-layout>

<div class="container mx-auto px-4 py-12">
    <div class="max-w-4xl mx-auto">
        <!-- Header Section -->
        <div class="text-center mb-12 fade-in">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Tentang Astacita.com</h1>
            <div class="w-24 h-1 bg-blue-600 mx-auto rounded-full mb-6"></div>
            @if($setting->about_short_description)
                <p class="text-xl text-gray-600 leading-relaxed">{{ $setting->about_short_description }}</p>
            @endif
        </div>

        <!-- Main Content -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden fade-in">
            <div class="p-8 md:p-12">
                @if($setting->about_description)
                    <div class="tiptap-content prose prose-lg max-w-none text-gray-700 leading-relaxed mb-8">
                        {!! $setting->about_description !!}
                    </div>
                @endif

                <!-- Stats Section -->
                @if($setting->year_established)
                    <div class="bg-gray-50 rounded-lg p-6 mb-8">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-blue-600 mb-2">
                                {{ date('Y') - $setting->year_established }} Tahun
                            </div>
                            <p class="text-gray-600">Melayani pembaca sejak {{ $setting->year_established }}</p>
                        </div>
                    </div>
                @endif

                <!-- Visi Misi Section -->
                @if($setting->visi || $setting->misi)
                    <div class="grid md:grid-cols-2 gap-8">
                        @if($setting->visi)
                            <div class="tiptap-content bg-gradient-to-br from-blue-50 to-indigo-50 rounded-lg p-6">
                                <h3 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                                    <div class="w-2 h-2 bg-blue-600 rounded-full mr-3"></div>
                                    Visi
                                </h3>
                                <p class="text-gray-700 leading-relaxed">{!! $setting->visi !!}</p>
                            </div>
                        @endif

                        @if($setting->misi)
                            <div class="tiptap-content bg-gradient-to-br from-green-50 to-emerald-50 rounded-lg p-6">
                                <h3 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                                    <div class="w-2 h-2 bg-green-600 rounded-full mr-3"></div>
                                    Misi
                                </h3>
                                <p class="text-gray-700 leading-relaxed">{!! $setting->misi !!}</p>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>

        <!-- Call to Action -->
    </div>
</div>

</x-layout>