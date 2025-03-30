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
          <a href="{{ route('profile') }}" class="block px-4 py-2 hover:bg-gray-200">Profile</a>
          <a href="" class="block px-4 py-2 hover:bg-gray-200">Subscription</a>
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

  <div class="relative w-full max-w-sm mx-auto bg-white rounded-full">
  <form action="{{ route('search') }}" method="GET" class="relative">
    <input placeholder="e.g. Blog" class="rounded-full w-full h-10 bg-transparent py-1 pl-6 pr-24 outline-none border border-gray-300 shadow-sm hover:outline-none focus:ring-teal-200 focus:border-teal-200 text-sm" type="text" name="query" id="query">
    <button type="submit" class="absolute inline-flex items-center h-8 px-3 py-1 text-xs text-white transition duration-150 ease-in-out rounded-full outline-none right-2 top-9 transform -translate-y-1/2 bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
      <svg class="mr-1 w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
      </svg>
      Search
    </button>
    </form>
</div>

  <!-- <div class="relative bg-white rounded-3xl w-auto h-auto border border-gray-300">
    <form action="{{ route('search') }}" method="GET" class="relative">
        <input type="text" name="q" placeholder="Search..." value="{{ request('q') }}" class="rounded-full text-black px-4 py-2 pr-10 w-full focus:outline-none"/>
        <button type="submit" class="absolute right-3 top-2 text-gray-500">
            <i class="fas fa-search"></i>
        </button>
    </form>
</div> -->

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
