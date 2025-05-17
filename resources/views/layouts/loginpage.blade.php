<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>[PMS] Magnum Solusion</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet">
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

            <!-- Dropdown Menu (Flowbite Component) -->
            <div class="relative">
                <button id="dropdownButton" data-dropdown-toggle="dropdownMenu" class="text-sm text-gray-600 hover:underline">
                    How to use?
                </button>
                <div id="dropdownMenu" class="hidden z-10 w-44 bg-white rounded shadow dark:bg-gray-700">
                    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownButton">
                        <li>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Documentation</a>
                        </li>
                        <li>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Support</a>
                        </li>
                    </ul>
                </div>
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
