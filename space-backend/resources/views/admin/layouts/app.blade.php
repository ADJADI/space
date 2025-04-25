<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Space Admin')</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body class="bg-gray-100">
    <nav class="bg-blue-600 fixed top-0 w-full z-50 shadow-md">
        <div class="flex items-center justify-between">
            <a class="text-white font-bold p-4 block" href="{{ route('admin.dashboard') }}">SPACE ADMIN</a>
            <button class="md:hidden p-4 text-white" type="button" id="sidebarMenuBtn">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            <div class="flex items-center">
                <form action="{{ route('logout') }}" method="POST" class="px-3">
                    @csrf
                    <button type="submit" class="text-white flex items-center space-x-1 bg-transparent border-0 p-2 hover:bg-blue-700 rounded">
                        <span>Logout</span>
                        <i class="bi bi-box-arrow-right"></i>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="flex mt-14">
        <nav id="sidebarMenu" class="bg-gray-900 text-white w-64 fixed h-full pt-4 md:block hidden">
            <div class="overflow-y-auto h-full">
                <ul class="space-y-2 px-2">
                    <li>
                        <a class="px-4 py-3 rounded flex items-center text-gray-300 hover:bg-gray-800 hover:text-white {{ request()->routeIs('admin.dashboard') ? 'bg-gray-800 text-blue-400' : '' }}" href="{{ route('admin.dashboard') }}">
                            <i class="bi bi-speedometer2 mr-3"></i>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a class="px-4 py-3 rounded flex items-center text-gray-300 hover:bg-gray-800 hover:text-white {{ request()->routeIs('admin.destinations.*') ? 'bg-gray-800 text-blue-400' : '' }}" href="{{ route('admin.destinations.index') }}">
                            <i class="bi bi-globe mr-3"></i>
                            Destinations
                        </a>
                    </li>
                    <li>
                        <a class="px-4 py-3 rounded flex items-center text-gray-300 hover:bg-gray-800 hover:text-white {{ request()->routeIs('admin.crew.*') ? 'bg-gray-800 text-blue-400' : '' }}" href="{{ route('admin.crew.index') }}">
                            <i class="bi bi-people mr-3"></i>
                            Crew Members
                        </a>
                    </li>
                    <li>
                        <a class="px-4 py-3 rounded flex items-center text-gray-300 hover:bg-gray-800 hover:text-white {{ request()->routeIs('admin.technologies.*') ? 'bg-gray-800 text-blue-400' : '' }}" href="{{ route('admin.technologies.index') }}">
                            <i class="bi bi-gear mr-3"></i>
                            Technologies
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <main class="md:ml-64 flex-1 px-4 py-8">
            <div class="flex justify-between items-center pb-4 mb-6 border-b">
                <h1 class="text-2xl font-semibold">@yield('header', 'Dashboard')</h1>
                <div>@yield('header_buttons')</div>
            </div>

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                    <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none'">
                        <svg class="h-4 w-4 fill-current" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/>
                        </svg>
                    </button>
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                    <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none'">
                        <svg class="h-4 w-4 fill-current" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/>
                        </svg>
                    </button>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarMenuBtn = document.getElementById('sidebarMenuBtn');
            const sidebarMenu = document.getElementById('sidebarMenu');
            
            sidebarMenuBtn.addEventListener('click', function() {
                sidebarMenu.classList.toggle('hidden');
            });
        });
    </script>
    @yield('scripts')
</body>
</html> 