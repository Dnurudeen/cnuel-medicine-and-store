@extends('layouts.app')

@section('title', 'Shop - C-Nuel Medicine and Store')

@section('content')
    <div class="bg-gray-50 min-h-screen py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-800">Shop</h1>
                <p class="text-gray-600 mt-2">Browse our collection of quality medicines and healthcare products</p>
            </div>

            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Filters Sidebar -->
                <aside class="lg:w-64 flex-shrink-0">
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="font-semibold text-lg mb-4">Filters</h3>

                        <form action="{{ route('shop') }}" method="GET">
                            <!-- Search -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                                <input type="text" name="search" value="{{ request('search') }}"
                                    placeholder="Search products..."
                                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500">
                            </div>

                            <!-- Categories -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                                <select name="category"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500">
                                    <option value="">All Categories</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ request('category') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Price Range -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Price Range</label>
                                <div class="flex space-x-2">
                                    <input type="number" name="min_price" value="{{ request('min_price') }}"
                                        placeholder="Min"
                                        class="w-1/2 border border-gray-300 rounded-lg px-3 py-2 focus:ring-primary-500 focus:border-primary-500">
                                    <input type="number" name="max_price" value="{{ request('max_price') }}"
                                        placeholder="Max"
                                        class="w-1/2 border border-gray-300 rounded-lg px-3 py-2 focus:ring-primary-500 focus:border-primary-500">
                                </div>
                            </div>

                            <!-- Sort -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Sort By</label>
                                <select name="sort"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500">
                                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest
                                    </option>
                                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price:
                                        Low to High</option>
                                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>
                                        Price: High to Low</option>
                                    <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name</option>
                                </select>
                            </div>

                            <button type="submit"
                                class="w-full bg-primary-500 text-white py-2 rounded-lg hover:bg-primary-600 transition">
                                Apply Filters
                            </button>

                            @if (request()->hasAny(['search', 'category', 'min_price', 'max_price', 'sort']))
                                <a href="{{ route('shop') }}"
                                    class="block text-center mt-3 text-gray-600 hover:text-primary-600">
                                    Clear Filters
                                </a>
                            @endif
                        </form>
                    </div>
                </aside>

                <!-- Products Grid -->
                <div class="flex-1">
                    @if ($products->count() > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach ($products as $product)
                                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition group">
                                    <a href="{{ route('product.show', $product->slug) }}">
                                        <div class="aspect-square bg-gray-100 overflow-hidden">
                                            @if ($product->image)
                                                <img src="{{ asset('storage/' . $product->image) }}"
                                                    alt="{{ $product->name }}"
                                                    class="w-full h-full object-cover group-hover:scale-105 transition">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                                    <i class="fas fa-image text-4xl"></i>
                                                </div>
                                            @endif
                                        </div>
                                    </a>
                                    <div class="p-4">
                                        @if ($product->category)
                                            <span
                                                class="text-xs text-primary-600 font-medium">{{ $product->category->name }}</span>
                                        @endif
                                        <a href="{{ route('product.show', $product->slug) }}">
                                            <h3 class="font-semibold text-gray-800 mb-2 hover:text-primary-600 transition">
                                                {{ $product->name }}</h3>
                                        </a>
                                        @if ($product->short_description)
                                            <p class="text-sm text-gray-600 mb-3 line-clamp-2">
                                                {{ $product->short_description }}</p>
                                        @endif
                                        <div class="flex items-center justify-between">
                                            <div>
                                                @if ($product->sale_price)
                                                    <span
                                                        class="text-lg font-bold text-primary-600">₦{{ number_format($product->sale_price, 2) }}</span>
                                                    <span
                                                        class="text-sm text-gray-400 line-through ml-2">₦{{ number_format($product->price, 2) }}</span>
                                                @else
                                                    <span
                                                        class="text-lg font-bold text-primary-600">₦{{ number_format($product->price, 2) }}</span>
                                                @endif
                                            </div>
                                            <form action="{{ route('cart.add', $product) }}" method="POST"
                                                class="add-to-cart-form">
                                                @csrf
                                                <button type="submit"
                                                    class="bg-primary-500 text-white p-2 rounded-lg hover:bg-primary-600 transition">
                                                    <i class="fas fa-cart-plus"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="mt-8">
                            {{ $products->appends(request()->query())->links() }}
                        </div>
                    @else
                        <div class="bg-white rounded-lg shadow p-12 text-center">
                            <i class="fas fa-box-open text-6xl text-gray-300 mb-4"></i>
                            <h3 class="text-xl font-semibold text-gray-600 mb-2">No products found</h3>
                            <p class="text-gray-500">Try adjusting your filters or search terms.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.querySelectorAll('.add-to-cart-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                fetch(this.action, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json',
                        },
                        body: new FormData(this)
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById('cart-count').textContent = data.cartCount;
                            alert(data.message);
                        }
                    });
            });
        });
    </script>
@endpush
