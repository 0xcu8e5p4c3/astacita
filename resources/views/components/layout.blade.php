<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @livewireScripts

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

</body>
</html>
