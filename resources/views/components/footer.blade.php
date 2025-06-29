<footer class="bg-black text-white py-10">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-5 gap-8">
            <!-- Kolom 1: Logo & Deskripsi -->
            <div class="col-span-2">
                <a href="{{ url('/') }}" class="flex items-center mb-4">
                    <img src="images/astacitalogo.png" alt="Logo" class="h-12">
                </a>
                <p class="text-gray-400 text-sm">
                    Astacita adalah portal berita digital terpercaya yang menghadirkan informasi akurat, berimbang, dan terkini seputar teknologi, crypto, AI, dan dunia inovasi untuk masyarakat Indonesia.
                </p>

                <!-- Social Media -->
                <div class="mt-4">
                    <p class="font-semibold">Follow Us</p>
                    <div class="flex space-x-3 mt-2">
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-tiktok"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>

                <!-- App Store & Play Store -->
                <!-- <div class="mt-4 flex space-x-2">
                    <img src="/app-store.png" alt="App Store" class="h-10">
                    <img src="/google-play.png" alt="Google Play" class="h-10">
                </div> -->
            </div>

            <!-- Kolom 2: Top News -->
            <div>
                <h3 class="font-semibold mb-4">Top News</h3>
                <ul class="text-gray-400 text-sm space-y-2">
                    <li><a href="#" class="hover:text-white">Top Lifestyle Blog</a></li>
                    <li><a href="#" class="hover:text-white">Top 5 Travel Places</a></li>
                    <li><a href="#" class="hover:text-white">Top 10 Exercise</a></li>
                    <li><a href="#" class="hover:text-white">Top Mobile Accessories</a></li>
                    <li><a href="#" class="hover:text-white">Top Mobile Gadgets</a></li>
                    <li><a href="#" class="hover:text-white">Top Healthy Breakfast</a></li>
                </ul>
            </div>

            <!-- Kolom 3: Pages -->
            <div class="col-span-1">
                <h3 class="font-semibold mb-4">Pages</h3>
                <ul class="text-gray-400 text-sm space-y-2">
                    @foreach($categories as $category)
                        <li><a href="{{ url('pages/'.$category->slug) }}" class="hover:text-white">{{ $category->name }}</a></li>
                    @endforeach
                </ul>
            </div>


            <!-- Kolom 4: Useful Links -->
            <div>
                <h3 class="font-semibold mb-4">Useful Links</h3>
                <ul class="text-gray-400 text-sm space-y-2">
                    <li><a href="{{ route('about') }}" class="hover:text-white">Tentang Astacita.co</a></li>
                    <li><a href="{{ route('editorial') }}" class="hover:text-white">Redaksi</a></li>
                    <li><a href="{{ route('ethics-code') }}" class="hover:text-white">Kode Etik</a></li>
                    <li><a href="{{ route('cyber-guidelines') }}" class="hover:text-white">Pedoman Media Cyber</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-white">Kontak</a></li>
                </ul>
            </div>

        <!-- Copyright -->
        <div class="border-t border-gray-700 mt-8 pt-4 text-center text-gray-400 text-sm">
            © 2025. All rights reserved by <a href="#" class="text-white">Astacita</a>.
        </div>
    </div>
</footer>
