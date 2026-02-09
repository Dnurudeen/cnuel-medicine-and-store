@extends('layouts.app')

@section('title', $product->name . ' - C-Nuel Medicine and Store')
@section('description', $product->short_description ?? $product->description)

@section('content')
    <div class="bg-gray-50 min-h-screen py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
            <nav class="mb-8">
                <ol class="flex items-center space-x-2 text-sm text-gray-500">
                    <li><a href="{{ route('home') }}" class="hover:text-primary-600">Home</a></li>
                    <li><i class="fas fa-chevron-right text-xs"></i></li>
                    <li><a href="{{ route('shop') }}" class="hover:text-primary-600">Shop</a></li>
                    @if ($product->category)
                        <li><i class="fas fa-chevron-right text-xs"></i></li>
                        <li><a href="{{ route('shop', ['category' => $product->category_id]) }}"
                                class="hover:text-primary-600">{{ $product->category->name }}</a></li>
                    @endif
                    <li><i class="fas fa-chevron-right text-xs"></i></li>
                    <li class="text-gray-800">{{ $product->name }}</li>
                </ol>
            </nav>

            <!-- Product Details -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-6 lg:p-8">
                    <!-- Product Image -->
                    <div class="aspect-square bg-gray-100 rounded-lg overflow-hidden">
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                <i class="fas fa-image text-6xl"></i>
                            </div>
                        @endif
                    </div>

                    <!-- Product Info -->
                    <div>
                        @if ($product->category)
                            <span class="text-sm text-primary-600 font-medium">{{ $product->category->name }}</span>
                        @endif

                        <h1 class="text-3xl font-bold text-gray-800 mt-2 mb-4">{{ $product->name }}</h1>

                        <!-- Price -->
                        <div class="mb-6">
                            @if ($product->sale_price)
                                <span
                                    class="text-3xl font-bold text-primary-600">₦{{ number_format($product->sale_price, 2) }}</span>
                                <span
                                    class="text-xl text-gray-400 line-through ml-3">₦{{ number_format($product->price, 2) }}</span>
                                <span class="ml-3 bg-red-100 text-red-600 px-3 py-1 rounded-full text-sm font-medium">
                                    {{ round((($product->price - $product->sale_price) / $product->price) * 100) }}% OFF
                                </span>
                            @else
                                <span
                                    class="text-3xl font-bold text-primary-600">₦{{ number_format($product->price, 2) }}</span>
                            @endif
                        </div>

                        <!-- Stock Status -->
                        <div class="mb-6">
                            @if ($product->stock_quantity > 0)
                                <span class="text-green-600 font-medium"><i class="fas fa-check-circle mr-1"></i> In Stock
                                    ({{ $product->stock_quantity }} available)</span>
                            @else
                                <span class="text-red-600 font-medium"><i class="fas fa-times-circle mr-1"></i> Out of
                                    Stock</span>
                            @endif
                        </div>

                        <!-- Short Description -->
                        @if ($product->short_description)
                            <p class="text-gray-600 mb-6">{{ $product->short_description }}</p>
                        @endif

                        <!-- Add to Cart Form -->
                        @if ($product->stock_quantity > 0)
                            <form action="{{ route('cart.add', $product) }}" method="POST" class="mb-6"
                                id="add-to-cart-form">
                                @csrf
                                <div class="flex items-center space-x-4 mb-4">
                                    <label class="font-medium">Quantity:</label>
                                    <div class="flex items-center border border-gray-300 rounded-lg">
                                        <button type="button" onclick="decrementQty()"
                                            class="px-4 py-2 text-gray-600 hover:bg-gray-100">-</button>
                                        <input type="number" name="quantity" id="quantity" value="1" min="1"
                                            max="{{ $product->stock_quantity }}"
                                            class="w-16 text-center border-0 focus:ring-0">
                                        <button type="button" onclick="incrementQty()"
                                            class="px-4 py-2 text-gray-600 hover:bg-gray-100">+</button>
                                    </div>
                                </div>
                                <button type="submit"
                                    class="w-full bg-primary-500 text-white py-4 rounded-lg font-semibold text-lg hover:bg-primary-600 transition">
                                    <i class="fas fa-cart-plus mr-2"></i> Add to Cart
                                </button>
                            </form>
                        @else
                            <button disabled
                                class="w-full bg-gray-400 text-white py-4 rounded-lg font-semibold text-lg cursor-not-allowed mb-6">
                                Out of Stock
                            </button>
                        @endif

                        <!-- WhatsApp Contact -->
                        <a href="https://wa.me/2348034966505?text=Hello! I'm interested in {{ urlencode($product->name) }}"
                            target="_blank"
                            class="flex items-center justify-center w-full bg-green-500 text-white py-3 rounded-lg font-semibold hover:bg-green-600 transition">
                            <i class="fab fa-whatsapp mr-2 text-xl"></i> Contact on WhatsApp
                        </a>

                        <!-- SKU -->
                        @if ($product->sku)
                            <p class="text-sm text-gray-500 mt-6">SKU: {{ $product->sku }}</p>
                        @endif
                    </div>
                </div>

                <!-- Full Description -->
                @if ($product->description)
                    <div class="border-t px-6 lg:px-8 py-8">
                        <h2 class="text-xl font-bold text-gray-800 mb-4">Description</h2>
                        <div class="prose max-w-none text-gray-600">
                            {!! nl2br(e($product->description)) !!}
                        </div>
                    </div>
                @endif
            </div>

            <!-- Related Products -->
            @if ($relatedProducts->count() > 0)
                <div class="mt-12">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Related Products</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                        @foreach ($relatedProducts as $relatedProduct)
                            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition group">
                                <a href="{{ route('product.show', $relatedProduct->slug) }}">
                                    <div class="aspect-square bg-gray-100 overflow-hidden">
                                        @if ($relatedProduct->image)
                                            <img src="{{ asset('storage/' . $relatedProduct->image) }}"
                                                alt="{{ $relatedProduct->name }}"
                                                class="w-full h-full object-cover group-hover:scale-105 transition">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                                <i class="fas fa-image text-4xl"></i>
                                            </div>
                                        @endif
                                    </div>
                                </a>
                                <div class="p-4">
                                    <a href="{{ route('product.show', $relatedProduct->slug) }}">
                                        <h3 class="font-semibold text-gray-800 mb-2 hover:text-primary-600 transition">
                                            {{ $relatedProduct->name }}</h3>
                                    </a>
                                    <div class="flex items-center justify-between">
                                        <div>
                                            @if ($relatedProduct->sale_price)
                                                <span
                                                    class="text-lg font-bold text-primary-600">₦{{ number_format($relatedProduct->sale_price, 2) }}</span>
                                            @else
                                                <span
                                                    class="text-lg font-bold text-primary-600">₦{{ number_format($relatedProduct->price, 2) }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const maxQty = {{ $product->stock_quantity }};

        function incrementQty() {
            const input = document.getElementById('quantity');
            if (parseInt(input.value) < maxQty) {
                input.value = parseInt(input.value) + 1;
            }
        }

        function decrementQty() {
            const input = document.getElementById('quantity');
            if (parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1;
            }
        }

        document.getElementById('add-to-cart-form')?.addEventListener('submit', function(e) {
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
    </script>
@endpush
