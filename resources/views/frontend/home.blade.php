@extends('layouts.app')

@section('title', 'C-Nuel Medicine and Store — Your Health, Our Priority')
@section('description', 'Your trusted source for quality medicines and healthcare products.')

@push('styles')
    <style>
        .hero-gradient {
            background: linear-gradient(135deg, #064e3b 0%, #065f46 40%, #047857 70%, #059669 100%);
        }

        .hero-blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(60px);
            opacity: 0.15;
        }

        .category-chip {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 18px;
            border-radius: 100px;
            background: white;
            border: 1.5px solid #e5e7eb;
            font-size: 13px;
            font-weight: 500;
            color: #374151;
            white-space: nowrap;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
        }

        .category-chip:hover,
        .category-chip.active {
            background: #16a34a;
            border-color: #16a34a;
            color: white;
        }

        .category-chip:hover .chip-icon,
        .category-chip.active .chip-icon {
            color: white;
        }

        .chip-icon {
            color: #16a34a;
            font-size: 14px;
        }

        .scroll-x {
            overflow-x: auto;
            scroll-snap-type: x mandatory;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
        }

        .scroll-x::-webkit-scrollbar {
            display: none;
        }

        .scroll-x>* {
            scroll-snap-align: start;
        }

        .feature-card {
            border-radius: 20px;
            padding: 24px;
            background: linear-gradient(135deg, var(--card-from), var(--card-to));
        }

        .product-card-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }

        @media (min-width: 640px) {
            .product-card-grid {
                grid-template-columns: repeat(3, 1fr);
                gap: 16px;
            }
        }

        @media (min-width: 1024px) {
            .product-card-grid {
                grid-template-columns: repeat(4, 1fr);
                gap: 20px;
            }
        }

        .add-btn {
            width: 36px;
            height: 36px;
            border-radius: 12px;
            background: #16a34a;
            color: white;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
            flex-shrink: 0;
        }

        .add-btn:hover {
            background: #15803d;
            transform: scale(1.05);
        }

        .add-btn:active {
            transform: scale(0.95);
        }

        .sale-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            background: #ef4444;
            color: white;
            font-size: 10px;
            font-weight: 700;
            padding: 3px 8px;
            border-radius: 100px;
            letter-spacing: 0.5px;
        }

        .new-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            background: #3b82f6;
            color: white;
            font-size: 10px;
            font-weight: 700;
            padding: 3px 8px;
            border-radius: 100px;
        }

        .section-title {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 800;
            font-size: clamp(22px, 4vw, 30px);
            color: #111827;
            line-height: 1.2;
        }
    </style>
@endpush

@section('content')

    {{-- ═══════════════════ HERO SECTION ═══════════════════ --}}
    <section class="hero-gradient text-white relative overflow-hidden">
        {{-- Background blobs --}}
        <div class="hero-blob w-96 h-96 bg-emerald-300 top-0 right-0 translate-x-1/2 -translate-y-1/4"
            style="position:absolute;border-radius:50%;filter:blur(80px);opacity:0.12;width:400px;height:400px;top:-60px;right:-80px;background:#6ee7b7;">
        </div>
        <div class="hero-blob"
            style="position:absolute;border-radius:50%;filter:blur(60px);opacity:0.1;width:300px;height:300px;bottom:-40px;left:-60px;background:#a7f3d0;">
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24 relative z-10">
            <div class="flex flex-col md:flex-row items-center gap-10">
                {{-- Text content --}}
                <div class="flex-1 text-center md:text-left">
                    <div
                        class="inline-flex items-center gap-2 bg-white/15 backdrop-blur rounded-full px-4 py-2 text-sm font-medium mb-6">
                        <div class="w-2 h-2 bg-emerald-300 rounded-full animate-pulse"></div>
                        Trusted Pharmacy & Healthcare Store
                    </div>

                    @if ($page && $page->activeSections->where('type', 'hero')->first())
                        @php $hero = $page->activeSections->where('type', 'hero')->first(); @endphp
                        <h1 class="font-display font-extrabold text-4xl md:text-5xl lg:text-6xl leading-tight mb-4">
                            {!! nl2br(e($hero->title)) !!}
                        </h1>
                        <p class="text-emerald-100 text-lg md:text-xl mb-8 max-w-lg mx-auto md:mx-0 leading-relaxed">
                            {{ $hero->content }}</p>
                    @else
                        <h1 class="font-display font-extrabold text-4xl md:text-5xl lg:text-6xl leading-tight mb-4">
                            Your Health is<br><span class="text-emerald-300">Our Priority</span>
                        </h1>
                        <p class="text-emerald-100 text-lg md:text-xl mb-8 max-w-lg mx-auto md:mx-0 leading-relaxed">
                            Quality medicines & healthcare products delivered to your door. 100% genuine, affordable prices.
                        </p>
                    @endif

                    <div class="flex flex-col sm:flex-row gap-3 justify-center md:justify-start">
                        <a href="{{ route('shop') }}"
                            class="inline-flex items-center justify-center gap-2 bg-white text-primary-700 px-7 py-3.5 rounded-2xl font-bold text-base hover:bg-gray-50 transition shadow-lg btn-ripple">
                            <i class="fas fa-store"></i> Shop Now
                        </a>
                        <a href="https://wa.me/2348034966505" target="_blank"
                            class="inline-flex items-center justify-center gap-2 bg-[#25D366] text-white px-7 py-3.5 rounded-2xl font-bold text-base hover:bg-[#20bd5a] transition btn-ripple">
                            <i class="fab fa-whatsapp text-lg"></i> WhatsApp Us
                        </a>
                    </div>

                    {{-- Stats --}}
                    <div class="mt-10 grid grid-cols-3 gap-4 max-w-sm mx-auto md:mx-0">
                        <div class="text-center">
                            <p class="text-2xl font-display font-extrabold text-white">100%</p>
                            <p class="text-xs text-emerald-200 mt-0.5">Genuine Products</p>
                        </div>
                        <div class="text-center border-x border-white/20">
                            <p class="text-2xl font-display font-extrabold text-white">Fast</p>
                            <p class="text-xs text-emerald-200 mt-0.5">Delivery</p>
                        </div>
                        <div class="text-center">
                            <p class="text-2xl font-display font-extrabold text-white">24/7</p>
                            <p class="text-xs text-emerald-200 mt-0.5">Support</p>
                        </div>
                    </div>
                </div>

                {{-- Hero image / illustration --}}
                <div class="flex-shrink-0 hidden md:flex items-center justify-center w-72 lg:w-80">
                    <div
                        class="w-72 h-72 lg:w-80 lg:h-80 bg-white/10 rounded-3xl flex items-center justify-center backdrop-blur-sm border border-white/20 shadow-2xl">
                        <div class="text-center">
                            <div class="text-8xl mb-4">💊</div>
                            <p class="text-white font-display font-bold text-xl">C-Nuel</p>
                            <p class="text-emerald-200 text-sm">Medicine & Store</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════════════════ CATEGORY CHIPS ═══════════════════ --}}
    @if ($categories && $categories->count() > 0)
        <section class="bg-white py-5 border-b border-gray-100 sticky top-16 z-30 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="scroll-x flex gap-2">
                    <a href="{{ route('shop') }}" class="category-chip {{ !request('category') ? 'active' : '' }}">
                        <i class="fas fa-th chip-icon"></i> All Products
                    </a>
                    @foreach ($categories as $cat)
                        <a href="{{ route('shop', ['category' => $cat->id]) }}" class="category-chip">
                            <i class="fas fa-pills chip-icon"></i> {{ $cat->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ═══════════════════ FEATURED PRODUCTS ═══════════════════ --}}
    @if ($featuredProducts->count() > 0)
        <section class="py-10 md:py-16 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-end justify-between mb-6">
                    <div>
                        <p class="text-primary-600 text-sm font-semibold uppercase tracking-wider mb-1">⭐ Featured</p>
                        <h2 class="section-title">Top Picks For You</h2>
                    </div>
                    <a href="{{ route('shop') }}"
                        class="text-primary-600 hover:text-primary-700 text-sm font-semibold flex items-center gap-1">
                        See all <i class="fas fa-arrow-right text-xs"></i>
                    </a>
                </div>

                <div class="product-card-grid">
                    @foreach ($featuredProducts as $product)
                        <div class="product-card bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100">
                            <a href="{{ route('product.show', $product->slug) }}" class="block relative">
                                <div class="aspect-square bg-gray-50 overflow-hidden">
                                    @if ($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <i class="fas fa-pills text-4xl text-gray-200"></i>
                                        </div>
                                    @endif
                                </div>
                                @if ($product->sale_price)
                                    <span class="sale-badge">SALE</span>
                                @endif
                            </a>
                            <div class="p-3">
                                @if ($product->category)
                                    <p class="text-[10px] font-semibold text-primary-600 uppercase tracking-wider mb-1">
                                        {{ $product->category->name }}</p>
                                @endif
                                <a href="{{ route('product.show', $product->slug) }}">
                                    <h3
                                        class="font-semibold text-gray-900 text-sm leading-tight mb-2 line-clamp-2 hover:text-primary-600 transition">
                                        {{ $product->name }}</h3>
                                </a>
                                <div class="flex items-center justify-between">
                                    <div>
                                        @if ($product->sale_price)
                                            <p class="font-bold text-primary-600 text-sm">
                                                ₦{{ number_format($product->sale_price, 2) }}</p>
                                            <p class="text-xs text-gray-400 line-through">
                                                ₦{{ number_format($product->price, 2) }}</p>
                                        @else
                                            <p class="font-bold text-primary-600 text-sm">
                                                ₦{{ number_format($product->price, 2) }}</p>
                                        @endif
                                    </div>
                                    <form action="{{ route('cart.add', $product) }}" method="POST"
                                        class="add-to-cart-form">
                                        @csrf
                                        <button type="submit" class="add-btn">
                                            <i class="fas fa-cart-plus text-sm"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ═══════════════════ FEATURE CARDS / WHY CHOOSE US ═══════════════════ --}}
    <section class="py-10 md:py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-8">
                <p class="text-primary-600 text-sm font-semibold uppercase tracking-wider mb-2">Why Us?</p>
                <h2 class="section-title">The C-Nuel Difference</h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="rounded-2xl p-6 text-white" style="background: linear-gradient(135deg, #064e3b, #065f46);">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mb-4">
                        <i class="fas fa-shield-check text-xl"></i>
                    </div>
                    <h3 class="font-display font-bold text-lg mb-2">100% Genuine</h3>
                    <p class="text-emerald-100 text-sm leading-relaxed">All products sourced directly from trusted,
                        certified manufacturers. Never fake.</p>
                </div>
                <div class="rounded-2xl p-6 text-white" style="background: linear-gradient(135deg, #1d4ed8, #2563eb);">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mb-4">
                        <i class="fas fa-truck-fast text-xl"></i>
                    </div>
                    <h3 class="font-display font-bold text-lg mb-2">Fast Delivery</h3>
                    <p class="text-blue-100 text-sm leading-relaxed">Quick and safe delivery to your doorstep. Track your
                        order every step of the way.</p>
                </div>
                <div class="rounded-2xl p-6 text-white" style="background: linear-gradient(135deg, #7c3aed, #8b5cf6);">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mb-4">
                        <i class="fab fa-whatsapp text-xl"></i>
                    </div>
                    <h3 class="font-display font-bold text-lg mb-2">24/7 WhatsApp</h3>
                    <p class="text-purple-100 text-sm leading-relaxed">Our team is always available on WhatsApp for any
                        questions, anytime.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════════════════ LATEST PRODUCTS ═══════════════════ --}}
    @if ($latestProducts->count() > 0)
        <section class="py-10 md:py-16 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-end justify-between mb-6">
                    <div>
                        <p class="text-primary-600 text-sm font-semibold uppercase tracking-wider mb-1">🆕 New Arrivals</p>
                        <h2 class="section-title">Just Added</h2>
                    </div>
                    <a href="{{ route('shop') }}"
                        class="text-primary-600 hover:text-primary-700 text-sm font-semibold flex items-center gap-1">
                        See all <i class="fas fa-arrow-right text-xs"></i>
                    </a>
                </div>

                {{-- Mobile: horizontal scroll, Desktop: grid --}}
                <div class="md:hidden scroll-x flex gap-3 pb-3">
                    @foreach ($latestProducts as $product)
                        <div
                            class="flex-shrink-0 w-44 product-card bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100">
                            <a href="{{ route('product.show', $product->slug) }}" class="block relative">
                                <div class="w-full h-40 bg-gray-50 overflow-hidden">
                                    @if ($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                            class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center"><i
                                                class="fas fa-pills text-3xl text-gray-200"></i></div>
                                    @endif
                                </div>
                                <span class="new-badge">NEW</span>
                            </a>
                            <div class="p-3">
                                <h3 class="font-semibold text-gray-900 text-xs leading-tight mb-2 line-clamp-2">
                                    {{ $product->name }}</h3>
                                <div class="flex items-center justify-between">
                                    <p class="font-bold text-primary-600 text-xs">
                                        ₦{{ number_format($product->sale_price ?? $product->price, 0) }}</p>
                                    <form action="{{ route('cart.add', $product) }}" method="POST"
                                        class="add-to-cart-form">
                                        @csrf
                                        <button type="submit"
                                            style="width:30px;height:30px;border-radius:10px;background:#16a34a;color:white;border:none;display:flex;align-items:center;justify-content:center;cursor:pointer;">
                                            <i class="fas fa-plus text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="hidden md:grid product-card-grid">
                    @foreach ($latestProducts as $product)
                        <div class="product-card bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100">
                            <a href="{{ route('product.show', $product->slug) }}" class="block relative">
                                <div class="aspect-square bg-gray-50 overflow-hidden">
                                    @if ($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                            class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center"><i
                                                class="fas fa-pills text-4xl text-gray-200"></i></div>
                                    @endif
                                </div>
                                <span class="new-badge">NEW</span>
                            </a>
                            <div class="p-3">
                                @if ($product->category)
                                    <p class="text-[10px] font-semibold text-primary-600 uppercase tracking-wider mb-1">
                                        {{ $product->category->name }}</p>
                                @endif
                                <a href="{{ route('product.show', $product->slug) }}">
                                    <h3
                                        class="font-semibold text-gray-900 text-sm leading-tight mb-2 line-clamp-2 hover:text-primary-600 transition">
                                        {{ $product->name }}</h3>
                                </a>
                                <div class="flex items-center justify-between">
                                    <div>
                                        @if ($product->sale_price)
                                            <p class="font-bold text-primary-600 text-sm">
                                                ₦{{ number_format($product->sale_price, 2) }}</p>
                                            <p class="text-xs text-gray-400 line-through">
                                                ₦{{ number_format($product->price, 2) }}</p>
                                        @else
                                            <p class="font-bold text-primary-600 text-sm">
                                                ₦{{ number_format($product->price, 2) }}</p>
                                        @endif
                                    </div>
                                    <form action="{{ route('cart.add', $product) }}" method="POST"
                                        class="add-to-cart-form">
                                        @csrf
                                        <button type="submit" class="add-btn"><i
                                                class="fas fa-cart-plus text-sm"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ═══════════════════ CTA BANNER ═══════════════════ --}}
    <section class="py-14 relative overflow-hidden"
        style="background: linear-gradient(135deg, #064e3b 0%, #065f46 50%, #047857 100%);">
        <div
            style="position:absolute;border-radius:50%;filter:blur(80px);opacity:0.1;width:400px;height:400px;top:-100px;right:-100px;background:#6ee7b7;">
        </div>
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            @if ($page && $page->activeSections->where('type', 'cta')->first())
                @php $cta = $page->activeSections->where('type', 'cta')->first(); @endphp
                <h2 class="font-display font-extrabold text-3xl md:text-4xl text-white mb-4">{{ $cta->title }}</h2>
                <p class="text-emerald-100 text-lg mb-8 max-w-xl mx-auto">{{ $cta->content }}</p>
                @if ($cta->button_text)
                    <a href="{{ $cta->button_link ?? route('contact') }}"
                        class="inline-flex items-center gap-2 bg-white text-primary-700 px-8 py-4 rounded-2xl font-bold text-lg hover:bg-gray-50 transition shadow-xl">
                        {{ $cta->button_text }}
                    </a>
                @endif
            @else
                <div
                    class="inline-flex items-center gap-2 bg-white/15 text-white text-sm font-medium px-4 py-2 rounded-full mb-6">
                    <i class="fab fa-whatsapp text-[#25D366]"></i> Available on WhatsApp 24/7
                </div>
                <h2 class="font-display font-extrabold text-3xl md:text-4xl text-white mb-4">Need Health Advice?</h2>
                <p class="text-emerald-100 text-lg mb-8 max-w-xl mx-auto">Contact our healthcare team on WhatsApp for
                    personalized assistance with your medication needs.</p>
                <div class="flex flex-col sm:flex-row gap-3 justify-center">
                    <a href="https://wa.me/2348034966505?text=Hello! I need help with my healthcare needs."
                        target="_blank"
                        class="inline-flex items-center justify-center gap-2 bg-[#25D366] text-white px-8 py-4 rounded-2xl font-bold text-lg hover:bg-[#20bd5a] transition shadow-xl btn-ripple">
                        <i class="fab fa-whatsapp text-xl"></i> Chat with Us
                    </a>
                    <a href="{{ route('shop') }}"
                        class="inline-flex items-center justify-center gap-2 bg-white text-primary-700 px-8 py-4 rounded-2xl font-bold text-lg hover:bg-gray-50 transition shadow-xl btn-ripple">
                        <i class="fas fa-store"></i> Browse Products
                    </a>
                </div>
            @endif
        </div>
    </section>

@endsection
