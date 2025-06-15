<link rel="stylesheet" href="{{ asset('css/tiptap.css') }}">
<x-layout>

<div class="container mx-auto px-4 py-12">
    <div class="max-w-4xl mx-auto">
        <!-- Header Section -->
        <div class="text-center mb-12 fade-in">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Pedoman Media Cyber</h1>
            <div class="w-24 h-1 bg-purple-600 mx-auto rounded-full mb-6"></div>
            <p class="text-xl text-gray-600 leading-relaxed max-w-3xl mx-auto">
                Panduan lengkap pengelolaan konten digital dan etika bermedia di era cyber
            </p>
        </div>

        <!-- Main Content -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden fade-in">
            <div class="p-8 md:p-12">
                <!-- Introduction -->
                <div class="mb-8">
                    <div class="bg-purple-50 rounded-lg p-6 mb-6">
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0 w-6 h-6 bg-purple-600 rounded-full flex items-center justify-center mt-1">
                                <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-2">Era Digital yang Bertanggung Jawab</h3>
                                <p class="text-gray-700 text-sm leading-relaxed">
                                    Dalam era transformasi digital, {{ $setting->site_name ?? 'Astacita.co' }} berkomitmen untuk menerapkan standar tertinggi dalam pengelolaan media cyber yang profesional dan bertanggung jawab.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Guidelines Content -->
                @if($setting->cyber_media_guidelines)
                    <div class="tiptap-content prose prose-lg max-w-none text-gray-700 leading-relaxed mb-8">
                        {!! $setting->cyber_media_guidelines !!}
                    </div>
                @else
                    <!-- Default Guidelines -->
                    <div class="space-y-8">
                        <div class="border-l-4 border-purple-600 pl-6">
                            <h3 class="text-xl font-semibold text-gray-900 mb-3">1. Verifikasi Konten Digital</h3>
                            <p class="text-gray-700 leading-relaxed mb-3">
                                Setiap konten digital yang dipublikasikan harus melalui proses verifikasi yang ketat untuk memastikan keakuratan dan kredibilitas informasi.
                            </p>
                            <ul class="text-sm text-gray-600 space-y-1 ml-4">
                                <li>• Konfirmasi sumber dari minimal 2 sumber independen</li>
                                <li>• Verifikasi visual dan audio menggunakan tools fact-checking</li>
                                <li>• Cross-check dengan database berita terpercaya</li>
                            </ul>
                        </div>

                        <div class="border-l-4 border-blue-600 pl-6">
                            <h3 class="text-xl font-semibold text-gray-900 mb-3">2. Etika Media Sosial</h3>
                            <p class="text-gray-700 leading-relaxed mb-3">
                                Pengelolaan akun media sosial resmi harus mengikuti standar profesional jurnalistik.
                            </p>
                            <ul class="text-sm text-gray-600 space-y-1 ml-4">
                                <li>• Tidak menyebarkan informasi yang belum terverifikasi</li>
                                <li>• Merespons komentar dan kritik dengan profesional</li>
                                <li>• Menghindari konten yang bersifat provokatif atau memecah belah</li>
                            </ul>
                        </div>

                        <div class="border-l-4 border-green-600 pl-6">
                            <h3 class="text-xl font-semibold text-gray-900 mb-3">3. Perlindungan Data Pribadi</h3>
                            <p class="text-gray-700 leading-relaxed mb-3">
                                Komitmen terhadap perlindungan data pribadi pembaca dan narasumber sesuai peraturan yang berlaku.
                            </p>
                            <ul class="text-sm text-gray-600 space-y-1 ml-4">
                                <li>• Enkripsi data sensitif</li>
                                <li>• Consent yang jelas untuk penggunaan data</li>
                                <li>• Kebijakan privasi yang transparan</li>
                            </ul>
                        </div>

                        <div class="border-l-4 border-orange-600 pl-6">
                            <h3 class="text-xl font-semibold text-gray-900 mb-3">4. Moderasi Konten</h3>
                            <p class="text-gray-700 leading-relaxed mb-3">
                                Sistem moderasi konten yang efektif untuk menjaga kualitas diskusi dan interaksi.
                            </p>
                            <ul class="text-sm text-gray-600 space-y-1 ml-4">
                                <li>• Filter otomatis untuk konten tidak pantas</li>
                                <li>• Moderasi manual untuk konten sensitif</li>
                                <li>• Panduan community guidelines yang jelas</li>
                            </ul>
                        </div>

                        <div class="border-l-4 border-red-600 pl-6">
                            <h3 class="text-xl font-semibold text-gray-900 mb-3">5. Konten Multimedia</h3>
                            <p class="text-gray-700 leading-relaxed mb-3">
                                Standar khusus untuk pengelolaan konten multimedia di platform digital.
                            </p>
                            <ul class="text-sm text-gray-600 space-y-1 ml-4">
                                <li>• Optimasi gambar dan video untuk web</li>
                                <li>• Alt text untuk aksesibilitas</li>
                                <li>• Lisensi dan copyright yang jelas</li>
                            </ul>
                        </div>

                        <div class="border-l-4 border-indigo-600 pl-6">
                            <h3 class="text-xl font-semibold text-gray-900 mb-3">6. Transparansi Algoritma</h3>
                            <p class="text-gray-700 leading-relaxed mb-3">
                                Keterbukaan dalam penggunaan algoritma untuk kurasi dan distribusi konten.
                            </p>
                            <ul class="text-sm text-gray-600 space-y-1 ml-4">
                                <li>• Penjelasan cara kerja sistem rekomendasi</li>
                                <li>• Audit berkala terhadap bias algoritma</li>
                                <li>• Kontrol pengguna terhadap personalisasi</li>
                            </ul>
                        </div>
                    </div>
                @endif

                <!-- Reference and Last Updated -->
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <div class="flex flex-col sm:flex-row justify-between items-center text-sm text-gray-500">
                        @if($setting->guidelines_reference)
                            <p class="mb-2 sm:mb-0">Referensi: {{ $setting->guidelines_reference }}</p>
                        @endif
                        @if($setting->guidelines_last_updated)
                            <p>Terakhir diperbarui: {{ $setting->guidelines_last_updated->format('d F Y') }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Compliance Section -->
        <div class="grid md:grid-cols-3 gap-6 mt-8">
            <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl p-6 text-center fade-in">
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <h4 class="font-semibold text-gray-900 mb-2">Keamanan Data</h4>
                <p class="text-sm text-gray-600">Sistem keamanan berlapis untuk melindungi data pengguna</p>
            </div>

            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl p-6 text-center fade-in">
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <h4 class="font-semibold text-gray-900 mb-2">Audit Berkala</h4>
                <p class="text-sm text-gray-600">Evaluasi rutin terhadap implementasi pedoman</p>
            </div>

            <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-xl p-6 text-center fade-in">
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"></path>
                    </svg>
                </div>
                <h4 class="font-semibold text-gray-900 mb-2">Transparansi</h4>
                <p class="text-sm text-gray-600">Keterbukaan dalam setiap proses editorial digital</p>
            </div>
        </div>

        <!-- Call to Action -->
    </div>
</div>

</x-layout>