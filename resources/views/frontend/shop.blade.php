@extends('layouts.app')

@section('title', 'Shop - C-Nuel Medicine and Store')

@push('styles')
    <style>
        .filter-tag {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 14px;
            border-radius: 100px;
            font-size: 13px;
            font-weight: 500;
            background: white;
            border: 1.5px solid #e5e7eb;
            color: #374151;
            cursor: pointer;
            transition: all 0.2s;
            white-space: nowrap;
        }

        .filter-tag:hover {
            border-color: #16a34a;
            color: #16a34a;
        }

        .filter-tag.active {
            background: #16a34a;
            border-color: #16a34a;
            color: white;
        }

        .sort-select {
            appearance: none;
            background: white url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%236b7280' stroke-width='2'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E") no-repeat right 12px center;
            padding: 10px 36px 10px 14px;
            border: 1.5px solid #e5e7eb;
            border-radius: 12px;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            outline: none;
            transition: border-color 0.2s;
        }

        .sort-select:focus {
            border-color: #16a34a;
        }

        .product-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .product-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 16px 32px rgba(0, 0, 0, 0.09);
        }

        .add-btn {
            width: 38px;
            height: 38px;
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
        }

        .add-btn:active {
            transform: scale(0.92);
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
        }

        /* Filter drawer mobile */
        .filter-drawer {
            position: fixed;
            inset: 0;
            z-index: 60;
            transform: translateX(-100%);
            transition: transform 0.3s ease;
        }

        .filter-drawer.open {
            transform: translateX(0);
        }

        .filter-panel {
            width: 300px;
            height: 100%;
            background: white;
            overflow-y: auto;
            padding: 24px;
            box-shadow: 4px 0 30px rgba(0, 0, 0, 0.1);
        }

        .empty-state {
            text-align: center;
            padding: 80px 20px;
        }
    </style>
@endpush

@section('content')
    <div class="bg-gray-50 min-h-screen">
        {{-- ── Page Header ── --}}
        <div style="background: linear-gradient(135deg, #064e3b, #065f46);" class="text-white py-10 px-4">
            <div class="max-w-7xl mx-auto">
                <h1 class="font-display font-extrabold text-3xl md:text-4xl mb-2">Shop All Products</h1>
                <p class="text-emerald-200 text-base">Browse our range of quality medicines & healthcare products</p>

                {{-- Search bar --}}
                <form action="{{ route('shop') }}" method="GET" class="mt-5 relative max-w-xl">
                    @if (request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    @if (request('sort'))
                        <input type="hidden" name="sort" value="{{ request('sort') }}">
                    @endif
                    @if (request('min_price'))
                        <input type="hidden" name="min_price" value="{{ request('min_price') }}">
                    @endif
                    @if (request('max_price'))
                        <input type="hidden" name="max_price" value="{{ request('max_price') }}">
                    @endif
                    <div class="relative">
                        <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Search medicines, supplements..."
                            class="w-full pl-12 pr-4 py-3.5 rounded-2xl text-gray-900 font-medium text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300 shadow-lg">
                        @if (request('search'))
                            <a href="{{ route('shop', array_filter(['category' => request('category'), 'sort' => request('sort')])) }}"
                                class="absolute right-3 top-1/2 -translate-y-1/2 w-7 h-7 flex items-center justify-center text-gray-400 hover:text-gray-600 rounded-full hover:bg-gray-100">
                                <i class="fas fa-times text-xs"></i>
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

            {{-- ── Top Bar: Category chips + Sort ── --}}
            <div class="flex items-center justify-between gap-3 mb-5">
                {{-- Category chips - horizontal scroll --}}
                <div class="flex items-center gap-2 overflow-x-auto pb-1"
                    style="scrollbar-width:none; -webkit-overflow-scrolling:touch;">
                    <a href="{{ route('shop', array_filter(['search' => request('search'), 'sort' => request('sort'), 'min_price' => request('min_price'), 'max_price' => request('max_price')])) }}"
                        class="filter-tag {{ !request('category') ? 'active' : '' }} flex-shrink-0">
                        All
                    </a>
                    @foreach ($categories as $category)
                        <a href="{{ route('shop', array_merge(request()->except('category', 'page'), ['category' => $category->id])) }}"
                            class="filter-tag {{ request('category') == $category->id ? 'active' : '' }} flex-shrink-0">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>

                {{-- Sort + Filter button --}}
                <div class="flex items-center gap-2 flex-shrink-0">
                    <form id="sort-form" action="{{ route('shop') }}" method="GET" class="hidden md:block">
                        @foreach (request()->except('sort') as $key => $val)
                            <input type="hidden" name="{{ $key }}" value="{{ $val }}">
                        @endforeach
                        <select name="sort" class="sort-select" onchange="document.getElementById('sort-form').submit()">
                            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest</option>
                            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low →
                                High</option>
                            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High
                                → Low</option>
                            <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name A-Z</option>
                        </select>
                    </form>
                    <button onclick="openFilterDrawer()"
                        class="md:hidden flex items-center gap-2 bg-white border-1.5 border-gray-200 text-gray-700 px-4 py-2.5 rounded-xl text-sm font-medium shadow-sm">
                        <i class="fas fa-sliders-h"></i> Filter
                    </button>
                </div>
            </div>

            {{-- Active filters --}}
            @if (request()->hasAny(['search', 'min_price', 'max_price']))
                <div class="flex items-center gap-2 mb-5 flex-wrap">
                    <span class="text-xs text-gray-500 font-medium">Filters:</span>
                    @if (request('search'))
                        <span
                            class="inline-flex items-center gap-1 bg-primary-50 text-primary-700 text-xs font-medium px-3 py-1.5 rounded-full">
                            "{{ request('search') }}"
                            <a href="{{ route('shop', array_filter(array_merge(request()->all(), ['search' => null]))) }}"
                                class="ml-1 hover:text-red-500"><i class="fas fa-times text-[10px]"></i></a>
                        </span>
                    @endif
                    @if (request('min_price') || request('max_price'))
                        <span
                            class="inline-flex items-center gap-1 bg-primary-50 text-primary-700 text-xs font-medium px-3 py-1.5 rounded-full">
                            ₦{{ request('min_price', 0) }} - ₦{{ request('max_price', '∞') }}
                            <a href="{{ route('shop', array_filter(array_merge(request()->all(), ['min_price' => null, 'max_price' => null]))) }}"
                                class="ml-1 hover:text-red-500"><i class="fas fa-times text-[10px]"></i></a>
                        </span>
                    @endif
                    <a href="{{ route('shop', array_filter(['category' => request('category'), 'sort' => request('sort')])) }}"
                        class="text-xs text-red-500 hover:text-red-700 font-medium">Clear all</a>
                </div>
            @endif

            {{-- ── Results count ── --}}
            <p class="text-sm text-gray-500 mb-5">
                @if ($products->total() > 0)
                    Showing <strong
                        class="text-gray-700">{{ $products->firstItem() }}–{{ $products->lastItem() }}</strong> of <strong
                        class="text-gray-700">{{ $products->total() }}</strong> products
                @else
                    No products found
                @endif
            </p>

            {{-- ── Products Grid ── --}}
            @if ($products->count() > 0)
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-3 md:gap-5">
                    @foreach ($products as $product)
                        <div class="product-card bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100">
                            <a href="{{ route('product.show', $product->slug) }}" class="block relative">
                                <div class="aspect-square bg-gray-50 overflow-hidden">
                                    @if ($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                            class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                                            loading="lazy">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <i class="fas fa-pills text-4xl text-gray-200"></i>
                                        </div>
                                    @endif
                                </div>
                                @if ($product->sale_price)
                                    <span class="sale-badge">SALE</span>
                                @endif
                                @if ($product->stock_quantity == 0)
                                    <div class="absolute inset-0 bg-black/40 flex items-center justify-center">
                                        <span class="bg-gray-900 text-white text-xs font-bold px-3 py-1.5 rounded-full">Out
                                            of Stock</span>
                                    </div>
                                @endif
                            </a>
                            <div class="p-3">
                                @if ($product->category)
                                    <p
                                        class="text-[10px] font-semibold text-primary-600 uppercase tracking-wider mb-1 truncate">
                                        {{ $product->category->name }}</p>
                                @endif
                                <a href="{{ route('product.show', $product->slug) }}">
                                    <h3
                                        class="font-semibold text-gray-900 text-sm leading-tight mb-2 line-clamp-2 hover:text-primary-600 transition">
                                        {{ $product->name }}</h3>
                                </a>
                                <div class="flex items-center justify-between gap-1">
                                    <div class="min-w-0">
                                        @if ($product->sale_price)
                                            <p class="font-bold text-primary-600 text-sm">
                                                ₦{{ number_format($product->sale_price, 2) }}</p>
                                            <p class="text-[11px] text-gray-400 line-through">
                                                ₦{{ number_format($product->price, 2) }}</p>
                                        @else
                                            <p class="font-bold text-primary-600 text-sm">
                                                ₦{{ number_format($product->price, 2) }}</p>
                                        @endif
                                    </div>
                                    @if ($product->stock_quantity > 0)
                                        <form action="{{ route('cart.add', $product) }}" method="POST"
                                            class="add-to-cart-form flex-shrink-0">
                                            @csrf
                                            <button type="submit" class="add-btn">
                                                <i class="fas fa-cart-plus text-sm"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="mt-8 mb-4">
                    {{ $products->appends(request()->query())->links() }}
                </div>
            @else
                <div class="empty-state bg-white rounded-3xl shadow-sm border border-gray-100">
                    <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-5">
                        <i class="fas fa-search text-3xl text-gray-300"></i>
                    </div>
                    <h3 class="font-display font-bold text-xl text-gray-700 mb-2">No products found</h3>
                    <p class="text-gray-500 text-sm mb-6">Try adjusting your search or filters</p>
                    <a href="{{ route('shop') }}"
                        class="inline-flex items-center gap-2 bg-primary-600 text-white px-6 py-3 rounded-xl font-semibold text-sm hover:bg-primary-700 transition">
                        <i class="fas fa-redo"></i> Reset Filters
                    </a>
                </div>
            @endif
        </div>
    </div>

    {{-- ── Mobile Filter Drawer ── --}}
    <div id="filter-overlay" class="fixed inset-0 bg-black/50 z-50 hidden opacity-0 transition-opacity"
        onclick="closeFilterDrawer()"></div>
    <div id="filter-drawer"
        class="fixed left-0 top-0 h-full w-80 bg-white z-60 shadow-2xl transform -translate-x-full transition-transform duration-300 overflow-y-auto"
        style="z-index:60;">
        <div class="p-5">
            <div class="flex items-center justify-between mb-6">
                <h3 class="font-display font-bold text-lg text-gray-900">Filters</h3>
                <button onclick="closeFilterDrawer()"
                    class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-100 text-gray-600"><i
                        class="fas fa-times text-sm"></i></button>
            </div>

            <form action="{{ route('shop') }}" method="GET">
                @if (request('search'))
                    <input type="hidden" name="search" value="{{ request('search') }}">
                @endif

                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-3">Sort By</label>
                    <select name="sort"
                        class="w-full border-1.5 border-gray-200 rounded-xl px-4 py-3 text-sm font-medium focus:outline-none focus:border-primary-500 appearance-none bg-gray-50">
                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low → High
                        </option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High →
                            Low</option>
                        <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name A-Z</option>
                    </select>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-3">Category</label>
                    <div class="space-y-2">
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="radio" name="category" value=""
                                {{ !request('category') ? 'checked' : '' }} class="text-primary-600">
                            <span class="text-sm text-gray-700">All Categories</span>
                        </label>
                        @foreach ($categories as $category)
                            <label class="flex items-center gap-3 cursor-pointer">
                                <input type="radio" name="category" value="{{ $category->id }}"
                                    {{ request('category') == $category->id ? 'checked' : '' }} class="text-primary-600">
                                <span class="text-sm text-gray-700">{{ $category->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="mb-8">
                    <label class="block text-sm font-semibold text-gray-700 mb-3">Price Range</label>
                    <div class="flex gap-2">
                        <div class="flex-1">
                            <label class="text-xs text-gray-500 mb-1 block">Min (₦)</label>
                            <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="0"
                                class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:border-primary-500 bg-gray-50">
                        </div>
                        <div class="flex-1">
                            <label class="text-xs text-gray-500 mb-1 block">Max (₦)</label>
                            <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="Any"
                                class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:border-primary-500 bg-gray-50">
                        </div>
                    </div>
                </div>

                <button type="submit"
                    class="w-full bg-primary-600 text-white py-3.5 rounded-2xl font-bold text-sm hover:bg-primary-700 transition">
                    Apply Filters
                </button>
                <a href="{{ route('shop') }}"
                    class="block text-center mt-3 text-sm text-gray-500 hover:text-gray-700">Reset All</a>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        function openFilterDrawer() {
            const drawer = document.getElementById('filter-drawer');
            const overlay = document.getElementById('filter-overlay');
            drawer.style.transform = 'translateX(0)';
            overlay.classList.remove('hidden');
            setTimeout(() => overlay.style.opacity = '1', 10);
            document.body.style.overflow = 'hidden';
        }

        function closeFilterDrawer() {
            const drawer = document.getElementById('filter-drawer');
            const overlay = document.getElementById('filter-overlay');
            drawer.style.transform = 'translateX(-100%)';
            overlay.style.opacity = '0';
            setTimeout(() => overlay.classList.add('hidden'), 300);
            document.body.style.overflow = '';
        }
    </script>
@endpush
