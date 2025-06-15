<x-layout>

<div class="container mx-auto px-4 py-12">
    <div class="max-w-6xl mx-auto">
        <!-- Header Section -->
        <div class="text-center mb-12 fade-in">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Hubungi Kami</h1>
            <div class="w-24 h-1 bg-purple-600 mx-auto rounded-full mb-6"></div>
            <p class="text-xl text-gray-600 leading-relaxed max-w-3xl mx-auto">
                Terhubung dengan tim {{ $setting->site_name ?? 'Astacita.co' }} untuk berbagai kebutuhan informasi dan kerjasama
            </p>
        </div>

        <div class="grid lg:grid-cols-2 gap-8">
            <!-- Contact Information -->
            <div class="space-y-6 fade-in">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-6">Informasi Kontak</h2>
                    
                    <div class="space-y-6">
                        @if($setting->contact_email)
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1">Email</h3>
                                <p class="text-gray-600 mb-2">Kirim email untuk pertanyaan umum atau kerjasama</p>
                                <a href="mailto:{{ $setting->contact_email }}" 
                                   class="text-purple-600 hover:text-purple-700 font-medium">
                                    {{ $setting->contact_email }}
                                </a>
                            </div>
                        </div>
                        @endif

                        @if($setting->contact_phone)
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1">Telepon</h3>
                                <p class="text-gray-600 mb-2">Hubungi kami langsung untuk informasi cepat</p>
                                <a href="tel:{{ $setting->contact_phone }}" 
                                   class="text-green-600 hover:text-green-700 font-medium">
                                    {{ $setting->contact_phone }}
                                </a>
                            </div>
                        </div>
                        @endif

                        @if($setting->contact_address)
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1">Alamat</h3>
                                <p class="text-gray-600 mb-2">Kunjungi kantor kami untuk bertemu langsung</p>
                                <p class="text-gray-700 leading-relaxed">
                                    {{ $setting->contact_address }}
                                </p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Social Media -->
                @if($setting->hasSocialMedia())
                <div class="bg-gradient-to-br from-purple-50 to-indigo-50 rounded-xl p-8">
                    <h3 class="text-xl font-semibold text-gray-900 mb-6">Ikuti Kami</h3>
                    <div class="flex flex-wrap gap-4">
                        @foreach($setting->getSocialMediaLinks() as $platform => $url)
                            @if($url)
                            <a href="{{ $url }}" 
                               target="_blank" 
                               rel="noopener noreferrer"
                               class="flex items-center space-x-2 bg-white px-4 py-3 rounded-lg hover:shadow-md transition-all duration-200 group">
                                @if($platform === 'facebook')
                                    <svg class="w-5 h-5 text-blue-600 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                    </svg>
                                    <span class="font-medium text-gray-700">Facebook</span>
                                @elseif($platform === 'twitter')
                                    <svg class="w-5 h-5 text-blue-400 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                    </svg>
                                    <span class="font-medium text-gray-700">Twitter</span>
                                @elseif($platform === 'instagram')
                                    <svg class="w-5 h-5 text-pink-600 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 6.62 5.367 11.987 11.988 11.987 6.62 0 11.987-5.367 11.987-11.987C24.014 5.367 18.637.001 12.017.001zM18.68 16.087c0 1.412-1.155 2.567-2.567 2.567H7.887c-1.412 0-2.567-1.155-2.567-2.567V7.913c0-1.412 1.155-2.567 2.567-2.567h8.226c1.412 0 2.567 1.155 2.567 2.567v8.174z"/>
                                    </svg>
                                    <span class="font-medium text-gray-700">Instagram</span>
                                @elseif($platform === 'youtube')
                                    <svg class="w-5 h-5 text-red-600 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                                    </svg>
                                    <span class="font-medium text-gray-700">YouTube</span>
                                @elseif($platform === 'linkedin')
                                    <svg class="w-5 h-5 text-blue-700 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                    </svg>
                                    <span class="font-medium text-gray-700">LinkedIn</span>
                                @endif
                            </a>
                            @endif
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <!-- Map Section -->
            <div class="fade-in">
                @if($setting->maps_embed_code)
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-100">
                        <h2 class="text-2xl font-semibold text-gray-900">Lokasi Kami</h2>
                        <p class="text-gray-600 mt-2">Temukan lokasi kantor kami di peta</p>
                    </div>
                    <div class="relative h-96">
                        {!! $setting->maps_embed_code !!}
                    </div>
                </div>
                @else
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-6">Jam Operasional</h2>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center py-3 border-b border-gray-100">
                            <span class="font-medium text-gray-900">Senin - Jumat</span>
                            <span class="text-gray-600">08:00 - 17:00 WIB</span>
                        </div>
                        <div class="flex justify-between items-center py-3 border-b border-gray-100">
                            <span class="font-medium text-gray-900">Sabtu</span>
                            <span class="text-gray-600">08:00 - 14:00 WIB</span>
                        </div>
                        <div class="flex justify-between items-center py-3">
                            <span class="font-medium text-gray-900">Minggu</span>
                            <span class="text-red-600">Tutup</span>
                        </div>
                    </div>
                    
                    <div class="mt-8 p-4 bg-blue-50 rounded-lg">
                        <div class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-blue-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <h4 class="font-medium text-blue-900 mb-1">Catatan Penting</h4>
                                <p class="text-sm text-blue-700">
                                    Untuk kunjungan langsung, mohon hubungi kami terlebih dahulu untuk memastikan ketersediaan tim.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Bottom CTA Section -->
        <div class="text-center mt-12 fade-in">
            <div class="bg-gradient-to-r from-purple-600 to-indigo-600 rounded-xl p-8 text-white">
                <h3 class="text-2xl font-semibold mb-4">Siap Berkolaborasi?</h3>
                <p class="text-purple-100 mb-6 max-w-2xl mx-auto">
                    Tim {{ $setting->site_name ?? 'Astacita.co' }} selalu terbuka untuk diskusi, kerjasama, dan berbagi informasi yang bermanfaat.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    @if($setting->contact_email)
                        <a href="mailto:{{ $setting->contact_email }}" 
                           class="bg-white text-purple-600 px-6 py-3 rounded-lg font-medium hover:bg-gray-50 transition-colors inline-flex items-center justify-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <span>Kirim Email</span>
                        </a>
                    @endif
                    @if($setting->contact_phone)
                        <a href="tel:{{ $setting->contact_phone }}" 
                           class="border border-white text-white px-6 py-3 rounded-lg font-medium hover:bg-white hover:text-purple-600 transition-colors inline-flex items-center justify-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <span>Telepon Langsung</span>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

</x-layout>