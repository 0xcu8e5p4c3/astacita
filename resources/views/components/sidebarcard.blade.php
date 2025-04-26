<html>
<head>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <style>
    /* Menghilangkan scrollbar tapi tetap bisa discroll */
    .hide-scrollbar {
      scrollbar-width: none; /* Firefox */
      -ms-overflow-style: none; /* IE 11 */
    }
    .hide-scrollbar::-webkit-scrollbar {
      display: none; /* Chrome, Safari, Edge */
    }
  </style>
</head>
<body class="bg-gray-100 text-gray-800 flex">

  <!-- Sidebar -->
  <div class="w-80 h-screen sticky top-0 overflow-y-auto hide-scrollbar p-6 bg-white rounded-lg">
    
    <!-- Ad Section -->
    <div class="bg-green-200 flex items-center justify-center mb-6 rounded-lg h-[600px]">
      <span class="text-gray-700 font-semibold">Iklan</span>
    </div>

    <!-- Short Stories Section -->
    <h2 class="text-xl font-bold mb-4 border-b-2 pb-2">Short Stories</h2>
      <div class="space-y-4">
        @foreach ($articles as $article)
        <div class="flex space-x-4 hover:bg-gray-100 p-2 rounded-lg transition">
          <a href="{{ route('article.show', ['categorySlug' => $article->category->slug, 'articleSlug' => $article->slug]) }}" class="flex space-x-4 w-full">
            <img class="w-20 h-20 object-cover rounded-lg shadow" src="{{ $article->thumbnail ? asset('storage/'.$article->thumbnail) : 'https://picsum.photos/seed/'.$article->id.'/800/450' }}" alt="{{ $article->title }}">
            <div>
              <h3 class="font-semibold text-gray-900">
                <span class="hover:text-blue-600 transition duration-300">{{ $article->title }}</span>
              </h3>
              <p class="text-sm text-gray-600">{{ $article->created_at->format('d M Y') }}</p>
            </div>
          </a>
        </div>
        @endforeach
</div>



    <!-- Newsletter Section -->
    <div class="bg-[#E4FF9A] p-6 mt-8 text-center text-black rounded-lg shadow-lg">
  <h2 class="text-xl font-bold mb-2">Join Our Newsletter</h2>
  <p class="mb-4 text-sm opacity-90">Get the latest updates straight to your inbox</p>
  <input class="w-full p-3 mb-3 border border-gray-300 rounded-lg text-gray-900 bg-white focus:ring-2 focus:ring-green-400 focus:outline-none" placeholder="Your email address" type="email">
  <button class="bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded-lg w-full font-semibold transition-all duration-300 shadow-md hover:shadow-lg">Subscribe</button>
</div>


    <!-- Recommended Tags Section -->
    <div class="mt-8">
  <h2 class="text-xl font-bold mb-4 border-b-2 pb-2">Recommended Topics</h2>
  <div class="flex flex-wrap gap-3">
    @foreach ($tags as $tag)
    <a href="{{ route('article.show', ['categorySlug' => $article->category->slug, 'articleSlug' => $article->slug]) }}" 
       class="bg-gray-300 px-4 py-1.5 rounded-lg text-xs font-semibold text-gray-700 hover:bg-blue-600 hover:text-white transition-colors duration-300 shadow-sm hover:shadow-md">
      {{ $tag->name }}
    </a>
    @endforeach
  </div>
</div>




    <!-- Follow Us Section -->
    <div class="mt-8 text-center">
      <h2 class="text-xl font-bold mb-4 border-b-2 pb-2">Follow Us</h2>
      <div class="flex justify-center space-x-4">
        <a class="text-blue-600 hover:text-blue-800 transition text-2xl" href="#"><i class="fab fa-facebook-f"></i></a>
        <a class="text-blue-400 hover:text-blue-600 transition text-2xl" href="#"><i class="fab fa-twitter"></i></a>
        <a class="text-pink-600 hover:text-pink-800 transition text-2xl" href="#"><i class="fab fa-instagram"></i></a>
        <a class="text-red-600 hover:text-red-800 transition text-2xl" href="#"><i class="fab fa-youtube"></i></a>
      </div>
    </div>

  </div>

  <!-- Content Area -->

</body>
</html>
