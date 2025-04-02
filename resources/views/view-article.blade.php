<link rel="stylesheet" href="{{ asset('css/tiptap.css') }}">

<x-layout>

<!-- cover -->
<div class="max-w-screen-xl mx-auto p-5 sm:p-10 md:p-16 relative">
    <div class="bg-cover bg-center text-center overflow-hidden"
        style="min-height: 500px; background-image: url('{{ $viewarticle->thumbnail ? asset('storage/'.$viewarticle->thumbnail) : 'https://picsum.photos/seed/'.$viewarticle->id.'/800/450' }}')"
        title="{{ $viewarticle->title }}">
    </div>

    <!-- title -->
    <div class="max-w-3xl mx-auto">
        <div class="mt-3 bg-white rounded-b lg:rounded-b-none lg:rounded-r flex flex-col justify-between leading-normal">
            <div class="bg-white relative top-0 -mt-32 p-5 sm:p-10">
                <h1 href="#" class="text-gray-900 font-bold text-3xl mb-2">{{ $viewarticle->title }}</h1>

                <!-- Penulis -->
                <p class="text-gray-700 text-xs mt-2">Written By:
                    <a href="#"
                        class="text-indigo-600 font-medium hover:text-gray-900 transition duration-500 ease-in-out">
                        {{ $viewarticle->author->name }}
                
                <!-- category -->
                    </a> In
                    <a href="#"
                        class="text-xs text-indigo-600 font-medium hover:text-gray-900 transition duration-500 ease-in-out">
                        {{ $viewarticle->category->name }}
                    </a>
                </p>

                <!-- content -->
                <div class="tiptap-content my-5">
                {!! $viewarticle->content !!}
                </div>


                <!-- Tags -->
                @foreach ($viewarticle->tags as $tag)
                    <a href="{{ route('category.show', ['slug' => $viewarticle->slug]) }}"
                        class="text-xs text-indigo-600 font-medium hover:text-gray-900 transition duration-500 ease-in-out">
                        #{{ $tag->name }}
                    </a>
                @endforeach


                <div class="pt-5 dark:bg-slate-800flex items-center">
                    <div class="bg-gray-100 dark:bg-gray-700 relative shadow-xl overflow-hidden hover:shadow-2xl group rounded-xl p-5 transition-all duration-500 transform">
                        <div class="flex items-center gap-4">
                        <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w0NzEyNjZ8MHwxfHNlYXJjaHwyfHxhdmF0YXJ8ZW58MHwwfHx8MTY5MTg0NzYxMHww&ixlib=rb-4.0.3&q=80&w=1080"
                        class="w-32 group-hover:w-36 group-hover:h-36 h-32 object-center object-cover rounded-full transition-all duration-500 delay-500 transform"
                        />
                        <div class="w-fit transition-all transform duration-500">
                            <h1 class="text-gray-600 dark:text-gray-200 font-bold">
                            Mary Phiri
                            </h1>
                            <p class="text-gray-400">Senior Developer</p>
                            <a
                            class="text-xs text-gray-500 dark:text-gray-200 group-hover:opacity-100 opacity-0 transform transition-all delay-300 duration-500">
                            mary@gmail.com
                            </a>
                        </div>
                    </div>
                        <div class="absolute group-hover:bottom-1 delay-300 -bottom-16 transition-all duration-500 bg-gray-600 dark:bg-gray-100 right-1 rounded-lg">
                        <div class="flex justify-evenly items-center gap-2 p-1 text-2xl text-white dark:text-gray-600">
                            <svg viewBox="0 0 1024 1024" fill="currentColor" height="1em" width="1em">
                            <path
                                d="M512 64C264.6 64 64 264.6 64 512s200.6 448 448 448 448-200.6 448-448S759.4 64 512 64zm215.3 337.7c.3 4.7.3 9.6.3 14.4 0 146.8-111.8 315.9-316.1 315.9-63 0-121.4-18.3-170.6-49.8 9 1 17.6 1.4 26.8 1.4 52 0 99.8-17.6 137.9-47.4-48.8-1-89.8-33-103.8-77 17.1 2.5 32.5 2.5 50.1-2a111 111 0 01-88.9-109v-1.4c14.7 8.3 32 13.4 50.1 14.1a111.13 111.13 0 01-49.5-92.4c0-20.7 5.4-39.6 15.1-56a315.28 315.28 0 00229 116.1C492 353.1 548.4 292 616.2 292c32 0 60.8 13.4 81.1 35 25.1-4.7 49.1-14.1 70.5-26.7-8.3 25.7-25.7 47.4-48.8 61.1 22.4-2.4 44-8.6 64-17.3-15.1 22.2-34 41.9-55.7 57.6z" />
                            </svg>
                            <svg fill="currentColor" viewBox="0 0 16 16" height="1em" width="1em">
                            <path
                                d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
                            </svg>
                            <svg viewBox="0 0 960 1000" fill="currentColor" height="1em" width="1em">
                            <path
                                d="M480 20c133.333 0 246.667 46.667 340 140s140 206.667 140 340c0 132-46.667 245-140 339S613.333 980 480 980c-132 0-245-47-339-141S0 632 0 500c0-133.333 47-246.667 141-340S348 20 480 20M362 698V386h-96v312h96m-48-352c34.667 0 52-16 52-48s-17.333-48-52-48c-14.667 0-27 4.667-37 14s-15 20.667-15 34c0 32 17.333 48 52 48m404 352V514c0-44-10.333-77.667-31-101s-47.667-35-81-35c-44 0-76 16.667-96 50h-2l-6-42h-84c1.333 18.667 2 52 2 100v212h98V518c0-12 1.333-20 4-24 8-25.333 24.667-38 50-38 32 0 48 22.667 48 68v174h98" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            
                <section>
                <div class="mx-auto max-w-sm mt-5 border-4 border-indigo-600 shadow-[5px_5px_0_0_rgba(0,0,0,1)] shadow-indigo-600/100 max-w-5xl mx-5 p-4 md:p-10 flex flex-col items-center justify-center text-center">
                
                    <p class="text-indigo-900 text-xl md:text-2xl font-bold border-b-4 border-b-indigo-300">Share this post</p>

                    <ul class="flex flex-row items-center justify-center text-center mt-5">
                        <li class="mx-2">
                            <a href="" target="_blank" aria-label="Share on Twitter">
                                <svg class="h-8 text-indigo-700 hover:text-indigo-300" fill="currentColor" role="img"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <title>Twitter</title>
                                    <path
                                        d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z">
                                    </path>
                                </svg>
                            </a>
                        </li>

                        <li class="mx-2">
                            <a href="" target="_blank" aria-label="Share on LinkedIn">
                                <svg class="h-8 text-indigo-700 hover:text-indigo-300" fill="currentColor" role="img"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <title>LinkedIn</title>
                                    <path
                                        d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z">
                                    </path>
                                </svg>
                            </a>
                        </li>

                        <li class="mx-2">
                            <a href="" target="_blank" aria-label="Share on Mastodon">
                                <svg class="h-8 text-indigo-700 hover:text-indigo-300" fill="currentColor" role="img"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <title>Mastodon</title>
                                    <path
                                        d="M23.268 5.313c-.35-2.578-2.617-4.61-5.304-5.004C17.51.242 15.792 0 11.813 0h-.03c-3.98 0-4.835.242-5.288.309C3.882.692 1.496 2.518.917 5.127.64 6.412.61 7.837.661 9.143c.074 1.874.088 3.745.26 5.611.118 1.24.325 2.47.62 3.68.55 2.237 2.777 4.098 4.96 4.857 2.336.792 4.849.923 7.256.38.265-.061.527-.132.786-.213.585-.184 1.27-.39 1.774-.753a.057.057 0 0 0 .023-.043v-1.809a.052.052 0 0 0-.02-.041.053.053 0 0 0-.046-.01 20.282 20.282 0 0 1-4.709.545c-2.73 0-3.463-1.284-3.674-1.818a5.593 5.593 0 0 1-.319-1.433.053.053 0 0 1 .066-.054c1.517.363 3.072.546 4.632.546.376 0 .75 0 1.125-.01 1.57-.044 3.224-.124 4.768-.422.038-.008.077-.015.11-.024 2.435-.464 4.753-1.92 4.989-5.604.008-.145.03-1.52.03-1.67.002-.512.167-3.63-.024-5.545zm-3.748 9.195h-2.561V8.29c0-1.309-.55-1.976-1.67-1.976-1.23 0-1.846.79-1.846 2.35v3.403h-2.546V8.663c0-1.56-.617-2.35-1.848-2.35-1.112 0-1.668.668-1.67 1.977v6.218H4.822V8.102c0-1.31.337-2.35 1.011-3.12.696-.77 1.608-1.164 2.74-1.164 1.311 0 2.302.5 2.962 1.498l.638 1.06.638-1.06c.66-.999 1.65-1.498 2.96-1.498 1.13 0 2.043.395 2.74 1.164.675.77 1.012 1.81 1.012 3.12z">
                                    </path>
                                </svg>
                            </a>
                        </li>

                        <li class="mx-2">
                            <a href="" target="_blank" aria-label="Share on Facebook">
                                <svg class="h-8 text-indigo-700 hover:text-indigo-300" fill="currentColor" role="img"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <title>Facebook</title>
                                    <path
                                        d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z">
                                    </path>
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>
        </section>

            </div>
        </div>
    </div>
</div>  

</x-layout>
