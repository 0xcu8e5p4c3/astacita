<div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-6xl mx-auto">
    <!-- Bagian Kiri: 2 Kartu -->
    <div class="md:col-span-2 flex flex-col gap-4">
        <!-- Kartu 1 -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl transition-all duration-300 hover:shadow-lg">
            <div class="md:flex">
                <div class="md:shrink-0">
                    <img class="h-48 w-full object-cover md:h-full md:w-48" src="https://loremflickr.com/320/240/team">
                </div>
                <div class="p-8">
                    <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">Company Retreats</div>
                    <a href="#" class="block mt-1 text-lg leading-tight font-medium text-black relative group">
                        Incredible accommodation for your team
                        <span class="absolute left-0 bottom-0 w-0 h-[2px] bg-indigo-500 transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <p class="mt-2 text-slate-500">
                        Looking to take your team away on a retreat to enjoy awesome food and take in some sunshine?
                    </p>
                </div>
            </div>
        </div>

        <!-- Kartu 2 -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl transition-all duration-300 hover:shadow-lg">
            <div class="md:flex">
                <div class="md:shrink-0">
                    <img class="h-48 w-full object-cover md:h-full md:w-48" src="https://loremflickr.com/320/240/nature">
                </div>
                <div class="p-8">
                    <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">Nature Getaway</div>
                    <a href="#" class="block mt-1 text-lg leading-tight font-medium text-black relative group">
                        A perfect retreat for relaxation
                        <span class="absolute left-0 bottom-0 w-0 h-[2px] bg-indigo-500 transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <p class="mt-2 text-slate-500">
                        Escape the city hustle and relax in a peaceful nature retreat.
                    </p>
                </div>
            </div>
        </div>

        <!-- Kartu Artikel -->
        <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
            <a href="#">
                <img class="rounded-t-lg" src="/docs/images/blog/image-1.jpg" alt="" />
            </a>
            <div class="p-5">
                <a href="#">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                        Noteworthy technology acquisitions 2021
                    </h5>
                </a>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                    Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order.
                </p>
                <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Read more
                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <!-- Bagian Kanan: Sidebar -->
    <div class="w-full md:w-80">
        <x-sidebarcard />
    </div>
</div>
