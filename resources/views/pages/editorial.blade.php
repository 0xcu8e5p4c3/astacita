    <x-layout>

    <div class="bg-gradient-to-br from-blue-50 to-indigo-50 min-h-screen py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Header Section -->
            <div class="text-center mb-16">
                <h1 class="text-4xl font-bold text-gray-900 sm:text-5xl mb-4">
                    <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-indigo-600">Tim Redaksi</span>
                </h1>
                <div class="w-24 h-1 bg-gradient-to-r from-blue-500 to-indigo-600 mx-auto mb-6 rounded-full"></div>
                <p class="max-w-2xl mx-auto text-xl text-gray-600">
                    Kenali lebih dekat tim redaksi Astacita.co yang berdedikasi untuk menyajikan konten berkualitas
                </p>
            </div>

            <!-- Team Grid Layout -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @if(isset($settings['editorial_team']) && count($settings['editorial_team']) > 0)
                    @foreach($settings['editorial_team'] as $member)
                        <div class="group relative rounded-xl bg-white shadow-lg overflow-hidden transform transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
                            <!-- Card Top Decoration -->
                            <div class="h-2 bg-gradient-to-r from-blue-500 to-indigo-600"></div>
                            
                            <div class="p-6">
                                <!-- Photo with cool image frame -->
                                <div class="mb-6 flex justify-center">
                                    <div class="relative w-32 h-32 rounded-full overflow-hidden border-4 border-white shadow-md group-hover:scale-105 transition-transform duration-300">
                                        @if(isset($member['photo']) && $member['photo'])
                                            <img 
                                                src="{{ Storage::url($member['photo']) }}" 
                                                alt="{{ $member['name'] }}" 
                                                class="w-full h-full object-cover"
                                            >
                                        @else
                                            <div class="w-full h-full bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                                                <span class="text-gray-400 text-3xl">
                                                    {{ substr($member['name'] ?? 'User', 0, 1) }}
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                
                                <!-- Content -->
                                <div class="text-center">
                                    <h3 class="text-xl font-bold text-gray-900 mb-1">{{ $member['name'] ?? 'Nama tidak tersedia' }}</h3>
                                    <div class="text-indigo-600 font-medium mb-3">{{ $member['position'] ?? 'Jabatan tidak tersedia' }}</div>
                                    
                                    @if(isset($member['bio']) && $member['bio'])
                                        <p class="text-gray-600 mb-4 text-sm">{{ $member['bio'] }}</p>
                                    @endif
                                    
                                    @if(isset($member['email']) && $member['email'])
                                        <div class="flex justify-center mt-4">
                                            <a href="mailto:{{ $member['email'] }}" class="flex items-center text-indigo-600 hover:text-indigo-800 transition-colors duration-200">
                                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                                                </svg>
                                                <span class="text-sm">Kontak</span>
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Decorative element -->
                            <div class="absolute top-0 right-0 bg-gradient-to-bl from-blue-500 to-transparent w-12 h-12 opacity-0 group-hover:opacity-10 transition-opacity duration-300 rounded-bl-full"></div>
                        </div>
                    @endforeach
                @else
                    <div class="col-span-full text-center py-12">
                        <div class="bg-white rounded-lg shadow-md p-8">
                            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                            <p class="text-gray-500 text-lg">Data tim redaksi belum tersedia</p>
                            <p class="text-gray-400 text-sm mt-2">Silakan tambahkan data tim redaksi melalui panel admin</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    </x-layout>