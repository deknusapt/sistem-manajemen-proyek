<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>[PMS] Magnum Solusion</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="bg-gray-100 text-gray-900">

    <!-- Header -->
    <header class="bg-white shadow">
        <div class="mx-auto px-4 py-4 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <!-- Logo -->
                <img src="../magnum-logo.png" alt="Logo" class="w-8 h-8">
                <span class="text-lg font-semibold text-gray-800">PMS Magnum Solusion</span>
            </div>

            <div>
                <a href="#" class="text-sm text-gray-600 hover:underline">How to use?</a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="min-h-screen flex items-center justify-center">
        @yield('content')
    </main>

    <!-- Flowbite JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
</body>
</html>
