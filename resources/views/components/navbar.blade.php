<!-- Breaking News & User Info -->
<div class="sticky top-0 left-0 w-full z-50 bg-black text-white text-sm py-2 px-4 flex justify-between items-center">
  <!-- Left: Breaking Text (hidden on mobile) -->
  <div class="hidden md:flex items-center">
    <span class="text-red-500 mr-2">•</span>
    <span>BREAKING: Stay Updated with the Latest News and Trends!</span>
  </div>

  <!-- Right: Date & Auth -->
  <div class="flex items-center gap-4 ml-auto">
    <span id="currentDate" class="text-sm font-medium text-gray-300"></span>
    <div class="h-4 w-[1px] bg-gray-500 hidden md:block"></div>

    @if(\Filament\Facades\Filament::auth()->check())
      <!-- User Menu (Desktop Only) -->
      <div class="relative group hidden md:block">
        <button class="text-white text-sm font-medium flex items-center hover:text-red-500 transition">
          {{ \Filament\Facades\Filament::auth()->user()->name }}
          <svg class="ml-2 w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
          </svg>
        </button>
        <div class="absolute right-0 mt-2 w-40 bg-white text-black rounded-md shadow-lg hidden group-hover:block z-50">
          <a href="" class="block px-4 py-2 hover:bg-gray-200">Dashboard</a>
          <a href="{{ route('profile') }}" class="block px-4 py-2 hover:bg-gray-200">Profile</a>
          <a href="" class="block px-4 py-2 hover:bg-gray-200">Subscription</a>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-200">Logout</button>
          </form>
        </div>
      </div>
    @else
      <!-- Login Button (Visible on all) -->
      <button onclick="window.location.href='{{ route('login') }}'" class="text-zinc-100 rounded-full px-4 py-1 bg-zinc-950 text-sm font-medium flex items-center transition border border-zinc-700 relative overflow-hidden group">
        Login
        <svg class="inline-block ml-2 group-hover:translate-x-1 transition duration-700" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24">
          <path fill="currentColor" d="M13.3 17.275q-.3-.3-.288-.725t.313-.725L16.15 13H5q-.425 0-.713-.288T4 12q0-.425.288-.713T5 11h11.15L13.325 8.175q-.3-.3-.313-.725t.288-.725q.3-.3.725-.288t.725.313l4.15 4.15q.15.15.213.325t.063.375q0 .2-.063.375t-.213.325l-4.15 4.15q-.3.3-.725.313t-.725-.288Z"/>
        </svg>
      </button>
    @endif
  </div>
</div>

<!-- Header Utama -->
<div class="sticky top-[40px] left-0 w-full z-40 bg-[#E4FF9A] px-4 py-2 flex items-center justify-between h-20">

  <!-- Mobile Hamburger Menu -->
  <div class="md:hidden">
    <button id="menuToggleMobile" class="p-2 rounded-full bg-white border border-gray-300">
      <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
      </svg>
    </button>

    <!-- Dropdown Mobile Menu -->
    <div id="mobileMenuDropdown" class="absolute top-20 left-4 w-40 bg-white shadow rounded-md hidden z-50">
      @foreach([
          ['route' => 'home', 'slug' => null, 'label' => 'Home'],
          ['route' => 'category.show', 'slug' => 'ai', 'label' => 'AI'],
          ['route' => 'category.show', 'slug' => 'crypto', 'label' => 'Crypto'],
          ['route' => 'category.show', 'slug' => 'start-up', 'label' => 'Startup'],
          ['route' => 'category.show', 'slug' => 'oke-gas', 'label' => 'OkeGas'],
          ['route' => 'category.show', 'slug' => 'kabinet', 'label' => 'Kabinet'],
          ['route' => 'category.show', 'slug' => 'bumn', 'label' => 'BUMN']
      ] as $data)
        <a href="{{ $data['slug'] ? route($data['route'], ['slug' => $data['slug']]) : route($data['route']) }}"
           class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
          {{ $data['label'] }}
        </a>
      @endforeach
    </div>
  </div>

  <!-- Logo Tengah -->
  <div class="flex-shrink-0 mx-auto md:mx-0">
    <img src="{{ asset('images/astacitalogo.png') }}" alt="Company Logo" class="h-10" />
  </div>

  <!-- Mobile Search Icon -->
  <div class="relative md:hidden">
    <button id="searchToggleMobile" class="p-2 rounded-full bg-white border border-gray-300">
      <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
      </svg>
    </button>

    <form id="searchFormMobile" action="{{ route('search') }}" method="GET"
          class="absolute right-0 mt-2 w-64 hidden bg-white border border-gray-300 rounded-full shadow px-4 py-1 z-50">
      <input name="query" type="text" placeholder="Search..." class="w-full h-8 text-sm outline-none bg-transparent" />
    </form>
  </div>

  <!-- Desktop Nav + Search on Right -->
  <div class="hidden md:flex items-center justify-center w-full">
  <!-- Nav Menu -->
  <div class="flex items-center justify-center text-black text-xs font-semibold bg-white rounded-full backdrop-blur-sm px-4 py-1 border mx-auto">
    @foreach([
        ['route' => 'home', 'slug' => null, 'label' => 'Home'],
        ['route' => 'category.show', 'slug' => 'ai', 'label' => 'AI'],
        ['route' => 'category.show', 'slug' => 'crypto', 'label' => 'Crypto'],
        ['route' => 'category.show', 'slug' => 'start-up', 'label' => 'Startup'],
        ['route' => 'category.show', 'slug' => 'oke-gas', 'label' => 'OkeGas'],
        ['route' => 'category.show', 'slug' => 'kabinet', 'label' => 'Kabinet'],
        ['route' => 'category.show', 'slug' => 'bumn', 'label' => 'BUMN']
    ] as $data)
      <button onclick="window.location.href='{{ $data['slug'] ? route($data['route'], ['slug' => $data['slug']]) : route($data['route']) }}'" 
              class="hover:text-red-500 transition duration-700 px-3 py-1 rounded-full">
        {{ $data['label'] }}
      </button>
    @endforeach
  </div>
</div>


    <!-- Search Pojok Kanan -->
    <div class="relative ml-auto w-4/12">
      <form action="{{ route('search') }}" method="GET" class="relative">
        <input placeholder="e.g. Blog" class="rounded-full w-full h-10 bg-white py-1 pl-6 pr-24 outline-none border border-gray-300 shadow-sm focus:ring-teal-200 focus:border-teal-200 text-sm" type="text" name="query">
        <button type="submit" class="absolute inline-flex items-center h-8 px-3 py-1 text-xs text-white transition duration-150 ease-in-out rounded-full right-2 top-1 bg-teal-600 hover:bg-teal-700">
          <svg class="mr-1 w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
          </svg>
          Search
        </button>
      </form>
    </div>
  </div>
</div>

<!-- JS: Tanggal + Menu Toggle -->
<script>
document.addEventListener('DOMContentLoaded', () => {
  const dateElement = document.getElementById('currentDate');
  const updateDate = () => {
    const now = new Date();
    dateElement.textContent = now.toLocaleDateString('en-US', {
      weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'
    });
  };
  updateDate();
  setInterval(updateDate, 60000);

  // Menu Toggle for Mobile
  const menuToggleMobile = document.getElementById('menuToggleMobile');
  const mobileMenuDropdown = document.getElementById('mobileMenuDropdown');
  if (menuToggleMobile && mobileMenuDropdown) {
    menuToggleMobile.addEventListener('click', () => {
      mobileMenuDropdown.classList.toggle('hidden');
    });
  }

  // Search Toggle for Mobile
  const searchToggleMobile = document.getElementById('searchToggleMobile');
  const searchFormMobile = document.getElementById('searchFormMobile');
  if (searchToggleMobile && searchFormMobile) {
    searchToggleMobile.addEventListener('click', () => {
      searchFormMobile.classList.toggle('hidden');
    });
  }
});

</script>
