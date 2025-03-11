<nav class="fixed top-0 left-0 w-full z-50">
    <!-- Navbar Atas (Breaking News, Tanggal, Login) -->
    <div class="bg-black text-white text-sm py-2 px-4 flex justify-between items-center">
        <div class="flex items-center">
            <span class="text-red-500 font-bold mr-2">• BREAKING:</span>
            <span>Through Their Vision, Determination, And Standards, The Winning</span>
        </div>
        <div class="flex items-center space-x-4">
            <span>March 4, 2025</span>
            <button class="text-white"><i class="fas fa-moon"></i></button>
            <button class="border px-3 py-1 rounded-full border-white hover:bg-white hover:text-black">
                Login/Signup
            </button>
        </div>
    </div>

    <div class="bg-[#F7FDC3] py-3 px-6 shadow-md">
        <div class="container mx-auto flex justify-between items-center">

            <a href="{{ url('/') }}" class="flex items-center">
                <img src="images/astacitalogo.png" alt="Logo" class="h-16">
            </a>

            <ul class="flex px-10 space-x-6 text-black font-medium">
                <li><a href="#" class="text-red-500">HOME</a></li>
                <li><a href="#" class="hover:text-red-500">AI</a></li>
                <li><a href="#" class="hover:text-red-500">CRYPTO</a></li>
                <li><a href="#" class="hover:text-red-500">START UP</a></li>
                <li><a href="#" class="hover:text-red-500">OKE GAS</a></li>
                <li><a href="#" class="hover:text-red-500">KABINET</a></li>
                <li><a href="#" class="hover:text-red-500">BUMN</a></li>
            </ul>

            <div class="relative">
                <input type="text" placeholder="Search" class="border rounded-full px-4 py-2 w-64">
                <i class="fas fa-search absolute right-4 top-3 text-gray-500"></i>
            </div>
        </div>
    </div>
</nav>
