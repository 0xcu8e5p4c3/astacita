<footer class="bg-black text-white py-10">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-5 gap-8">
            <!-- Kolom 1: Logo & Deskripsi -->
            <div class="col-span-2">
                <a href="{{ url('/') }}" class="flex items-center mb-4">
                    <img src="images/astacitalogo.png" alt="Logo" class="h-12"> <!-- Ganti dengan logo yang sesuai -->
                </a>
                <p class="text-gray-400 text-sm">
                    Expert insights, industry trends, and inspiring stories that help you live and work on your own terms.
                </p>
                <p class="text-gray-400 text-sm">Fusce varius, dolor tempor interdum.</p>

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
                <div class="mt-4 flex space-x-2">
                    <img src="/app-store.png" alt="App Store" class="h-10">
                    <img src="/google-play.png" alt="Google Play" class="h-10">
                </div>
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
                    <li><a href="#" class="hover:text-white">About</a></li>
                    <li><a href="#" class="hover:text-white">Team</a></li>
                    <li><a href="#" class="hover:text-white">Contact</a></li>
                    <li><a href="#" class="hover:text-white">Archive</a></li>
                    <li><a href="#" class="hover:text-white">Single News</a></li>
                    <li><a href="#" class="hover:text-white">Archive News</a></li>
                </ul>
            </div>

        <!-- Copyright -->
        <div class="border-t border-gray-700 mt-8 pt-4 text-center text-gray-400 text-sm">
            © 2025. All rights reserved by <a href="#" class="text-white">Astacita</a>.
        </div>
    </div>
</footer>
