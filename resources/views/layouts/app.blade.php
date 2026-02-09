<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'C-Nuel Medicine and Store')</title>
    <meta name="description" content="@yield('description', 'Your trusted source for quality medicines and healthcare products.')">

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

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    @stack('styles')
</head>

<body class="bg-gray-50 min-h-screen flex flex-col">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg sticky top-0 z-50" x-data="{ mobileMenuOpen: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <!-- Logo -->
                    <a href="{{ route('home') }}" class="flex-shrink-0 flex items-center">
                        <img src="{{ asset('images/logo.png') }}" alt="C-Nuel Medicine and Store" class="h-10 w-auto"
                            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        <div class="hidden items-center">
                            <span class="text-2xl font-bold text-primary-600">C-</span>
                            <span class="text-2xl font-bold text-secondary-500">N.M.S</span>
                        </div>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}"
                        class="text-gray-700 hover:text-primary-600 font-medium transition {{ request()->routeIs('home') ? 'text-primary-600' : '' }}">Home</a>
                    <a href="{{ route('shop') }}"
                        class="text-gray-700 hover:text-primary-600 font-medium transition {{ request()->routeIs('shop') ? 'text-primary-600' : '' }}">Shop</a>
                    <a href="{{ route('about') }}"
                        class="text-gray-700 hover:text-primary-600 font-medium transition {{ request()->routeIs('about') ? 'text-primary-600' : '' }}">About</a>
                    <a href="{{ route('contact') }}"
                        class="text-gray-700 hover:text-primary-600 font-medium transition {{ request()->routeIs('contact') ? 'text-primary-600' : '' }}">Contact</a>
                </div>

                <!-- Cart -->
                <div class="flex items-center space-x-4">
                    <a href="{{ route('cart.index') }}"
                        class="relative p-2 text-gray-700 hover:text-primary-600 transition">
                        <i class="fas fa-shopping-cart text-xl"></i>
                        <span id="cart-count"
                            class="absolute -top-1 -right-1 bg-primary-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                            {{ array_sum(session()->get('cart', [])) }}
                        </span>
                    </a>

                    <!-- Mobile menu button -->
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden p-2 text-gray-700">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation -->
        <div x-show="mobileMenuOpen" x-cloak class="md:hidden bg-white border-t">
            <div class="px-4 py-3 space-y-2">
                <a href="{{ route('home') }}" class="block py-2 text-gray-700 hover:text-primary-600">Home</a>
                <a href="{{ route('shop') }}" class="block py-2 text-gray-700 hover:text-primary-600">Shop</a>
                <a href="{{ route('about') }}" class="block py-2 text-gray-700 hover:text-primary-600">About</a>
                <a href="{{ route('contact') }}" class="block py-2 text-gray-700 hover:text-primary-600">Contact</a>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if (session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- About -->
                <div class="col-span-1 md:col-span-2">
                    <h3 class="text-xl font-bold mb-4 text-primary-400">C-Nuel Medicine and Store</h3>
                    <p class="text-gray-400 mb-4">Your trusted source for quality medicines and healthcare products. We
                        are committed to providing genuine medications at affordable prices.</p>
                    <div class="flex space-x-4">
                        <a href="https://wa.me/2348034966505" target="_blank"
                            class="text-gray-400 hover:text-primary-400 transition">
                            <i class="fab fa-whatsapp text-2xl"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}"
                                class="text-gray-400 hover:text-primary-400 transition">Home</a></li>
                        <li><a href="{{ route('shop') }}"
                                class="text-gray-400 hover:text-primary-400 transition">Shop</a></li>
                        <li><a href="{{ route('about') }}"
                                class="text-gray-400 hover:text-primary-400 transition">About Us</a></li>
                        <li><a href="{{ route('contact') }}"
                                class="text-gray-400 hover:text-primary-400 transition">Contact</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h4 class="text-lg font-semibold mb-4">Contact Us</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li class="flex items-center">
                            <i class="fab fa-whatsapp mr-2 text-primary-400"></i>
                            <a href="https://wa.me/2348034966505" class="hover:text-primary-400 transition">+234 803 496
                                6505</a>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope mr-2 text-primary-400"></i>
                            <a href="mailto:admin@cnuelmedicine.com"
                                class="hover:text-primary-400 transition">admin@cnuelmedicine.com</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} C-Nuel Medicine and Store. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Update cart count dynamically
        function updateCartCount() {
            fetch('{{ route('cart.count') }}')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('cart-count').textContent = data.count;
                });
        }
    </script>

    @stack('scripts')
</body>

</html>
