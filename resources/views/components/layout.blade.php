<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    <x-navbar></x-navbar>

    <!-- Main Content -->
    <main class="container mx-auto px-6 pt-36 pb-14">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <x-footer></x-footer>

</body>
</html>
