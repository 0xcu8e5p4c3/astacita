<link rel="stylesheet" href="{{ asset('css/tiptap.css') }}">
<x-layout>

<div class="container mx-auto px-4 py-12">
    <div class="max-w-4xl mx-auto">
        <!-- Header Section -->
        <div class="text-center mb-12 fade-in">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Kode Etik Jurnalistik</h1>
            <div class="w-24 h-1 bg-blue-600 mx-auto rounded-full mb-6"></div>
            <p class="text-xl text-gray-600 leading-relaxed max-w-3xl mx-auto">
                Pedoman etika dan profesionalisme yang menjadi landasan kerja jurnalistik kami
            </p>
        </div>

        <!-- Main Content -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden fade-in">
            <div class="p-8 md:p-12">
                <!-- Introduction -->
                <div class="mb-8">
                    <div class="bg-blue-50 rounded-lg p-6 mb-6">
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0 w-6 h-6 bg-blue-600 rounded-full flex items-center justify-center mt-1">
                                <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-2">Komitmen Kami</h3>
                                <p class="text-gray-700 text-sm leading-relaxed">
                                    Tim redaksi {{ $setting->site_name ?? 'Astacita.co' }} berkomitmen untuk menjunjung tinggi nilai-nilai jurnalistik yang profesional, objektif, dan bertanggung jawab dalam setiap karya yang kami hasilkan.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Ethics Code Content -->
                @if($setting->ethics_code)
                    <div class="tiptap-content prose prose-lg max-w-none text-gray-700 leading-relaxed mb-8">
                        {!! $setting->ethics_code !!}
                    </div>
                @else
                    <!-- Default Ethics Code -->
                    <div class="space-y-8">
                        <div class="border-l-4 border-blue-600 pl-6">
                            <h3 class="text-xl font-semibold text-gray-900 mb-3">1. Independensi</h3>
                            <p class="text-gray-700 leading-relaxed">
                                Wartawan Indonesia tidak menyalahgunakan profesi dan tidak menerima suap, gratifikasi, dan fasilitas lain dari pihak lain yang dapat mempengaruhi independensi.
                            </p>
                        </div>

                        <div class="border-l-4 border-green-600 pl-6">
                            <h3 class="text-xl font-semibold text-gray-900 mb-3">2. Fairness dan Objektivitas</h3>
                            <p class="text-gray-700 leading-relaxed">
                                Wartawan Indonesia menempuh cara-cara yang profesional dalam melaksanakan tugas jurnalistik dan memberikan kesempatan hak jawab secara proporsional kepada para pihak yang berkepentingan.
                            </p>
                        </div>

                        <div class="border-l-4 border-purple-600 pl-6">
                            <h3 class="text-xl font-semibold text-gray-900 mb-3">3. Akurasi dan Faktual</h3>
                            <p class="text-gray-700 leading-relaxed">
                                Wartawan Indonesia menguji informasi, memberitakan secara berimbang, tidak mencampurkan fakta dan opini yang menghakimi, serta menerapkan asas praduga tak bersalah.
                            </p>
                        </div>

                        <div class="border-l-4 border-red-600 pl-6">
                            <h3 class="text-xl font-semibold text-gray-900 mb-3">4. Akuntabilitas</h3>
                            <p class="text-gray-700 leading-relaxed">
                                Wartawan Indonesia segera mencabut, meralat, dan memperbaiki berita yang keliru dan tidak akurat disertai dengan permintaan maaf kepada pembaca, pendengar, dan pemirsa.
                            </p>
                        </div>

                        <div class="border-l-4 border-yellow-600 pl-6">
                            <h3 class="text-xl font-semibold text-gray-900 mb-3">5. Minimalisasi Dampak</h3>
                            <p class="text-gray-700 leading-relaxed">
                                Wartawan Indonesia tidak menyebutkan dan menyiarkan identitas korban kejahatan susila dan tidak menyebutkan identitas anak yang menjadi pelaku kejahatan.
                            </p>
                        </div>
                    </div>
                @endif

                <!-- Last Updated -->
                @if($setting->ethics_last_updated)
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <p class="text-sm text-gray-500 text-center">
                            Terakhir diperbarui: {{ $setting->ethics_last_updated->format('d F Y') }}
                        </p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Additional Information -->
        <div class="grid md:grid-cols-2 gap-6 mt-8">
            <!-- Complaint Section -->
            <div class="bg-gradient-to-br from-orange-50 to-red-50 rounded-xl p-6 fade-in">
                <div class="flex items-center mb-4">
                    <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center mr-3">
                        <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Aduan & Koreksi</h3>
                </div>
                <p class="text-gray-700 text-sm leading-relaxed mb-4">
                    Jika Anda menemukan konten yang melanggar kode etik atau memerlukan koreksi, silakan hubungi kami.
                </p>
                @if($setting->contact_email)
                    <a href="mailto:{{ $setting->contact_email }}" 
                       class="inline-flex items-center text-orange-600 hover:text-orange-700 font-medium text-sm">
                        Kirim Aduan
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                @endif
            </div>

            <!-- Reference Section -->
            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl p-6 fade-in">
                <div class="flex items-center mb-4">
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Referensi</h3>
                </div>
                <p class="text-gray-700 text-sm leading-relaxed mb-4">
                    Kode etik ini mengacu pada Kode Etik Jurnalistik Indonesia yang ditetapkan oleh Dewan Pers.
                </p>
                <a href="https://dewanpers.or.id" target="_blank" 
                   class="inline-flex items-center text-blue-600 hover:text-blue-700 font-medium text-sm">
                    Pelajari Lebih Lanjut
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="text-center mt-12 fade-in">
            <div class="bg-gradient-to-r from-gray-800 to-gray-900 rounded-xl p-8 text-white">
                <h3 class="text-2xl font-semibold mb-4">Komitmen Berkelanjutan</h3>
                <p class="text-gray-300 mb-6 max-w-2xl mx-auto">
                    Kami berkomitmen untuk terus meningkatkan kualitas jurnalistik dan menjaga kepercayaan pembaca melalui penerapan kode etik yang konsisten.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('about') }}" 
                       class="bg-white text-gray-900 px-6 py-3 rounded-lg font-medium hover:bg-gray-100 transition-colors">
                        Tentang Kami
                    </a>
                    <a href="{{ route('editorial') }}" 
                       class="border border-white text-white px-6 py-3 rounded-lg font-medium hover:bg-white hover:text-gray-900 transition-colors">
                        Tim Redaksi
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

</x-layout>