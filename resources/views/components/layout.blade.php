<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @livewireScripts
    <title>@yield('title') {{ App\Models\WebsiteSetting::get('site_name', 'Astacita.com') }} </title>
    <meta name="description" content="@yield('description', App\Models\WebsiteSetting::get('site_tagline', 'Portal Berita Terpercaya'))">
    <link rel="icon" href="{{ App\Models\WebsiteSetting::getInstance()->site_favicon_url ?? asset('images/logotitle.png') }}">

    <!-- <link rel="icon" href="{{ asset('images/logotitle.png') }}"> -->
     <!-- <title>{{ config('app.name', 'Astacita') }}</title> -->
</head>
<body class="bg-white">

    <!-- Navbar -->
    <x-navbar></x-navbar>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-4 sm:px-6 sm:py-8 md:px-10 md:py-10 lg:px-20 lg:py-[20px]">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <x-footer></x-footer>

    <!-- Tracking Script -->
    <script src="{{ asset('js/tracking.js') }}"></script>

    <!-- Optional: Manual tracking untuk event khusus -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Track klik pada link artikel
            document.querySelectorAll('a[href*="/artikel/"]').forEach(link => {
                link.addEventListener('click', function () {
                    if (window.tracker) {
                        window.tracker.trackEvent('article_link_click', {
                            url: this.href,
                            title: this.textContent.trim()
                        });
                    }
                });
            });

            // Track scroll depth
            let maxScroll = 0;
            window.addEventListener('scroll', function () {
                const scrollPercent = Math.round((window.scrollY / (document.body.scrollHeight - window.innerHeight)) * 100);
                if (scrollPercent > maxScroll) {
                    maxScroll = scrollPercent;

                    if (scrollPercent >= 25 && scrollPercent < 50 && maxScroll >= 25) {
                        window.tracker?.trackEvent('scroll_depth', { depth: '25%' });
                    } else if (scrollPercent >= 50 && scrollPercent < 75 && maxScroll >= 50) {
                        window.tracker?.trackEvent('scroll_depth', { depth: '50%' });
                    } else if (scrollPercent >= 75 && maxScroll >= 75) {
                        window.tracker?.trackEvent('scroll_depth', { depth: '75%' });
                    }
                }
            });

            // Track button clicks
            document.querySelectorAll('button, .btn').forEach(button => {
                button.addEventListener('click', function () {
                    const buttonText = this.textContent.trim() || this.getAttribute('aria-label') || 'Unknown Button';
                    window.tracker?.trackEvent('button_click', {
                        button_text: buttonText,
                        button_class: this.className
                    });
                });
            });
        });
    </script>
</body>
</html>
