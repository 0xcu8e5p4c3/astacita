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
      <div class="flex space-x-4 hover:bg-gray-100 p-2 rounded-lg transition">
        <img class="w-20 h-20 object-cover rounded-lg shadow" src="https://placehold.co/100x100" alt="Story 1">
        <div>
          <h3 class="font-semibold text-gray-900">More Than 2,000 Nominees Have Been Recognized</h3>
          <p class="text-sm text-gray-600">6 min read</p>
        </div>
      </div>
      <div class="flex space-x-4 hover:bg-gray-100 p-2 rounded-lg transition">
        <img class="w-20 h-20 object-cover rounded-lg shadow" src="https://placehold.co/100x100" alt="Story 2">
        <div>
          <h3 class="font-semibold text-gray-900">Through Their Vision, Determination, And Sacrifices</h3>
          <p class="text-sm text-gray-600">6 min read</p>
        </div>
      </div>
    </div>

    <!-- Newsletter Section -->
    <div class="bg-green-500 p-6 mt-8 text-center text-white rounded-lg shadow-lg">
      <h2 class="text-xl font-bold mb-2">Join Our Newsletter</h2>
      <p class="mb-4 text-sm">Get the latest updates straight to your inbox</p>
      <input class="w-full p-2 mb-3 border rounded text-black" placeholder="Your email address" type="email">
      <button class="bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded-lg w-full font-semibold transition">Subscribe</button>
    </div>

    <!-- Recommended Topics Section -->
    <div class="mt-8">
      <h2 class="text-xl font-bold mb-4 border-b-2 pb-2">Recommended Topics</h2>
      <div class="flex flex-wrap gap-2">
        <span class="bg-gray-300 px-3 py-1 rounded-lg text-sm font-semibold">Education</span>
        <span class="bg-gray-300 px-3 py-1 rounded-lg text-sm font-semibold">Food</span>
        <span class="bg-gray-300 px-3 py-1 rounded-lg text-sm font-semibold">Science</span>
        <span class="bg-gray-300 px-3 py-1 rounded-lg text-sm font-semibold">Health</span>
        <span class="bg-gray-300 px-3 py-1 rounded-lg text-sm font-semibold">Technology</span>
        <span class="bg-gray-300 px-3 py-1 rounded-lg text-sm font-semibold">Music</span>
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
  <div class="flex-1 p-6">
    <h1 class="text-2xl font-bold">Main Content</h1>
    <p>Ini adalah area konten utama. Sidebar berada di sebelah kiri dan bisa discroll secara independen.</p>
    <div class="h-auto bg-gray-200 mt-4"></div>
  </div>

</body>
</html>
