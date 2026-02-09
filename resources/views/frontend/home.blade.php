@extends('layouts.app')

@section('title', 'Home - C-Nuel Medicine and Store')
@section('description', 'Your trusted source for quality medicines and healthcare products.')

@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-primary-600 to-secondary-500 text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                @if ($page && $page->activeSections->where('type', 'hero')->first())
                    @php $hero = $page->activeSections->where('type', 'hero')->first(); @endphp
                    <h1 class="text-4xl md:text-5xl font-bold mb-6">{{ $hero->title }}</h1>
                    <p class="text-xl md:text-2xl mb-8 text-green-100">{{ $hero->content }}</p>
                    @if ($hero->button_text)
                        <a href="{{ $hero->button_link ?? route('shop') }}"
                            class="inline-block bg-white text-primary-600 px-8 py-4 rounded-lg font-semibold text-lg hover:bg-gray-100 transition shadow-lg">
                            {{ $hero->button_text }}
                        </a>
                    @endif
                @else
                    <h1 class="text-4xl md:text-5xl font-bold mb-6">Welcome to C-Nuel Medicine and Store</h1>
                    <p class="text-xl md:text-2xl mb-8 text-green-100">Your trusted source for quality medicines and
                        healthcare products</p>
                    <a href="{{ route('shop') }}"
                        class="inline-block bg-white text-primary-600 px-8 py-4 rounded-lg font-semibold text-lg hover:bg-gray-100 transition shadow-lg">
                        Shop Now
                    </a>
                @endif
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    @if ($featuredProducts->count() > 0)
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Featured Products</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach ($featuredProducts as $product)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition group">
                            <a href="{{ route('product.show', $product->slug) }}">
                                <div class="aspect-square bg-gray-100 overflow-hidden">
                                    @if ($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                            class="w-full h-full object-cover group-hover:scale-105 transition">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-gray-400">
                                            <i class="fas fa-image text-4xl"></i>
                                        </div>
                                    @endif
                                </div>
                            </a>
                            <div class="p-4">
                                <a href="{{ route('product.show', $product->slug) }}">
                                    <h3 class="font-semibold text-gray-800 mb-2 hover:text-primary-600 transition">
                                        {{ $product->name }}</h3>
                                </a>
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
                <div class="text-center mt-10">
                    <a href="{{ route('shop') }}"
                        class="inline-block bg-primary-500 text-white px-8 py-3 rounded-lg font-semibold hover:bg-primary-600 transition">
                        View All Products
                    </a>
                </div>
            </div>
        </section>
    @endif

    <!-- Latest Products -->
    @if ($latestProducts->count() > 0)
        <section class="py-16 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Latest Products</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach ($latestProducts as $product)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition group">
                            <a href="{{ route('product.show', $product->slug) }}">
                                <div class="aspect-square bg-gray-100 overflow-hidden">
                                    @if ($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                            class="w-full h-full object-cover group-hover:scale-105 transition">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-gray-400">
                                            <i class="fas fa-image text-4xl"></i>
                                        </div>
                                    @endif
                                </div>
                            </a>
                            <div class="p-4">
                                <a href="{{ route('product.show', $product->slug) }}">
                                    <h3 class="font-semibold text-gray-800 mb-2 hover:text-primary-600 transition">
                                        {{ $product->name }}</h3>
                                </a>
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
            </div>
        </section>
    @endif

    <!-- CTA Section -->
    <section class="py-16 bg-primary-600 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            @if ($page && $page->activeSections->where('type', 'cta')->first())
                @php $cta = $page->activeSections->where('type', 'cta')->first(); @endphp
                <h2 class="text-3xl font-bold mb-4">{{ $cta->title }}</h2>
                <p class="text-xl text-green-100 mb-8">{{ $cta->content }}</p>
                @if ($cta->button_text)
                    <a href="{{ $cta->button_link ?? route('contact') }}"
                        class="inline-block bg-white text-primary-600 px-8 py-4 rounded-lg font-semibold text-lg hover:bg-gray-100 transition">
                        {{ $cta->button_text }}
                    </a>
                @endif
            @else
                <h2 class="text-3xl font-bold mb-4">Need Help?</h2>
                <p class="text-xl text-green-100 mb-8">Contact us on WhatsApp for personalized assistance with your
                    healthcare needs.</p>
                <a href="{{ route('contact') }}"
                    class="inline-block bg-white text-primary-600 px-8 py-4 rounded-lg font-semibold text-lg hover:bg-gray-100 transition">
                    Contact Us
                </a>
            @endif
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Why Choose Us</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center p-6">
                    <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-check-circle text-3xl text-primary-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">100% Genuine Products</h3>
                    <p class="text-gray-600">All our products are sourced from trusted manufacturers and are 100% authentic.
                    </p>
                </div>
                <div class="text-center p-6">
                    <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-truck text-3xl text-primary-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Fast Delivery</h3>
                    <p class="text-gray-600">We ensure quick and safe delivery of your orders right to your doorstep.</p>
                </div>
                <div class="text-center p-6">
                    <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-headset text-3xl text-primary-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">24/7 Support</h3>
                    <p class="text-gray-600">Our team is always available to assist you with any questions or concerns.</p>
                </div>
            </div>
        </div>
    </section>
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
