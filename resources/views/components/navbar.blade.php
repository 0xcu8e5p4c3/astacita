<!-- Breaking News Banner -->
<div class="sticky top-0 left-0 w-full z-50 bg-black text-white text-sm py-2 px-4 flex justify-between items-center">
  <div class="flex items-center">
    <span class="text-red-500 mr-2">•</span>
    <span>BREAKING: Stay Updated with the Latest News and Trends!</span>
  </div>

  <div class="flex items-center gap-4">
    <span id="currentDate" class="text-sm font-medium text-gray-300"></span>
    <div class="h-4 w-[1px] bg-gray-500"></div>

    @if(\Filament\Facades\Filament::auth()->check())
      <!-- Jika user sudah login, tampilkan Profile Dropdown -->
      <div class="relative group">
        <button class="text-white text-sm font-medium flex items-center hover:text-red-500 transition">
          {{ \Filament\Facades\Filament::auth()->user()->name }}
          <svg class="ml-2 w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
          </svg>
        </button>

        <div class="absolute right-0 mt-2 w-40 bg-white text-black rounded-md shadow-lg hidden group-hover:block">
          <a href="" class="block px-4 py-2 hover:bg-gray-200">Dashboard</a>
          <a href="" class="block px-4 py-2 hover:bg-gray-200">Profile</a>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-200">Logout</button>
          </form>
        </div>
      </div>
    @else
      <!-- Jika belum login -->
      <button onclick="window.location.href='{{ route('filament.astacita.auth.login') }}'" class="text-white text-sm font-medium hover:text-red-500 transition">
        Log In
      </button>
      <button onclick="window.location.href='{{ route('filament.astacita.auth.register') }}'" class="text-zinc-100 rounded-full px-4 py-1 bg-zinc-950 text-sm font-medium flex items-center transition border border-zinc-700 relative overflow-hidden group">
        Sign Up
        <svg class="inline-block ml-2 group-hover:translate-x-1 transition duration-700" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24">
          <path fill="currentColor" d="M13.3 17.275q-.3-.3-.288-.725t.313-.725L16.15 13H5q-.425 0-.713-.288T4 12q0-.425.288-.713T5 11h11.15L13.325 8.175q-.3-.3-.313-.725t.288-.725q.3-.3.725-.288t.725.313l4.15 4.15q.15.15.213.325t.063.375q0 .2-.063.375t-.213.325l-4.15 4.15q-.3.3-.725.313t-.725-.288Z"/>
        </svg>
      </button>
    @endif
  </div>
</div>

<!-- Header Utama -->
<div class="sticky top-10 left-0 w-full z-40 flex items-center justify-between h-20 bg-[#E4FF9A] px-4">
  <div class="flex items-center gap-2">
    <img src="{{ asset('images/astacitalogo.png') }}" alt="Company Logo" class="h-10 w-auto" />
  </div>

  <div class="flex-1 flex justify-center min-w-[120px]">
    <div class="flex items-center justify-center text-black text-xs font-semibold bg-white rounded-full backdrop-blur-sm px-4 py-1 border">
      @foreach(['home', 'ai', 'crypto', 'startup', 'okegas', 'kabinet', 'bumn'] as $route)
        <button onclick="window.location.href='{{ route($route) }}'" class="hover:text-red-500 transition duration-700 px-3 py-1 rounded-full">
          {{ ucfirst($route) }}
        </button>
      @endforeach
    </div>
  </div>

  <!-- Search Box -->
  <div class="relative bg-white rounded-3xl w-auto h-auto border border-gray-300">
    <input type="text" placeholder="Search" class="rounded-full text-black px-4 py-2 pr-10 focus:outline-none"/>
    <i class="fas fa-search absolute right-3 top-3 text-gray-500"></i>
  </div>
</div>

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
  });
</script>
