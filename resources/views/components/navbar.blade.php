<div class="sticky top-0 left-0 w-full z-50">
<!-- Breaking News Bar -->
<div id="breaking-bar" class="top-0 left-0 w-full z-50 bg-black text-white text-sm py-2 px-4 flex justify-between items-center">
  <div class="hidden md:flex items-center">
    <span class="text-red-500 mr-2">•</span>
    <span>BREAKING: Stay Updated with the Latest News and Trends!</span>
  </div>

  <div class="flex items-center gap-4 ml-auto">
    <span id="currentDate" class="text-sm font-medium text-gray-300"></span>
    <div class="h-4 w-[1px] bg-gray-500 hidden md:block"></div>

    @if(\Filament\Facades\Filament::auth()->check())
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
      <button onclick="window.location.href='{{ route('login') }}'" class="text-zinc-100 rounded-full px-4 py-1 bg-zinc-950 text-sm font-medium flex items-center transition border border-zinc-700 relative overflow-hidden group">
        Login
        <svg class="inline-block ml-2 group-hover:translate-x-1 transition duration-700" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24">
          <path fill="currentColor" d="M13.3 17.275q-.3-.3-.288-.725t.313-.725L16.15 13H5q-.425 0-.713-.288T4 12q0-.425.288-.713T5 11h11.15L13.325 8.175q-.3-.3-.313-.725t.288-.725q.3-.3.725-.288t.725.313l4.15 4.15q.15.15.213.325t.063.375q0 .2-.063.375t-.213.325l-4.15 4.15q-.3.3-.725.313t-.725-.288Z"/>
        </svg>
      </button>
    @endif
  </div>
</div>

<!-- Header -->
<div class="left-0 w-full z-40 bg-[#E4FF9A] px-4 py-2 flex items-center justify-between h-20" style="top:48px">

  <!-- Mobile Hamburger -->
  <div class="md:hidden flex items-center">
    <button id="openMobileMenu" class="p-2 rounded-full bg-white border border-gray-300">
      <svg class="w-10 h-6 text-gray-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
      </svg>
    </button>
  </div>

  <!-- Logo Tengah -->
  <div onclick="window.location.href='{{ route('home') }}'" class="flex-shrink-0 mx-auto md:mx-0">
    <img src="{{ asset('images/astacitalogo.png') }}" alt="Company Logo" class="h-10" />
  </div>
  <!-- Desktop Menu & Search -->
  <div class="hidden md:flex items-center justify-center w-full">
    <div class="flex items-center text-black text-xs font-semibold bg-white rounded-full backdrop-blur-sm px-4 py-1 border mx-auto">
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


  <!-- Desktop Search -->
  <div class="relative ml-auto w-4/12 hidden md:block">
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
<!-- Mobile Slide Menu -->
<div id="mobileSlideMenu" class="fixed top-0 left-0 h-full w-9/12 max-w-xs bg-white transform -translate-x-full transition-transform duration-500 ease-in-out z-50">
  <div class="flex justify-end p-4">
    <button id="closeMobileMenu" class="text-gray-700">
      <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
      </svg>
    </button>
  </div>

  <div class="flex flex-col items-center space-y-6 mt-10 text-center">
    <!-- Mobile Search -->
    <form action="{{ route('search') }}" method="GET" class="w-10/12">
      <div class="relative">
        <input type="text" name="query" class="w-full h-10 rounded-full border border-gray-300 px-4 pr-10 focus:ring-teal-200 focus:border-teal-200 text-sm" placeholder="Search...">
        <button type="submit" class="absolute right-2 top-2 text-gray-500 hover:text-teal-600">
          <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
          </svg>
        </button>
      </div>
    </form>

    <!-- Mobile Menu Items -->
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
     class="relative">
     
    <span class="
      inline-flex justify-center items-center
      w-24 h-8
      text-base font-semibold 
      rounded-md
      transition
      {{ 
        (request()->routeIs($data['route']) && (is_null($data['slug']) || request()->slug == $data['slug'])) 
          ? 'bg-red-500 text-white' 
          : 'text-gray-800 hover:text-red-500'
      }}
    ">
      {{ $data['label'] }}
    </span>

  </a>
@endforeach


    @if(\Filament\Facades\Filament::auth()->check())
      <div class="mt-8 text-gray-700">
        <p class="text-sm">Logged in as</p>
        <p class="font-bold">{{ \Filament\Facades\Filament::auth()->user()->name }}</p>
        <form method="POST" action="{{ route('logout') }}" class="mt-4">
          @csrf
          <button type="submit" class="text-red-500 hover:underline">Logout</button>
        </form>
      </div>
    @else
      <div class="mt-8">
        <a href="{{ route('login') }}" class="bg-black text-white px-6 py-2 rounded-full text-sm hover:bg-gray-800 transition">
          Login
        </a>
      </div>
    @endif
  </div>
</div>


<!-- Overlay -->
<div id="mobileOverlay" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm z-40 hidden"></div>

<!-- Extra Styling -->
<style>
#mobileMenuDropdown, #searchFormMobile {
  transition: all 0.3s ease;
}
#mobileMenuDropdown a {
  border-bottom: 1px solid #f3f3f3;
}
#mobileMenuDropdown a:last-child {
  border-bottom: none;
}
#mobileMenuDropdown.show, #searchFormMobile.show {
  display: block !important;
  opacity: 1;
  transform: translateY(0);
}
#mobileMenuDropdown, #searchFormMobile {
  opacity: 0;
  transform: translateY(-10px);
}
body.menu-open::before {
  content: '';
  position: fixed;
  inset: 0;
  background: rgba(0,0,0,0.4);
  z-index: 40;
}
.menu-open #menuToggleMobile svg path:nth-child(1) {
  transform: rotate(45deg) translate(5px, 5px);
}
.menu-open #menuToggleMobile svg path:nth-child(2) {
  opacity: 0;
}
.menu-open #menuToggleMobile svg path:nth-child(3) {
  transform: rotate(-45deg) translate(5px, -5px);
}
</style>

<!-- Javascript Functionality -->
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

  const openMobileMenu = document.getElementById('openMobileMenu');
  const closeMobileMenu = document.getElementById('closeMobileMenu');
  const mobileSlideMenu = document.getElementById('mobileSlideMenu');
  const mobileOverlay = document.getElementById('mobileOverlay');

  openMobileMenu.addEventListener('click', () => {
    mobileSlideMenu.classList.remove('-translate-x-full');
    mobileOverlay.classList.remove('hidden');
  });

  closeMobileMenu.addEventListener('click', () => {
    mobileSlideMenu.classList.add('-translate-x-full');
    mobileOverlay.classList.add('hidden');
  });

  mobileOverlay.addEventListener('click', () => {
    mobileSlideMenu.classList.add('-translate-x-full');
    mobileOverlay.classList.add('hidden');
  });
});
</script>