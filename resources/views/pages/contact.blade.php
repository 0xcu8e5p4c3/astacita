<x-layout>

<div class="min-h-screen bg-white dark:bg-neutral-900 py-16 px-4">
  <div class="max-w-6xl mx-auto">

    <!-- Header -->
    <div class="text-center mb-16">
      <h1 class="text-5xl font-light tracking-tight text-black dark:text-white mb-3">
        <span class="font-bold">Connect</span> With Us
      </h1>
      <div class="h-px w-16 mx-auto bg-black dark:bg-white mb-6"></div>
      <p class="text-lg text-neutral-600 dark:text-neutral-400 max-w-xl mx-auto">
        We value your input and are ready to assist with any inquiries.
      </p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-5 gap-12">
      
      <!-- Contact Info -->
      <div class="lg:col-span-2 order-2 lg:order-1 space-y-12">
        <div>
          <h2 class="text-2xl font-light tracking-tight mb-8 text-black dark:text-white">
            Contact Details
          </h2>
          <div class="space-y-8">

            <!-- Email -->
            <div class="flex items-center space-x-6 group transition-all duration-300 ease-out">
              <div class="h-12 w-12 flex items-center justify-center rounded-full bg-neutral-100 dark:bg-neutral-800 transition-colors duration-300 group-hover:bg-black group-hover:text-white dark:group-hover:bg-white dark:group-hover:text-black">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                  <polyline points="22,6 12,13 2,6"></polyline>
                </svg>
              </div>
              <div class="transform transition-transform duration-300 group-hover:translate-x-1">
                <p class="text-sm text-neutral-500 dark:text-neutral-400 mb-1">Email</p>
                <a href="mailto:contact@example.com" class="text-black dark:text-white text-lg transition-colors duration-300 group-hover:text-neutral-600 dark:group-hover:text-neutral-300">
                  contact@example.com
                </a>
              </div>
            </div>

            <!-- Phone -->
            <div class="flex items-center space-x-6 group transition-all duration-300 ease-out">
              <div class="h-12 w-12 flex items-center justify-center rounded-full bg-neutral-100 dark:bg-neutral-800 transition-colors duration-300 group-hover:bg-black group-hover:text-white dark:group-hover:bg-white dark:group-hover:text-black">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                </svg>
              </div>
              <div class="transform transition-transform duration-300 group-hover:translate-x-1">
                <p class="text-sm text-neutral-500 dark:text-neutral-400 mb-1">Phone</p>
                <a href="tel:+1234567890" class="text-black dark:text-white text-lg transition-colors duration-300 group-hover:text-neutral-600 dark:group-hover:text-neutral-300">
                  +1 (234) 567-890
                </a>
              </div>
            </div>

            <!-- Address -->
            <div class="flex items-center space-x-6 group transition-all duration-300 ease-out">
              <div class="h-12 w-12 flex items-center justify-center rounded-full bg-neutral-100 dark:bg-neutral-800 transition-colors duration-300 group-hover:bg-black group-hover:text-white dark:group-hover:bg-white dark:group-hover:text-black">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                  <circle cx="12" cy="10" r="3"></circle>
                </svg>
              </div>
              <div class="transform transition-transform duration-300 group-hover:translate-x-1">
                <p class="text-sm text-neutral-500 dark:text-neutral-400 mb-1">Address</p>
                <p class="text-black dark:text-white text-lg">
                  123 Business Street, San Francisco, CA 94103
                </p>
              </div>
            </div>

          </div>
        </div>

        <!-- Social Media -->
        <div>
          <h2 class="text-2xl font-light tracking-tight mb-8 text-black dark:text-white">
            Connect
          </h2>
          <div class="flex flex-wrap gap-5">
            <!-- Social Icons with Hover Effects -->
            <a href="https://facebook.com" target="_blank" rel="noopener noreferrer" 
               class="h-10 w-10 flex items-center justify-center rounded-full bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-400 hover:bg-black hover:text-white dark:hover:bg-white dark:hover:text-black transition-colors duration-300">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
              </svg>
            </a>
            <a href="https://twitter.com" target="_blank" rel="noopener noreferrer" 
               class="h-10 w-10 flex items-center justify-center rounded-full bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-400 hover:bg-black hover:text-white dark:hover:bg-white dark:hover:text-black transition-colors duration-300">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path>
              </svg>
            </a>
            <a href="https://instagram.com" target="_blank" rel="noopener noreferrer" 
               class="h-10 w-10 flex items-center justify-center rounded-full bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-400 hover:bg-black hover:text-white dark:hover:bg-white dark:hover:text-black transition-colors duration-300">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
              </svg>
            </a>
            <a href="https://youtube.com" target="_blank" rel="noopener noreferrer" 
               class="h-10 w-10 flex items-center justify-center rounded-full bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-400 hover:bg-black hover:text-white dark:hover:bg-white dark:hover:text-black transition-colors duration-300">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z"></path>
                <polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"></polygon>
              </svg>
            </a>
            <a href="https://linkedin.com" target="_blank" rel="noopener noreferrer" 
               class="h-10 w-10 flex items-center justify-center rounded-full bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-400 hover:bg-black hover:text-white dark:hover:bg-white dark:hover:text-black transition-colors duration-300">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
                <rect x="2" y="9" width="4" height="12"></rect>
                <circle cx="4" cy="4" r="2"></circle>
              </svg>
            </a>
          </div>
        </div>
      </div>

      <!-- Contact Form -->
      <div class="lg:col-span-3 order-1 lg:order-2">
        <div class="bg-white dark:bg-neutral-800 border border-neutral-100 dark:border-neutral-700 shadow-sm rounded-lg overflow-hidden">
          <div class="p-8">
            <h2 class="text-2xl font-light tracking-tight mb-8 text-black dark:text-white">
              Send Message
            </h2>
            <form class="space-y-6">
              <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div class="space-y-2">
                  <label for="name" class="text-sm font-medium text-neutral-600 dark:text-neutral-400">Full Name</label>
                  <input id="name" placeholder="John Doe" 
                    class="h-12 w-full rounded-md border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-900 text-black dark:text-white focus:ring-1 focus:ring-black dark:focus:ring-white focus:border-black dark:focus:border-white transition-colors duration-200" />
                </div>
                <div class="space-y-2">
                  <label for="email" class="text-sm font-medium text-neutral-600 dark:text-neutral-400">Email Address</label>
                  <input id="email" type="email" placeholder="john@example.com" 
                    class="h-12 w-full rounded-md border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-900 text-black dark:text-white focus:ring-1 focus:ring-black dark:focus:ring-white focus:border-black dark:focus:border-white transition-colors duration-200" />
                </div>
              </div>

              <div class="space-y-2">
                <label for="subject" class="text-sm font-medium text-neutral-600 dark:text-neutral-400">Subject</label>
                <input id="subject" placeholder="How can we help you?" 
                  class="h-12 w-full rounded-md border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-900 text-black dark:text-white focus:ring-1 focus:ring-black dark:focus:ring-white focus:border-black dark:focus:border-white transition-colors duration-200" />
              </div>

              <div class="space-y-2">
                <label for="message" class="text-sm font-medium text-neutral-600 dark:text-neutral-400">Message</label>
                <textarea id="message" placeholder="Your message..." 
                  class="min-h-[180px] w-full rounded-md border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-900 text-black dark:text-white focus:ring-1 focus:ring-black dark:focus:ring-white focus:border-black dark:focus:border-white transition-colors duration-200 resize-none"></textarea>
              </div>

              <div class="pt-4">
                <button type="submit" 
                  class="w-full h-12 bg-black hover:bg-neutral-800 text-white dark:bg-white dark:text-black dark:hover:bg-neutral-200 transition-colors duration-200 rounded-md flex items-center justify-center group">
                  <span class="mr-2">Send Message</span>
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transform transition-transform duration-200 group-hover:translate-x-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                  </svg>
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Google Map -->
    <div class="mt-16">
      <div class="h-[400px] w-full overflow-hidden rounded-lg border border-neutral-100 dark:border-neutral-700">
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.8451454384627!2d-122.41941482357244!3d37.77492901908435!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8085809c6c8f4459%3A0xb10ed6d9b5050fa5!2s123%20Street%2C%20San%20Francisco%2C%20CA%2094103!5e0!3m2!1sen!2sus!4v1652209098581!5m2!1sen!2sus"
          width="100%"
          height="100%"
          style="border:0;"
          allowfullscreen
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"
          class="grayscale transition-all duration-700 hover:grayscale-0"
          title="Our location">
        </iframe>
      </div>
    </div>
  </div>
</div>

<style>
  /* Simple fade-in animation for page elements */
  @keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
  }
  
  .min-h-screen {
    animation: fadeIn 0.8s ease-in-out;
  }
</style>

</x-layout>