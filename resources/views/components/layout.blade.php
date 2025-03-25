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
    <main class="container mx-auto px-20 pb-[30px] ">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <x-footer></x-footer>

</body>
</html>
