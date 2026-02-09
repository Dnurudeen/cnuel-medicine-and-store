<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') - C-Nuel Medicine and Store</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            200: '#bbf7d0',
                            300: '#86efac',
                            400: '#4ade80',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                            800: '#166534',
                            900: '#14532d',
                        },
                        secondary: {
                            50: '#f7fee7',
                            100: '#ecfccb',
                            200: '#d9f99d',
                            300: '#bef264',
                            400: '#a3e635',
                            500: '#84cc16',
                            600: '#65a30d',
                            700: '#4d7c0f',
                            800: '#3f6212',
                            900: '#365314',
                        }
                    }
                }
            }
        }
    </script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Sortable.js for drag and drop -->
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    @stack('styles')
</head>

<body class="bg-gray-100 min-h-screen" x-data="{ sidebarOpen: true }">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'w-64' : 'w-20'"
            class="bg-gray-800 text-white transition-all duration-300 flex flex-col">
            <!-- Logo -->
            <div class="h-16 flex items-center justify-center border-b border-gray-700">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center">
                    <span x-show="sidebarOpen" class="text-xl font-bold text-primary-400">C-Nuel Admin</span>
                    <span x-show="!sidebarOpen" class="text-xl font-bold text-primary-400">CN</span>
                </a>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center px-4 py-3 rounded-lg hover:bg-gray-700 transition {{ request()->routeIs('admin.dashboard') ? 'bg-primary-600' : '' }}">
                    <i class="fas fa-tachometer-alt w-6"></i>
                    <span x-show="sidebarOpen" class="ml-3">Dashboard</span>
                </a>

                <a href="{{ route('admin.products.index') }}"
                    class="flex items-center px-4 py-3 rounded-lg hover:bg-gray-700 transition {{ request()->routeIs('admin.products.*') ? 'bg-primary-600' : '' }}">
                    <i class="fas fa-box w-6"></i>
                    <span x-show="sidebarOpen" class="ml-3">Products</span>
                </a>

                <a href="{{ route('admin.categories.index') }}"
                    class="flex items-center px-4 py-3 rounded-lg hover:bg-gray-700 transition {{ request()->routeIs('admin.categories.*') ? 'bg-primary-600' : '' }}">
                    <i class="fas fa-tags w-6"></i>
                    <span x-show="sidebarOpen" class="ml-3">Categories</span>
                </a>

                <a href="{{ route('admin.orders.index') }}"
                    class="flex items-center px-4 py-3 rounded-lg hover:bg-gray-700 transition {{ request()->routeIs('admin.orders.*') ? 'bg-primary-600' : '' }}">
                    <i class="fas fa-shopping-bag w-6"></i>
                    <span x-show="sidebarOpen" class="ml-3">Orders</span>
                </a>

                <a href="{{ route('admin.pages.index') }}"
                    class="flex items-center px-4 py-3 rounded-lg hover:bg-gray-700 transition {{ request()->routeIs('admin.pages.*') ? 'bg-primary-600' : '' }}">
                    <i class="fas fa-file-alt w-6"></i>
                    <span x-show="sidebarOpen" class="ml-3">Pages</span>
                </a>

                <a href="{{ route('admin.settings.index') }}"
                    class="flex items-center px-4 py-3 rounded-lg hover:bg-gray-700 transition {{ request()->routeIs('admin.settings.*') ? 'bg-primary-600' : '' }}">
                    <i class="fas fa-cog w-6"></i>
                    <span x-show="sidebarOpen" class="ml-3">Settings</span>
                </a>

                @if (auth()->guard('admin')->user()->is_super_admin)
                    <a href="{{ route('admin.admins.index') }}"
                        class="flex items-center px-4 py-3 rounded-lg hover:bg-gray-700 transition {{ request()->routeIs('admin.admins.*') ? 'bg-primary-600' : '' }}">
                        <i class="fas fa-users-cog w-6"></i>
                        <span x-show="sidebarOpen" class="ml-3">Admin Users</span>
                    </a>
                @endif
            </nav>

            <!-- View Site -->
            <div class="px-4 py-4 border-t border-gray-700">
                <a href="{{ route('home') }}" target="_blank"
                    class="flex items-center px-4 py-3 rounded-lg hover:bg-gray-700 transition text-gray-400">
                    <i class="fas fa-external-link-alt w-6"></i>
                    <span x-show="sidebarOpen" class="ml-3">View Site</span>
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Header -->
            <header class="bg-white shadow-sm h-16 flex items-center justify-between px-6">
                <div class="flex items-center">
                    <button @click="sidebarOpen = !sidebarOpen" class="text-gray-500 hover:text-gray-700">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <h1 class="ml-4 text-xl font-semibold text-gray-800">@yield('header', 'Dashboard')</h1>
                </div>

                <div class="flex items-center space-x-4">
                    <span class="text-gray-600">{{ auth()->guard('admin')->user()->name }}</span>
                    <form action="{{ route('admin.logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-gray-500 hover:text-red-600 transition">
                            <i class="fas fa-sign-out-alt"></i>
                        </button>
                    </form>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-6">
                <!-- Flash Messages -->
                @if (session('success'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                        role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                        role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>

</html>
