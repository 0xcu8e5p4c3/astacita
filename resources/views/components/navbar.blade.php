<div class="fixed top-0 left-0 w-full z-50 flex items-center justify-between h-16 bg-[#E4FF9A] px-4">
<div class="flex items-center gap-2">
        <img src="{{ asset('images/astacitalogo.png') }}" alt="Company Logo" class="h-10 w-auto" />
  </div>
  
  <div class="flex-1 flex justify-center min-w-[120px]">
    <div class="flex items-center justify-center text-black text-xs font-semibold bg-white rounded-full backdrop-blur-sm px-4 py-1 border">
      <button onclick="window.location.href='{{ route('home') }}'" class="hover:text-red-500 transition duration-700 px-3 py-1 rounded-full">Home</button>
      <button onclick="window.location.href='{{ route('ai') }}'" class="hover:text-red-500 transition px-3 py-1 duration-700 rounded-full">AI</button>
      <button onclick="window.location.href='{{ route('crypto') }}'" class="hover:text-red-500 transition px-3 py-1 duration-700 rounded-full">Crypto</button>
      <button onclick="window.location.href='{{ route('startup') }}'" class="hover:text-red-500 transition px-3 py-1 duration-700 rounded-full">Start Up</button>
      <button onclick="window.location.href='{{ route('okegas') }}'" class="hover:text-red-500 transition px-3 py-1 duration-700 rounded-full">Oke Gas</button>
      <button onclick="window.location.href='{{ route('kabinet') }}'" class="hover:text-red-500 transition px-3 py-1 duration-700 rounded-full">Kabinet</button>
      <button onclick="window.location.href='{{ route('bumn') }}'" class="hover:text-red-500 transition px-3 py-1 duration-700 rounded-full">BUMN</button>
    </div>
  </div>
  
  <div class="flex items-center gap-2">
    <button class="text-black text-sm font-medium hover:text-red-500 transition">Log In</button>
    <button class="text-zinc-100 rounded-full px-4 py-1 bg-zinc-950 text-sm font-medium flex items-center transition border border-zinc-700 relative overflow-hidden group">
      Sign Up
      <svg class="inline-block ml-2 group-hover:translate-x-1 transition duration-700" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24">
        <path fill="currentColor" d="M13.3 17.275q-.3-.3-.288-.725t.313-.725L16.15 13H5q-.425 0-.713-.288T4 12q0-.425.288-.713T5 11h11.15L13.325 8.175q-.3-.3-.313-.725t.288-.725q.3-.3.725-.288t.725.313l4.15 4.15q.15.15.213.325t.063.375q0 .2-.063.375t-.213.325l-4.15 4.15q-.3.3-.725.313t-.725-.288Z"/>
      </svg>
    </button>
  </div>
</div>