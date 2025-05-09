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
        <div>
            <div class="p-4 font-bold text-xl flex items-center gap-2">
                <a href="/dashboard" class="flex items-center gap-2">
                    <img src="../favicon.ico" alt="Logo" class="w-8 h-8"> PMS Magnum Solusion
                </a>
            </div>
            <nav class="mt-4 flex flex-col text-left text-gray-700">
                @if (Auth::user()->role === 'ProjectManager')
                    <a href="/projects" class="px-4 py-2 hover:bg-gray-100 flex items-center gap-2">
                        <i class="fas fa-tasks w-5 h-5"></i> <!-- Ikon untuk Projects -->
                        Projects
                    </a>
                    <a href="/materials" class="px-4 py-2 hover:bg-gray-100 flex items-center gap-2">
                        <i class="fas fa-box w-5 h-5"></i> <!-- Ikon untuk Materials -->
                        Materials
                    </a>
                    <a href="/clients" class="px-4 py-2 hover:bg-gray-100 flex items-center gap-2">
                        <i class="fas fa-user-tie w-5 h-5"></i> <!-- Ikon untuk Clients -->
                        Clients
                    </a>
                    <a href="/users" class="px-4 py-2 hover:bg-gray-100 flex items-center gap-2">
                        <i class="fas fa-users w-5 h-5"></i> <!-- Ikon untuk Users -->
                        Users
                    </a>
                    <a href="/reports" class="px-4 py-2 hover:bg-gray-100 flex items-center gap-2">
                        <i class="fas fa-chart-line w-5 h-5"></i> <!-- Ikon untuk Reports -->
                        Reports
                    </a>
                @elseif (Auth::user()->role === 'Engineer')
                    <a href="/projects" class="px-4 py-2 hover:bg-gray-100 flex items-center gap-2">
                        <i class="fas fa-tasks w-5 h-5"></i> <!-- Ikon untuk Projects -->
                        Projects
                    </a>
                    <a href="/materials" class="px-4 py-2 hover:bg-gray-100 flex items-center gap-2">
                        <i class="fas fa-box w-5 h-5"></i> <!-- Ikon untuk Materials -->
                        Materials
                    </a>
                @endif
            </nav>
        </div>

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
