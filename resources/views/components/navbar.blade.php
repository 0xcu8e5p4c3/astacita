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
          <a href="{{ route('dashboard') }}" class="block px-4 py-2 hover:bg-gray-200">Dashboard</a>
          <a href="{{ route('profile') }}" class="block px-4 py-2 hover:bg-gray-200">Profile</a>
          <a href="{{ route('subscription') }}" class="block px-4 py-2 hover:bg-gray-200">Subscription</a>
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
<div id="mobileSlideMenu" class="fixed top-0 left-0 h-full w-9/12 max-w-xs bg-white transform -translate-x-full transition-transform duration-500 ease-in-out z-50 overflow-y-auto">
  <!-- Header dengan Close Button -->
  <div class="flex justify-between items-center p-4 border-b border-gray-100">
    <div class="flex items-center">
      <img src="{{ asset('images/astacitalogo.png') }}" alt="Logo" class="h-8" />
    </div>
    <button id="closeMobileMenu" class="text-gray-700 hover:text-red-500 transition">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
      </svg>
    </button>
  </div>

  <div class="flex flex-col px-4 py-6">
    <!-- Mobile Search -->
    <form action="{{ route('search') }}" method="GET" class="mb-6">
      <div class="relative">
        <input type="text" name="query" class="w-full h-11 rounded-xl border border-gray-200 px-4 pr-12 focus:ring-2 focus:ring-teal-200 focus:border-teal-300 text-sm bg-gray-50" placeholder="Search articles...">
        <button type="submit" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-teal-600 transition">
          <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
          </svg>
        </button>
      </div>
    </form>

    <!-- Navigation Menu -->
    <div class="space-y-1 mb-6">
      <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">Navigation</h3>
      @foreach([
          ['route' => 'home', 'slug' => null, 'label' => 'Home', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
          ['route' => 'category.show', 'slug' => 'ai', 'label' => 'AI', 'icon' => 'M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2z'],
          ['route' => 'category.show', 'slug' => 'crypto', 'label' => 'Crypto', 'icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
          ['route' => 'category.show', 'slug' => 'start-up', 'label' => 'Startup', 'icon' => 'M13 10V3L4 14h7v7l9-11h-7z'],
          ['route' => 'category.show', 'slug' => 'oke-gas', 'label' => 'OkeGas', 'icon' => 'M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z'],
          ['route' => 'category.show', 'slug' => 'kabinet', 'label' => 'Kabinet', 'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4'],
          ['route' => 'category.show', 'slug' => 'bumn', 'label' => 'BUMN', 'icon' => 'M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M10.5 3L12 2l1.5 1H21v6H3V3h7.5z']
      ] as $data)
        @php
          $isActive = ($data['slug'] === null) 
            ? request()->routeIs($data['route']) 
            : (request()->routeIs($data['route']) && request()->slug == $data['slug']);
        @endphp
        <a href="{{ $data['slug'] ? route($data['route'], ['slug' => $data['slug']]) : route($data['route']) }}"
           class="flex items-center px-3 py-3 rounded-lg transition-all duration-200 group {{ 
             $isActive 
               ? 'bg-red-50 text-red-600 border-l-4 border-red-500' 
               : 'text-gray-700 hover:bg-gray-50 hover:text-red-500'
           }}">
          <svg class="w-5 h-5 mr-3 {{ 
            $isActive 
              ? 'text-red-500' 
              : 'text-gray-400 group-hover:text-red-400'
          }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $data['icon'] }}"/>
          </svg>
          <span class="font-medium">{{ $data['label'] }}</span>
          @if($isActive)
            <div class="ml-auto w-2 h-2 bg-red-500 rounded-full"></div>
          @endif
        </a>
      @endforeach
    </div>

    <!-- User Section -->
    @if(\Filament\Facades\Filament::auth()->check())
      <div class="border-t border-gray-100 pt-6">
        <!-- User Dropdown Trigger -->
        <button id="userDropdownTrigger" class="w-full bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl p-4 mb-4 flex items-center justify-between hover:from-gray-100 hover:to-gray-200 transition-all duration-200">
          <div class="flex items-center">
            <div class="w-10 h-10 bg-red-500 rounded-full flex items-center justify-center text-white font-semibold text-sm">
              {{ substr(\Filament\Facades\Filament::auth()->user()->name, 0, 1) }}
            </div>
            <div class="ml-3 flex-1 text-left">
              <p class="font-semibold text-gray-900 text-sm">{{ \Filament\Facades\Filament::auth()->user()->name }}</p>
              <p class="text-xs text-gray-500">Welcome back!</p>
            </div>
          </div>
          <svg id="userDropdownArrow" class="w-4 h-4 text-gray-400 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
          </svg>
        </button>

        <!-- User Dropdown Menu -->
        <div id="userDropdownMenu" class="space-y-1 overflow-hidden transition-all duration-300 max-h-0 opacity-0">
          <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3 px-3">Account</h3>
          
          <a href="{{ route('dashboard') }}" class="flex items-center px-3 py-3 rounded-lg text-gray-700 hover:bg-gray-50 hover:text-red-500 transition-all duration-200 group">
            <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
            </svg>
            <span class="font-medium">Dashboard</span>
          </a>

          <a href="{{ route('profile') }}" class="flex items-center px-3 py-3 rounded-lg text-gray-700 hover:bg-gray-50 hover:text-red-500 transition-all duration-200 group">
            <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
            <span class="font-medium">Profile</span>
          </a>

          <a href="{{ route('subscription') }}" class="flex items-center px-3 py-3 rounded-lg text-gray-700 hover:bg-gray-50 hover:text-red-500 transition-all duration-200 group">
            <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
            </svg>
            <span class="font-medium">Subscription</span>
          </a>

          <!-- Logout Button -->
          <form method="POST" action="{{ route('logout') }}" class="mt-4">
            @csrf
            <button type="submit" class="w-full flex items-center px-3 py-3 rounded-lg text-red-600 hover:bg-red-50 transition-all duration-200 group">
              <svg class="w-5 h-5 mr-3 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
              </svg>
              <span class="font-medium">Logout</span>
            </button>
          </form>
        </div>
      </div>
    @else
      <!-- Login Section for Guest -->
      <div class="border-t border-gray-100 pt-6">
        <div class="bg-gradient-to-r from-gray-900 to-gray-800 rounded-xl p-4 text-white text-center">
          <h3 class="font-semibold mb-2">Join Our Community</h3>
          <p class="text-sm text-gray-300 mb-4">Get access to exclusive content and features</p>
          <a href="{{ route('login') }}" class="inline-flex items-center justify-center w-full bg-white text-gray-900 px-4 py-2 rounded-lg font-medium hover:bg-gray-100 transition">
            Login
            <svg class="ml-2 w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
            </svg>
          </a>
        </div>
      </div>
    @endif
  </div>
</div>

<!-- Overlay -->
<div id="mobileOverlay" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm z-40 hidden transition-opacity duration-300"></div>

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

/* Smooth scrolling for mobile menu */
#mobileSlideMenu {
  scrollbar-width: none;
  -ms-overflow-style: none;
}
#mobileSlideMenu::-webkit-scrollbar {
  display: none;
}

/* Enhanced transitions */
#mobileSlideMenu {
  box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
}

/* Active state animation */
.mobile-menu-item.active {
  animation: slideInActive 0.3s ease-out;
}

/* User dropdown animation */
#userDropdownMenu.show {
  max-height: 300px;
  opacity: 1;
  padding-bottom: 0;
}

#userDropdownMenu {
  transition: max-height 0.3s ease-out, opacity 0.3s ease-out;
}

#userDropdownArrow.rotated {
  transform: rotate(180deg);
}

@keyframes slideInActive {
  from {
    transform: translateX(-5px);
    opacity: 0.8;
  }
  to {
    transform: translateX(0);
    opacity: 1;
  }
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

  const openMenu = () => {
    mobileSlideMenu.classList.remove('-translate-x-full');
    mobileOverlay.classList.remove('hidden');
    document.body.style.overflow = 'hidden'; // Prevent background scrolling
  };

  const closeMenu = () => {
    mobileSlideMenu.classList.add('-translate-x-full');
    mobileOverlay.classList.add('hidden');
    document.body.style.overflow = ''; // Restore scrolling
  };

  openMobileMenu.addEventListener('click', openMenu);
  closeMobileMenu.addEventListener('click', closeMenu);
  mobileOverlay.addEventListener('click', closeMenu);

  // Close menu on escape key
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && !mobileSlideMenu.classList.contains('-translate-x-full')) {
      closeMenu();
    }
  });

  // Add smooth transitions to menu items
  const menuItems = document.querySelectorAll('#mobileSlideMenu a');
  menuItems.forEach((item, index) => {
    item.style.transitionDelay = `${index * 50}ms`;
  });

  // User dropdown functionality
  const userDropdownTrigger = document.getElementById('userDropdownTrigger');
  const userDropdownMenu = document.getElementById('userDropdownMenu');
  const userDropdownArrow = document.getElementById('userDropdownArrow');

  if (userDropdownTrigger && userDropdownMenu && userDropdownArrow) {
    userDropdownTrigger.addEventListener('click', () => {
      const isOpen = userDropdownMenu.classList.contains('show');
      
      if (isOpen) {
        userDropdownMenu.classList.remove('show');
        userDropdownArrow.classList.remove('rotated');
      } else {
        userDropdownMenu.classList.add('show');
        userDropdownArrow.classList.add('rotated');
      }
    });
  }
});
</script>