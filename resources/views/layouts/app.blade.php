<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#16a34a">
    <title>@yield('title', 'C-Nuel Medicine and Store')</title>
    <meta name="description" content="@yield('description', 'Your trusted source for quality medicines and healthcare products.')">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                        display: ['Plus Jakarta Sans', 'Inter', 'sans-serif'],
                    },
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
                            50: '#ecfdf5',
                            100: '#d1fae5',
                            200: '#a7f3d0',
                            300: '#6ee7b7',
                            400: '#34d399',
                            500: '#10b981',
                            600: '#059669',
                            700: '#047857',
                            800: '#065f46',
                            900: '#064e3b',
                        }
                    },
                    animation: {
                        'slide-in-right': 'slideInRight 0.3s ease-out',
                        'slide-out-right': 'slideOutRight 0.3s ease-in',
                        'fade-in': 'fadeIn 0.2s ease-out',
                        'bounce-badge': 'bounceBadge 0.4s cubic-bezier(0.36, 0.07, 0.19, 0.97)',
                        'slide-up': 'slideUp 0.3s ease-out',
                    },
                    keyframes: {
                        slideInRight: {
                            '0%': {
                                transform: 'translateX(100%)'
                            },
                            '100%': {
                                transform: 'translateX(0)'
                            }
                        },
                        slideOutRight: {
                            '0%': {
                                transform: 'translateX(0)'
                            },
                            '100%': {
                                transform: 'translateX(100%)'
                            }
                        },
                        fadeIn: {
                            '0%': {
                                opacity: '0',
                                transform: 'translateY(-8px)'
                            },
                            '100%': {
                                opacity: '1',
                                transform: 'translateY(0)'
                            }
                        },
                        bounceBadge: {
                            '0%,100%': {
                                transform: 'scale(1)'
                            },
                            '30%': {
                                transform: 'scale(1.5)'
                            },
                            '60%': {
                                transform: 'scale(0.9)'
                            }
                        },
                        slideUp: {
                            '0%': {
                                transform: 'translateY(20px)',
                                opacity: '0'
                            },
                            '100%': {
                                transform: 'translateY(0)',
                                opacity: '1'
                            }
                        },
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

        * {
            -webkit-tap-highlight-color: transparent;
        }

        body {
            font-family: 'Inter', system-ui, sans-serif;
        }

        h1,
        h2,
        h3,
        .font-display {
            font-family: 'Plus Jakarta Sans', 'Inter', sans-serif;
        }

        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        ::-webkit-scrollbar-thumb {
            background: #16a34a;
            border-radius: 3px;
        }

        /* Glassmorphism navbar */
        .navbar-glass {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        }

        /* Cart drawer */
        .cart-drawer {
            transition: transform 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .cart-drawer.open {
            transform: translateX(0);
        }

        .cart-drawer.closed {
            transform: translateX(100%);
        }

        /* Toast notification */
        .toast-container {
            position: fixed;
            top: 80px;
            right: 16px;
            z-index: 9999;
            pointer-events: none;
        }

        .toast {
            display: flex;
            align-items: center;
            gap: 12px;
            background: white;
            border-radius: 14px;
            padding: 14px 18px;
            margin-bottom: 10px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.12), 0 2px 8px rgba(0, 0, 0, 0.08);
            border-left: 4px solid #16a34a;
            animation: fadeIn 0.25s ease-out;
            pointer-events: auto;
            min-width: 280px;
            max-width: 360px;
        }

        .toast.error {
            border-left-color: #ef4444;
        }

        .toast.info {
            border-left-color: #3b82f6;
        }

        .toast.removing {
            animation: slideOutToast 0.25s ease-in forwards;
        }

        @keyframes slideOutToast {
            to {
                opacity: 0;
                transform: translateX(110%);
            }
        }

        /* Mobile bottom nav */
        .bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-top: 1px solid #e5e7eb;
            padding-bottom: env(safe-area-inset-bottom);
            z-index: 50;
        }

        /* Card hover effects */
        .product-card {
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .product-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        /* Ripple effect for buttons */
        .btn-ripple {
            position: relative;
            overflow: hidden;
        }

        .btn-ripple::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.4s, height 0.4s, opacity 0.4s;
            opacity: 0;
        }

        .btn-ripple:active::after {
            width: 200px;
            height: 200px;
            opacity: 1;
            transition: 0s;
        }

        /* Active nav indicator */
        .nav-active {
            color: #16a34a;
        }

        .nav-active::after {
            content: '';
            display: block;
            height: 2px;
            background: #16a34a;
            border-radius: 1px;
            margin-top: 2px;
        }

        /* Cart badge pulse */
        .cart-badge-pulse {
            animation: bounceBadge 0.4s cubic-bezier(0.36, 0.07, 0.19, 0.97);
        }

        @keyframes bounceBadge {

            0%,
            100% {
                transform: scale(1);
            }

            30% {
                transform: scale(1.5);
            }

            60% {
                transform: scale(0.9);
            }
        }

        /* Overlay */
        .overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 49;
            opacity: 0;
            transition: opacity 0.3s ease;
            pointer-events: none;
        }

        .overlay.active {
            opacity: 1;
            pointer-events: all;
        }

        /* Safe area padding for iOS */
        .pb-safe {
            padding-bottom: calc(env(safe-area-inset-bottom) + 80px);
        }

        /* Line clamp */
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Input focus styles */
        .input-field {
            width: 100%;
            border: 1.5px solid #e5e7eb;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 15px;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
            background: #fafafa;
        }

        .input-field:focus {
            border-color: #16a34a;
            box-shadow: 0 0 0 3px rgba(22, 163, 74, 0.1);
            background: white;
        }

        /* Gradient text */
        .gradient-text {
            background: linear-gradient(135deg, #16a34a, #059669);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Skeleton loader */
        .skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: skeleton-shimmer 1.5s infinite;
        }

        @keyframes skeleton-shimmer {
            0% {
                background-position: 200% 0;
            }

            100% {
                background-position: -200% 0;
            }
        }

        /* Page content padding for mobile bottom nav */
        @media (max-width: 768px) {
            .page-content {
                padding-bottom: 80px;
            }
        }

        /* Floating action button */
        .fab {
            position: fixed;
            bottom: 100px;
            right: 20px;
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: #25D366;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            box-shadow: 0 4px 20px rgba(37, 211, 102, 0.4);
            z-index: 40;
            transition: transform 0.2s, box-shadow 0.2s;
            text-decoration: none;
        }

        .fab:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 28px rgba(37, 211, 102, 0.5);
        }

        .fab:active {
            transform: scale(0.95);
        }

        @media (min-width: 768px) {
            .fab {
                bottom: 32px;
            }
        }
    </style>

    @stack('styles')
</head>

<body class="bg-gray-50 min-h-screen flex flex-col">

    <!-- Toast Container -->
    <div id="toast-container" class="toast-container"></div>

    <!-- Cart Drawer Overlay -->
    <div id="cart-overlay" class="overlay" onclick="closeCartDrawer()"></div>

    <!-- Cart Drawer -->
    <div id="cart-drawer"
        class="cart-drawer closed fixed right-0 top-0 h-full w-full sm:w-96 bg-white shadow-2xl z-50 flex flex-col">
        <div class="flex items-center justify-between p-5 border-b bg-white">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-primary-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-shopping-bag text-primary-600 text-sm"></i>
                </div>
                <div>
                    <h2 class="font-display font-bold text-gray-900 text-lg">Your Cart</h2>
                    <p id="drawer-item-count" class="text-xs text-gray-500">0 items</p>
                </div>
            </div>
            <button onclick="closeCartDrawer()"
                class="w-9 h-9 flex items-center justify-center rounded-full bg-gray-100 hover:bg-gray-200 transition text-gray-600">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <div id="cart-drawer-items" class="flex-1 overflow-y-auto p-4 space-y-3">
            <!-- Items loaded by JS -->
            <div class="text-center py-12 text-gray-400" id="drawer-empty-state">
                <i class="fas fa-shopping-cart text-5xl mb-3 opacity-30"></i>
                <p class="font-medium">Your cart is empty</p>
                <p class="text-sm mt-1">Add products to get started</p>
            </div>
        </div>

        <div class="border-t bg-white p-5 space-y-4">
            <div class="flex justify-between items-center">
                <span class="text-gray-600 font-medium">Subtotal</span>
                <span id="drawer-total" class="text-2xl font-display font-bold text-primary-600">₦0.00</span>
            </div>
            <a href="{{ route('cart.index') }}" onclick="closeCartDrawer()"
                class="block w-full bg-primary-600 text-white text-center py-4 rounded-2xl font-semibold text-base hover:bg-primary-700 transition btn-ripple">
                View Full Cart & Checkout
            </a>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="navbar-glass sticky top-0 z-40" x-data="{ mobileMenuOpen: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex-shrink-0 flex items-center gap-2.5">
                    <div
                        class="w-9 h-9 bg-gradient-to-br from-primary-500 to-secondary-600 rounded-xl flex items-center justify-center shadow-sm">
                        <i class="fas fa-plus-circle text-white text-lg"></i>
                    </div>
                    <div class="hidden sm:block">
                        <span class="font-display font-bold text-gray-900 text-lg leading-tight block">C-Nuel</span>
                        <span class="text-xs text-primary-600 font-medium leading-tight block -mt-0.5">Medicine &
                            Store</span>
                    </div>
                </a>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center gap-1">
                    <a href="{{ route('home') }}"
                        class="px-4 py-2 rounded-xl font-medium text-sm transition-all {{ request()->routeIs('home') ? 'bg-primary-50 text-primary-700' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">Home</a>
                    <a href="{{ route('shop') }}"
                        class="px-4 py-2 rounded-xl font-medium text-sm transition-all {{ request()->routeIs('shop') ? 'bg-primary-50 text-primary-700' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">Shop</a>
                    <a href="{{ route('about') }}"
                        class="px-4 py-2 rounded-xl font-medium text-sm transition-all {{ request()->routeIs('about') ? 'bg-primary-50 text-primary-700' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">About</a>
                    <a href="{{ route('contact') }}"
                        class="px-4 py-2 rounded-xl font-medium text-sm transition-all {{ request()->routeIs('contact') ? 'bg-primary-50 text-primary-700' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">Contact</a>
                </div>

                <!-- Right actions -->
                <div class="flex items-center gap-2">
                    <!-- Search btn (desktop) -->
                    <a href="{{ route('shop') }}"
                        class="hidden md:flex w-9 h-9 items-center justify-center rounded-full text-gray-500 hover:bg-gray-100 transition">
                        <i class="fas fa-search text-sm"></i>
                    </a>

                    <!-- Cart Button -->
                    <button onclick="openCartDrawer()"
                        class="relative flex items-center gap-2 bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-xl transition btn-ripple">
                        <i class="fas fa-shopping-bag text-sm"></i>
                        <span class="hidden sm:inline text-sm font-medium">Cart</span>
                        <span id="cart-count"
                            class="bg-white text-primary-600 font-bold text-xs rounded-full min-w-[18px] h-[18px] flex items-center justify-center px-1 leading-none">
                            {{ array_sum(session()->get('cart', [])) }}
                        </span>
                    </button>

                    <!-- Mobile menu button -->
                    <button @click="mobileMenuOpen = !mobileMenuOpen"
                        class="md:hidden w-9 h-9 flex items-center justify-center rounded-full text-gray-600 hover:bg-gray-100 transition">
                        <i class="fas" :class="mobileMenuOpen ? 'fa-times' : 'fa-bars'"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Dropdown Menu -->
        <div x-show="mobileMenuOpen" x-cloak x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 transform -translate-y-2"
            x-transition:enter-end="opacity-100 transform translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-end="opacity-0 transform -translate-y-2"
            class="md:hidden bg-white border-t border-gray-100 shadow-lg">
            <div class="px-4 py-3 space-y-1">
                <a href="{{ route('home') }}"
                    class="flex items-center gap-3 px-3 py-3 rounded-xl {{ request()->routeIs('home') ? 'bg-primary-50 text-primary-700' : 'text-gray-700 hover:bg-gray-50' }}">
                    <i
                        class="fas fa-home w-4 text-center {{ request()->routeIs('home') ? 'text-primary-600' : 'text-gray-400' }}"></i>
                    <span class="font-medium">Home</span>
                </a>
                <a href="{{ route('shop') }}"
                    class="flex items-center gap-3 px-3 py-3 rounded-xl {{ request()->routeIs('shop') ? 'bg-primary-50 text-primary-700' : 'text-gray-700 hover:bg-gray-50' }}">
                    <i
                        class="fas fa-store w-4 text-center {{ request()->routeIs('shop') ? 'text-primary-600' : 'text-gray-400' }}"></i>
                    <span class="font-medium">Shop</span>
                </a>
                <a href="{{ route('about') }}"
                    class="flex items-center gap-3 px-3 py-3 rounded-xl {{ request()->routeIs('about') ? 'bg-primary-50 text-primary-700' : 'text-gray-700 hover:bg-gray-50' }}">
                    <i
                        class="fas fa-info-circle w-4 text-center {{ request()->routeIs('about') ? 'text-primary-600' : 'text-gray-400' }}"></i>
                    <span class="font-medium">About</span>
                </a>
                <a href="{{ route('contact') }}"
                    class="flex items-center gap-3 px-3 py-3 rounded-xl {{ request()->routeIs('contact') ? 'bg-primary-50 text-primary-700' : 'text-gray-700 hover:bg-gray-50' }}">
                    <i
                        class="fas fa-phone w-4 text-center {{ request()->routeIs('contact') ? 'text-primary-600' : 'text-gray-400' }}"></i>
                    <span class="font-medium">Contact</span>
                </a>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', () => showToast('{{ addslashes(session('success')) }}', 'success'));
        </script>
    @endif
    @if (session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', () => showToast('{{ addslashes(session('error')) }}', 'error'));
        </script>
    @endif

    <!-- Main Content -->
    <main class="flex-grow page-content">
        @yield('content')
    </main>

    <!-- Mobile Bottom Navigation -->
    <nav class="bottom-nav md:hidden">
        <div class="flex items-center justify-around px-2 py-2">
            <a href="{{ route('home') }}"
                class="flex flex-col items-center gap-0.5 px-4 py-1.5 rounded-xl transition-all {{ request()->routeIs('home') ? 'text-primary-600' : 'text-gray-400 hover:text-gray-600' }}">
                <i class="fas fa-home text-xl {{ request()->routeIs('home') ? '' : '' }}"></i>
                <span class="text-[10px] font-medium">Home</span>
            </a>
            <a href="{{ route('shop') }}"
                class="flex flex-col items-center gap-0.5 px-4 py-1.5 rounded-xl transition-all {{ request()->routeIs('shop') ? 'text-primary-600' : 'text-gray-400 hover:text-gray-600' }}">
                <i class="fas fa-store text-xl"></i>
                <span class="text-[10px] font-medium">Shop</span>
            </a>
            <button onclick="openCartDrawer()"
                class="relative flex flex-col items-center gap-0.5 px-4 py-1.5 rounded-xl text-gray-400 hover:text-gray-600">
                <div class="relative">
                    <i class="fas fa-shopping-bag text-xl"></i>
                    <span id="cart-count-mobile"
                        class="absolute -top-2 -right-2 bg-primary-600 text-white text-[9px] font-bold rounded-full min-w-[16px] h-4 flex items-center justify-center px-0.5">
                        {{ array_sum(session()->get('cart', [])) }}
                    </span>
                </div>
                <span class="text-[10px] font-medium">Cart</span>
            </button>
            <a href="{{ route('about') }}"
                class="flex flex-col items-center gap-0.5 px-4 py-1.5 rounded-xl transition-all {{ request()->routeIs('about') ? 'text-primary-600' : 'text-gray-400 hover:text-gray-600' }}">
                <i class="fas fa-info-circle text-xl"></i>
                <span class="text-[10px] font-medium">About</span>
            </a>
            <a href="{{ route('contact') }}"
                class="flex flex-col items-center gap-0.5 px-4 py-1.5 rounded-xl transition-all {{ request()->routeIs('contact') ? 'text-primary-600' : 'text-gray-400 hover:text-gray-600' }}">
                <i class="fas fa-phone text-xl"></i>
                <span class="text-[10px] font-medium">Contact</span>
            </a>
        </div>
    </nav>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white hidden md:block">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center gap-3 mb-5">
                        <div
                            class="w-10 h-10 bg-gradient-to-br from-primary-500 to-secondary-600 rounded-xl flex items-center justify-center">
                            <i class="fas fa-plus-circle text-white text-lg"></i>
                        </div>
                        <div>
                            <span class="font-display font-bold text-white text-xl block">C-Nuel</span>
                            <span class="text-xs text-primary-400 font-medium block -mt-0.5">Medicine & Store</span>
                        </div>
                    </div>
                    <p class="text-gray-400 mb-5 leading-relaxed text-sm">Your trusted source for quality medicines and
                        healthcare products. Committed to providing genuine medications at affordable prices.</p>
                    <a href="https://wa.me/2348034966505" target="_blank"
                        class="inline-flex items-center gap-2 bg-[#25D366] hover:bg-[#20bd5a] text-white px-5 py-2.5 rounded-xl font-medium text-sm transition">
                        <i class="fab fa-whatsapp text-lg"></i> Chat on WhatsApp
                    </a>
                </div>

                <div>
                    <h4 class="text-sm font-semibold text-gray-300 uppercase tracking-wider mb-4">Quick Links</h4>
                    <ul class="space-y-2.5">
                        <li><a href="{{ route('home') }}"
                                class="text-gray-400 hover:text-primary-400 transition text-sm flex items-center gap-2"><i
                                    class="fas fa-chevron-right text-xs text-primary-600"></i>Home</a></li>
                        <li><a href="{{ route('shop') }}"
                                class="text-gray-400 hover:text-primary-400 transition text-sm flex items-center gap-2"><i
                                    class="fas fa-chevron-right text-xs text-primary-600"></i>Shop</a></li>
                        <li><a href="{{ route('about') }}"
                                class="text-gray-400 hover:text-primary-400 transition text-sm flex items-center gap-2"><i
                                    class="fas fa-chevron-right text-xs text-primary-600"></i>About Us</a></li>
                        <li><a href="{{ route('contact') }}"
                                class="text-gray-400 hover:text-primary-400 transition text-sm flex items-center gap-2"><i
                                    class="fas fa-chevron-right text-xs text-primary-600"></i>Contact</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-sm font-semibold text-gray-300 uppercase tracking-wider mb-4">Contact Us</h4>
                    <ul class="space-y-3">
                        <li class="flex items-start gap-3">
                            <div
                                class="w-8 h-8 bg-gray-800 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                                <i class="fab fa-whatsapp text-[#25D366] text-sm"></i>
                            </div>
                            <a href="https://wa.me/2348034966505"
                                class="text-gray-400 hover:text-primary-400 transition text-sm">+234 803 496 6505</a>
                        </li>
                        <li class="flex items-start gap-3">
                            <div
                                class="w-8 h-8 bg-gray-800 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                                <i class="fas fa-envelope text-primary-400 text-sm"></i>
                            </div>
                            <a href="mailto:admin@cnuelmedicine.com"
                                class="text-gray-400 hover:text-primary-400 transition text-sm">admin@cnuelmedicine.com</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div
                class="border-t border-gray-800 mt-12 pt-8 flex flex-col sm:flex-row items-center justify-between gap-4">
                <p class="text-gray-500 text-sm">&copy; {{ date('Y') }} C-Nuel Medicine and Store. All rights
                    reserved.</p>
                <p class="text-gray-600 text-xs">Your health, our priority.</p>
            </div>
        </div>
    </footer>

    <!-- WhatsApp FAB -->
    <a href="https://wa.me/2348034966505" target="_blank" class="fab" title="Chat on WhatsApp">
        <i class="fab fa-whatsapp"></i>
    </a>

    <script>
        /* ═══════════════════════════════════════════════
                   TOAST NOTIFICATION SYSTEM
                ═══════════════════════════════════════════════ */
        function showToast(message, type = 'success') {
            const container = document.getElementById('toast-container');
            const toast = document.createElement('div');
            toast.className = `toast ${type === 'error' ? 'error' : type === 'info' ? 'info' : ''}`;

            const icon = type === 'success' ? 'fa-check-circle' : type === 'error' ? 'fa-exclamation-circle' :
                'fa-info-circle';
            const iconColor = type === 'success' ? '#16a34a' : type === 'error' ? '#ef4444' : '#3b82f6';

            toast.innerHTML = `
                <div style="width:36px;height:36px;border-radius:50%;background:${iconColor}18;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <i class="fas ${icon}" style="color:${iconColor};font-size:16px;"></i>
                </div>
                <div style="flex:1;min-width:0;">
                    <p style="font-size:14px;font-weight:500;color:#111827;margin:0;">${message}</p>
                </div>
                <button onclick="removeToast(this.parentElement)" style="background:none;border:none;cursor:pointer;padding:4px;color:#9ca3af;flex-shrink:0;">
                    <i class="fas fa-times" style="font-size:12px;"></i>
                </button>`;

            container.appendChild(toast);
            setTimeout(() => removeToast(toast), 3500);
        }

        function removeToast(toast) {
            if (!toast || !toast.parentElement) return;
            toast.classList.add('removing');
            setTimeout(() => toast.remove(), 250);
        }

        /* ═══════════════════════════════════════════════
           CART DRAWER
        ═══════════════════════════════════════════════ */
        let cartDrawerOpen = false;

        function openCartDrawer() {
            const drawer = document.getElementById('cart-drawer');
            const overlay = document.getElementById('cart-overlay');
            drawer.classList.remove('closed');
            drawer.classList.add('open');
            overlay.classList.add('active');
            document.body.style.overflow = 'hidden';
            cartDrawerOpen = true;
            loadCartDrawer();
        }

        function closeCartDrawer() {
            const drawer = document.getElementById('cart-drawer');
            const overlay = document.getElementById('cart-overlay');
            drawer.classList.remove('open');
            drawer.classList.add('closed');
            overlay.classList.remove('active');
            document.body.style.overflow = '';
            cartDrawerOpen = false;
        }

        function loadCartDrawer() {
            fetch('{{ route('cart.index') }}', {
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(r => r.json())
                .then(data => {
                    const container = document.getElementById('cart-drawer-items');
                    const emptyState = document.getElementById('drawer-empty-state');
                    const totalEl = document.getElementById('drawer-total');
                    const countEl = document.getElementById('drawer-item-count');

                    if (data.cartItems && data.cartItems.length > 0) {
                        emptyState.style.display = 'none';
                        let html = '';
                        data.cartItems.forEach(item => {
                            html += `
                        <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-2xl" id="drawer-item-${item.id}">
                            <div class="w-16 h-16 bg-white rounded-xl overflow-hidden flex-shrink-0 border border-gray-100">
                                ${item.image
                                    ? `<img src="${item.image}" alt="${item.name}" class="w-full h-full object-cover">`
                                    : `<div class="w-full h-full flex items-center justify-center text-gray-300"><i class="fas fa-image text-2xl"></i></div>`
                                }
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-semibold text-gray-900 text-sm truncate">${item.name}</p>
                                <p class="text-primary-600 font-bold text-sm">₦${item.price}</p>
                                <div class="flex items-center gap-2 mt-1.5">
                                    <button onclick="updateDrawerQty(${item.id}, ${item.quantity - 1})" class="w-6 h-6 rounded-full bg-white border border-gray-200 flex items-center justify-center text-gray-600 hover:bg-gray-100 text-xs font-bold">−</button>
                                    <span class="text-sm font-semibold text-gray-700 w-5 text-center">${item.quantity}</span>
                                    <button onclick="updateDrawerQty(${item.id}, ${item.quantity + 1})" class="w-6 h-6 rounded-full bg-white border border-gray-200 flex items-center justify-center text-gray-600 hover:bg-gray-100 text-xs font-bold">+</button>
                                </div>
                            </div>
                            <button onclick="removeFromDrawer(${item.id})" class="w-8 h-8 flex items-center justify-center text-red-400 hover:text-red-600 hover:bg-red-50 rounded-full transition flex-shrink-0">
                                <i class="fas fa-trash text-xs"></i>
                            </button>
                        </div>`;
                        });
                        container.innerHTML = html +
                            `<div id="drawer-empty-state" class="text-center py-12 text-gray-400" style="display:none;"><i class="fas fa-shopping-cart text-5xl mb-3 opacity-30"></i><p class="font-medium">Your cart is empty</p></div>`;
                        totalEl.textContent = '₦' + data.total;
                        countEl.textContent = data.cartItems.length + ' item' + (data.cartItems.length !== 1 ? 's' :
                            '');
                    } else {
                        container.innerHTML =
                            `<div class="text-center py-12 text-gray-400"><i class="fas fa-shopping-cart text-5xl mb-3 opacity-30"></i><p class="font-medium">Your cart is empty</p><p class="text-sm mt-1">Add products to get started</p></div>`;
                        totalEl.textContent = '₦0.00';
                        countEl.textContent = '0 items';
                    }
                });
        }

        function updateDrawerQty(productId, newQty) {
            if (newQty < 1) {
                removeFromDrawer(productId);
                return;
            }
            fetch(`/cart/update/${productId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-HTTP-Method-Override': 'PATCH'
                    },
                    body: JSON.stringify({
                        quantity: newQty,
                        _method: 'PATCH'
                    })
                })
                .then(r => r.json())
                .then(data => {
                    updateCartBadge(data.cartCount);
                    loadCartDrawer();
                });
        }

        function removeFromDrawer(productId) {
            fetch(`/cart/remove/${productId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-HTTP-Method-Override': 'DELETE'
                    },
                    body: JSON.stringify({
                        _method: 'DELETE'
                    })
                })
                .then(r => r.json())
                .then(data => {
                    updateCartBadge(data.cartCount);
                    loadCartDrawer();
                    showToast('Item removed from cart', 'info');
                });
        }

        /* ═══════════════════════════════════════════════
           CART BADGE UPDATE
        ═══════════════════════════════════════════════ */
        function updateCartBadge(count) {
            const badges = ['cart-count', 'cart-count-mobile'];
            badges.forEach(id => {
                const el = document.getElementById(id);
                if (el) {
                    el.textContent = count;
                    el.classList.add('cart-badge-pulse');
                    setTimeout(() => el.classList.remove('cart-badge-pulse'), 400);
                }
            });
        }

        /* ═══════════════════════════════════════════════
           GLOBAL ADD TO CART
        ═══════════════════════════════════════════════ */
        function addToCart(form, event) {
            if (event) event.preventDefault();
            const btn = form.querySelector('button[type="submit"]');
            const originalHTML = btn.innerHTML;

            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';

            fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    body: new FormData(form)
                })
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        updateCartBadge(data.cartCount);
                        showToast(data.message || 'Added to cart!', 'success');

                        // Animate button
                        btn.innerHTML = '<i class="fas fa-check"></i>';
                        btn.style.background = '#16a34a';
                        setTimeout(() => {
                            btn.innerHTML = originalHTML;
                            btn.style.background = '';
                            btn.disabled = false;
                        }, 1500);

                        // Refresh drawer if open
                        if (cartDrawerOpen) loadCartDrawer();
                    } else {
                        showToast(data.message || 'Failed to add to cart', 'error');
                        btn.innerHTML = originalHTML;
                        btn.disabled = false;
                    }
                })
                .catch(() => {
                    showToast('Something went wrong. Please try again.', 'error');
                    btn.innerHTML = originalHTML;
                    btn.disabled = false;
                });
        }

        /* ═══════════════════════════════════════════════
           AUTO-BIND ALL ADD-TO-CART FORMS
        ═══════════════════════════════════════════════ */
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.add-to-cart-form').forEach(form => {
                form.addEventListener('submit', e => addToCart(form, e));
            });
        });
    </script>

    @stack('scripts')
</body>

</html>
