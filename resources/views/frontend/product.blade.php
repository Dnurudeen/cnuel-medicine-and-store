@extends('layouts.app')

@section('title', $product->name . ' — C-Nuel Medicine and Store')
@section('description', $product->short_description ?? $product->description)


@push('styles')
    <style>
        .qty-btn {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: #f3f4f6;
            color: #374151;
            border: none;
            cursor: pointer;
            font-size: 18px;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.15s;
            flex-shrink: 0;
        }

        .qty-btn:hover {
            background: #e5e7eb;
        }

        .qty-btn:active {
            transform: scale(0.9);
        }

        .qty-input {
            width: 52px;
            text-align: center;
            border: none;
            background: transparent;
            font-size: 18px;
            font-weight: 700;
            color: #111827;
            outline: none;
        }

        .stock-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 12px;
            border-radius: 100px;
            font-size: 12px;
            font-weight: 600;
        }

        .tab-btn {
            padding: 12px 24px;
            font-weight: 600;
            font-size: 14px;
            border-bottom: 2px solid transparent;
            color: #6b7280;
            cursor: pointer;
            transition: all 0.2s;
            white-space: nowrap;
        }

        .tab-btn.active {
            color: #16a34a;
            border-bottom-color: #16a34a;
        }

        /* Sticky add-to-cart for mobile */
        .sticky-cart-bar {
            position: fixed;
            bottom: 70px;
            left: 0;
            right: 0;
            padding: 12px 16px calc(env(safe-area-inset-bottom) + 12px);
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-top: 1px solid #e5e7eb;
            z-index: 30;
            box-shadow: 0 -8px 30px rgba(0, 0, 0, 0.08);
        }

        @media(min-width:768px) {
            .sticky-cart-bar {
                display: none !important;
            }
        }

        .related-scroll {
            overflow-x: auto;
            scroll-snap-type: x mandatory;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
            display: flex;
            gap: 12px;
            padding-bottom: 8px;
        }

        .related-scroll::-webkit-scrollbar {
            display: none;
        }

        .related-card {
            flex-shrink: 0;
            width: 160px;
            scroll-snap-align: start;
        }

        @media (min-width: 768px) {
            .related-scroll {
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                gap: 20px;
                overflow: visible;
            }

            .related-card {
                width: auto;
            }
        }
    </style>
@endpush

@section('content')
    <div class="bg-gray-50 min-h-screen">

        {{-- Breadcrumb --}}
        <div class="bg-white border-b border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
                <nav class="flex items-center gap-2 text-sm text-gray-500 overflow-x-auto whitespace-nowrap"
                    style="scrollbar-width:none;">
                    <a href="{{ route('home') }}" class="hover:text-primary-600 transition flex-shrink-0">Home</a>
                    <i class="fas fa-chevron-right text-[10px] text-gray-300 flex-shrink-0"></i>
                    <a href="{{ route('shop') }}" class="hover:text-primary-600 transition flex-shrink-0">Shop</a>
                    @if ($product->category)
                        <i class="fas fa-chevron-right text-[10px] text-gray-300 flex-shrink-0"></i>
                        <a href="{{ route('shop', ['category' => $product->category_id]) }}"
                            class="hover:text-primary-600 transition flex-shrink-0">{{ $product->category->name }}</a>
                    @endif
                    <i class="fas fa-chevron-right text-[10px] text-gray-300 flex-shrink-0"></i>
                    <span class="text-gray-800 font-medium flex-shrink-0 max-w-[200px] truncate">{{ $product->name }}</span>
                </nav>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 md:py-10">

            {{-- ── Main Product Section ── --}}
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden mb-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-0">

                    {{-- Product Image --}}
                    <div class="relative bg-gray-50">
                        @if ($product->sale_price)
                            <div
                                class="absolute top-4 left-4 z-10 bg-red-500 text-white text-xs font-bold px-3 py-1.5 rounded-full">
                                {{ round((($product->price - $product->sale_price) / $product->price) * 100) }}% OFF
                            </div>
                        @endif
                        @if ($product->is_featured)
                            <div
                                class="absolute top-4 right-4 z-10 bg-amber-400 text-amber-900 text-xs font-bold px-3 py-1.5 rounded-full">
                                ⭐ Featured
                            </div>
                        @endif
                        <div
                            class="aspect-square md:aspect-auto md:h-full min-h-[320px] flex items-center justify-center p-6 md:p-10">
                            @if ($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                    class="w-full h-full object-contain max-h-[480px] rounded-2xl" id="main-product-image">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-200 min-h-[240px]">
                                    <i class="fas fa-pills text-8xl"></i>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Product Info --}}
                    <div class="p-6 md:p-8 flex flex-col">
                        {{-- Category badge --}}
                        @if ($product->category)
                            <a href="{{ route('shop', ['category' => $product->category_id]) }}"
                                class="inline-flex items-center gap-1.5 text-xs font-semibold text-primary-600 bg-primary-50 px-3 py-1.5 rounded-full self-start mb-4 hover:bg-primary-100 transition">
                                <i class="fas fa-tag text-[10px]"></i> {{ $product->category->name }}
                            </a>
                        @endif

                        <h1 class="font-display font-extrabold text-2xl md:text-3xl text-gray-900 mb-4 leading-tight">
                            {{ $product->name }}</h1>

                        {{-- Price --}}
                        <div class="flex items-baseline gap-3 mb-5">
                            @if ($product->sale_price)
                                <span
                                    class="font-display font-extrabold text-3xl text-primary-600">₦{{ number_format($product->sale_price, 2) }}</span>
                                <span
                                    class="text-lg text-gray-400 line-through font-medium">₦{{ number_format($product->price, 2) }}</span>
                                <span class="text-sm font-bold text-red-500 bg-red-50 px-2 py-0.5 rounded-lg">Save
                                    ₦{{ number_format($product->price - $product->sale_price, 2) }}</span>
                            @else
                                <span
                                    class="font-display font-extrabold text-3xl text-primary-600">₦{{ number_format($product->price, 2) }}</span>
                            @endif
                        </div>

                        {{-- Stock status --}}
                        <div class="mb-5">
                            @if ($product->stock_quantity > 0)
                                <span class="stock-pill bg-emerald-50 text-emerald-700">
                                    <span class="w-2 h-2 bg-emerald-500 rounded-full inline-block"></span>
                                    In Stock &mdash; {{ $product->stock_quantity }} available
                                </span>
                            @else
                                <span class="stock-pill bg-red-50 text-red-600">
                                    <span class="w-2 h-2 bg-red-500 rounded-full inline-block"></span>
                                    Out of Stock
                                </span>
                            @endif
                        </div>

                        {{-- Short description --}}
                        @if ($product->short_description)
                            <p class="text-gray-600 text-sm leading-relaxed mb-6 pb-6 border-b border-gray-100">
                                {{ $product->short_description }}</p>
                        @endif

                        {{-- Add to Cart (desktop) --}}
                        @if ($product->stock_quantity > 0)
                            <form action="{{ route('cart.add', $product) }}" method="POST" class="add-to-cart-form mb-4"
                                id="product-cart-form">
                                @csrf
                                <div class="flex items-center gap-4 mb-4">
                                    <span class="text-sm font-semibold text-gray-700">Quantity:</span>
                                    <div
                                        class="flex items-center gap-2 bg-gray-50 border border-gray-200 rounded-2xl px-2 py-1">
                                        <button type="button" class="qty-btn" onclick="changeQty(-1)">−</button>
                                        <input type="number" name="quantity" id="quantity-desktop" value="1"
                                            min="1" max="{{ $product->stock_quantity }}" class="qty-input"
                                            onchange="syncQty(this.value)">
                                        <button type="button" class="qty-btn" onclick="changeQty(1)">+</button>
                                    </div>
                                </div>
                                <div class="flex gap-3">
                                    <button type="submit"
                                        class="flex-1 flex items-center justify-center gap-2 bg-primary-600 text-white py-4 rounded-2xl font-bold text-base hover:bg-primary-700 transition btn-ripple">
                                        <i class="fas fa-shopping-bag"></i> Add to Cart
                                    </button>
                                    <a href="https://wa.me/2348034966505?text=Hi!%20I%20want%20to%20order%20{{ urlencode($product->name) }}"
                                        target="_blank"
                                        class="flex items-center justify-center w-14 h-14 bg-[#25D366] text-white rounded-2xl hover:bg-[#20bd5a] transition flex-shrink-0 btn-ripple">
                                        <i class="fab fa-whatsapp text-xl"></i>
                                    </a>
                                </div>
                            </form>
                        @else
                            <div class="mb-4">
                                <button disabled
                                    class="w-full flex items-center justify-center gap-2 bg-gray-200 text-gray-400 py-4 rounded-2xl font-bold text-base cursor-not-allowed mb-3">
                                    <i class="fas fa-ban"></i> Out of Stock
                                </button>
                                <a href="https://wa.me/2348034966505?text=Hi!%20Is%20{{ urlencode($product->name) }}%20available?"
                                    target="_blank"
                                    class="flex items-center justify-center gap-2 w-full bg-[#25D366] text-white py-4 rounded-2xl font-bold text-base hover:bg-[#20bd5a] transition btn-ripple">
                                    <i class="fab fa-whatsapp text-lg"></i> Ask on WhatsApp
                                </a>
                            </div>
                        @endif

                        {{-- Meta info --}}
                        <div class="mt-4 pt-4 border-t border-gray-100 space-y-2 text-xs text-gray-500">
                            @if ($product->sku)
                                <p><span class="font-semibold text-gray-700">SKU:</span> {{ $product->sku }}</p>
                            @endif
                            <p><span class="font-semibold text-gray-700">Category:</span>
                                @if ($product->category)
                                    <a href="{{ route('shop', ['category' => $product->category_id]) }}"
                                        class="text-primary-600 hover:underline">{{ $product->category->name }}</a>
                                @else
                                    N/A
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Tabs: Description --}}
                @if ($product->description)
                    <div class="border-t border-gray-100">
                        <div class="flex overflow-x-auto px-6 md:px-8" style="scrollbar-width:none;">
                            <button class="tab-btn active" onclick="showTab('description', this)">Description</button>
                            <button class="tab-btn" onclick="showTab('usage', this)">How to Use</button>
                        </div>
                        <div id="tab-description" class="tab-content px-6 md:px-8 py-6">
                            <div class="prose max-w-none text-gray-600 text-sm leading-relaxed">
                                {!! nl2br(e($product->description)) !!}
                            </div>
                        </div>
                        <div id="tab-usage" class="tab-content px-6 md:px-8 py-6 hidden">
                            <div class="bg-amber-50 border border-amber-200 rounded-2xl p-5">
                                <div class="flex items-start gap-3">
                                    <i class="fas fa-exclamation-triangle text-amber-500 mt-0.5"></i>
                                    <div class="text-sm text-amber-800">
                                        <p class="font-semibold mb-1">Important Notice</p>
                                        <p>Always consult with a healthcare professional or pharmacist before using any
                                            medication. Follow the dosage instructions on the packaging. Contact us on
                                            WhatsApp for personalized guidance.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            {{-- ── Related Products ── --}}
            @if ($relatedProducts->count() > 0)
                <div class="mb-20 md:mb-6">
                    <div class="flex items-end justify-between mb-5">
                        <h2 class="font-display font-bold text-xl text-gray-900">You May Also Like</h2>
                        <a href="{{ route('shop', $product->category ? ['category' => $product->category_id] : []) }}"
                            class="text-primary-600 text-sm font-semibold flex items-center gap-1">
                            See more <i class="fas fa-arrow-right text-xs"></i>
                        </a>
                    </div>
                    <div class="related-scroll">
                        @foreach ($relatedProducts as $related)
                            <div
                                class="related-card bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100 product-card">
                                <a href="{{ route('product.show', $related->slug) }}" class="block">
                                    <div class="aspect-square bg-gray-50 overflow-hidden">
                                        @if ($related->image)
                                            <img src="{{ asset('storage/' . $related->image) }}"
                                                alt="{{ $related->name }}"
                                                class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                                                loading="lazy">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center">
                                                <i class="fas fa-pills text-3xl text-gray-200"></i>
                                            </div>
                                        @endif
                                    </div>
                                </a>
                                <div class="p-3">
                                    <a href="{{ route('product.show', $related->slug) }}">
                                        <h3
                                            class="font-semibold text-gray-900 text-xs leading-tight mb-2 line-clamp-2 hover:text-primary-600 transition">
                                            {{ $related->name }}</h3>
                                    </a>
                                    <div class="flex items-center justify-between">
                                        <p class="font-bold text-primary-600 text-sm">
                                            ₦{{ number_format($related->sale_price ?? $related->price, 2) }}</p>
                                        @if ($related->stock_quantity > 0)
                                            <form action="{{ route('cart.add', $related) }}" method="POST"
                                                class="add-to-cart-form">
                                                @csrf
                                                <button type="submit"
                                                    style="width:30px;height:30px;background:#16a34a;color:white;border:none;border-radius:10px;cursor:pointer;display:flex;align-items:center;justify-content:center;">
                                                    <i class="fas fa-plus text-xs"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        {{-- ── Sticky Add to Cart Bar (Mobile) ── --}}
        @if ($product->stock_quantity > 0)
            <div class="sticky-cart-bar">
                <form action="{{ route('cart.add', $product) }}" method="POST" class="add-to-cart-form"
                    id="sticky-cart-form">
                    @csrf
                    <div class="flex items-center gap-3">
                        <div class="flex items-center gap-1.5 bg-gray-100 rounded-2xl px-2 py-1.5 flex-shrink-0">
                            <button type="button"
                                class="w-8 h-8 rounded-xl bg-white flex items-center justify-center text-gray-700 font-bold text-lg shadow-sm"
                                onclick="changeQty(-1)">−</button>
                            <input type="number" name="quantity" id="quantity-mobile" value="1" min="1"
                                max="{{ $product->stock_quantity }}"
                                class="w-8 text-center bg-transparent font-bold text-gray-900 text-base border-none outline-none"
                                onchange="syncQty(this.value)">
                            <button type="button"
                                class="w-8 h-8 rounded-xl bg-white flex items-center justify-center text-gray-700 font-bold text-lg shadow-sm"
                                onclick="changeQty(1)">+</button>
                        </div>
                        <button type="submit"
                            class="flex-1 flex items-center justify-center gap-2 bg-primary-600 text-white py-3.5 rounded-2xl font-bold text-sm hover:bg-primary-700 transition btn-ripple">
                            <i class="fas fa-shopping-bag"></i>
                            Add to Cart — ₦{{ number_format($product->sale_price ?? $product->price, 2) }}
                        </button>
                    </div>
                </form>
            </div>
        @endif

    </div>
@endsection

@push('scripts')
    <script>
        const maxQty = {{ $product->stock_quantity }};

        function changeQty(delta) {
            const deskInput = document.getElementById('quantity-desktop');
            const mobInput = document.getElementById('quantity-mobile');
            let current = parseInt(deskInput?.value ?? mobInput?.value ?? 1);
            let newVal = Math.max(1, Math.min(maxQty, current + delta));
            if (deskInput) deskInput.value = newVal;
            if (mobInput) mobInput.value = newVal;
        }

        function syncQty(val) {
            const v = Math.max(1, Math.min(maxQty, parseInt(val) || 1));
            const deskInput = document.getElementById('quantity-desktop');
            const mobInput = document.getElementById('quantity-mobile');
            if (deskInput) deskInput.value = v;
            if (mobInput) mobInput.value = v;
        }

        function showTab(tabId, btn) {
            document.querySelectorAll('.tab-content').forEach(t => t.classList.add('hidden'));
            document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
            document.getElementById('tab-' + tabId).classList.remove('hidden');
            btn.classList.add('active');
        }

        // Sync qty between desktop and mobile forms
        ['quantity-desktop', 'quantity-mobile'].forEach(id => {
            const el = document.getElementById(id);
            if (el) el.addEventListener('input', e => syncQty(e.target.value));
        });
    </script>
@endpush
