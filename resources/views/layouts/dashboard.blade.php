<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | [PMS] Magnum Solusion</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

</head>
<body class="flex">
    <!-- Sidebar -->
    <aside class="w-64 bg-white border-r h-screen flex flex-col justify-between">
        <!-- Bagian atas sidebar -->
        <div class="overflow-y-auto py-4 px-3">
            <a href="/dashboard" class="flex items-center pl-2.5 mb-5">
                <img src="{{ asset('magnum-logo.png') }}" class="h-8 mr-3" alt="Logo">
                <span class="self-center text-xl font-semibold whitespace-normal break-words">PMS Magnum Solusion</span>
            </a>
            <ul class="space-y-2">
                @if (Auth::user()->role === 'ProjectManager')
                    <li>
                        <a href="/projects" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100">
                            <i class="fas fa-tasks w-5 h-5"></i>
                            <span class="ml-3">Projects</span>
                        </a>
                    </li>
                    <li>
                        <a href="/materials" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100">
                            <i class="fas fa-box w-5 h-5"></i>
                            <span class="ml-3">Materials</span>
                        </a>
                    </li>
                    <li>
                        <a href="/clients" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100">
                            <i class="fas fa-user-tie w-5 h-5"></i>
                            <span class="ml-3">Clients</span>
                        </a>
                    </li>
                    <li>
                        <a href="/users" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100">
                            <i class="fas fa-users w-5 h-5"></i>
                            <span class="ml-3">Users</span>
                        </a>
                    </li>
                    <li>
                        <a href="/reports" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100">
                            <i class="fas fa-chart-line w-5 h-5"></i>
                            <span class="ml-3">Reports</span>
                        </a>
                    </li>
                @elseif (Auth::user()->role === 'Engineer')
                    <li>
                        <a href="/projects" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100">
                            <i class="fas fa-tasks w-5 h-5"></i>
                            <span class="ml-3">Projects</span>
                        </a>
                    </li>
                    <li>
                        <a href="/materials" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100">
                            <i class="fas fa-box w-5 h-5"></i>
                            <span class="ml-3">Materials</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>

        <!-- Bagian bawah sidebar -->
        <div class="p-4 border-t">
            <p class="text-sm mb-2">Logged as: <strong>{{ Auth::user()->fullname }}</strong></p>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center gap-2 text-red-500 hover:underline text-sm">
                    <i class="fas fa-sign-out-alt"></i>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6">
        @yield('content')
    </main>
</body>
</html>
