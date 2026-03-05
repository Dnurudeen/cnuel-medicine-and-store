@extends('layouts.app')

@section('title', 'Shopping Cart — C-Nuel Medicine and Store')

@section('content')
    <div class="bg-gray-50 min-h-screen pb-28 md:pb-10">

        {{-- Header --}}
        <div class="bg-white border-b border-gray-100 sticky top-16 z-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">
                <h1 class="font-display font-extrabold text-xl text-gray-900 flex items-center gap-2">
                    <i class="fas fa-shopping-bag text-primary-500"></i>
                    My Cart
                    @if (count($cartItems) > 0)
                        <span class="text-sm font-semibold text-gray-400 ml-1">({{ count($cartItems) }}
                            {{ Str::plural('item', count($cartItems)) }})</span>
                    @endif
                </h1>
                @if (count($cartItems) > 0)
                    <form action="{{ route('cart.clear') }}" method="POST" onsubmit="return confirm('Clear all items?')">
                        @csrf
                        <button type="submit"
                            class="text-sm text-red-400 hover:text-red-600 transition flex items-center gap-1.5">
                            <i class="fas fa-trash-alt text-xs"></i> Clear all
                        </button>
                    </form>
                @endif
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            @if (count($cartItems) > 0)
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                    {{-- ── Cart Items ── --}}
                    <div class="lg:col-span-2 space-y-3" id="cart-items-container">
                        @foreach ($cartItems as $item)
                            <div class="cart-item-row bg-white rounded-2xl border border-gray-100 shadow-sm p-4 flex gap-4 items-start"
                                id="cart-item-{{ $item['product']->id }}">
                                {{-- Image --}}
                                <a href="{{ route('product.show', $item['product']->slug) }}" class="flex-shrink-0">
                                    <div class="w-20 h-20 rounded-xl overflow-hidden bg-gray-50 border border-gray-100">
                                        @if ($item['product']->image)
                                            <img src="{{ asset('storage/' . $item['product']->image) }}"
                                                alt="{{ $item['product']->name }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-gray-300">
                                                <i class="fas fa-pills text-2xl"></i>
                                            </div>
                                        @endif
                                    </div>
                                </a>

                                {{-- Details --}}
                                <div class="flex-1 min-w-0">
                                    <a href="{{ route('product.show', $item['product']->slug) }}">
                                        <h3
                                            class="font-semibold text-gray-900 text-sm leading-tight hover:text-primary-600 transition line-clamp-2 mb-1">
                                            {{ $item['product']->name }}</h3>
                                    </a>
                                    <p class="text-xs text-gray-400 mb-2">
                                        ₦{{ number_format($item['product']->sale_price ?? $item['product']->price, 2) }}
                                        each
                                    </p>

                                    <div class="flex items-center justify-between">
                                        {{-- Qty controls --}}
                                        <div
                                            class="flex items-center gap-1 bg-gray-50 border border-gray-200 rounded-xl px-1.5 py-1">
                                            <button type="button"
                                                onclick="cartUpdateQty({{ $item['product']->id }}, {{ $item['quantity'] - 1 }}, {{ $item['product']->stock_quantity }})"
                                                class="w-7 h-7 flex items-center justify-center rounded-lg hover:bg-gray-200 transition text-gray-600 font-bold">−</button>
                                            <span class="w-8 text-center font-bold text-sm text-gray-900 item-qty"
                                                id="qty-{{ $item['product']->id }}">{{ $item['quantity'] }}</span>
                                            <button type="button"
                                                onclick="cartUpdateQty({{ $item['product']->id }}, {{ $item['quantity'] + 1 }}, {{ $item['product']->stock_quantity }})"
                                                class="w-7 h-7 flex items-center justify-center rounded-lg hover:bg-gray-200 transition text-gray-600 font-bold">+</button>
                                        </div>

                                        {{-- Item total + remove --}}
                                        <div class="flex items-center gap-3">
                                            <p class="font-bold text-primary-600 text-sm"
                                                id="item-total-{{ $item['product']->id }}">
                                                ₦{{ number_format($item['total'], 2) }}
                                            </p>
                                            <button type="button" onclick="cartRemoveItem({{ $item['product']->id }})"
                                                class="w-8 h-8 flex items-center justify-center rounded-xl bg-red-50 text-red-400 hover:bg-red-100 hover:text-red-600 transition">
                                                <i class="fas fa-trash-alt text-xs"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <a href="{{ route('shop') }}"
                            class="flex items-center gap-2 text-primary-600 text-sm font-semibold mt-4 hover:text-primary-700 transition">
                            <i class="fas fa-arrow-left text-xs"></i> Continue Shopping
                        </a>
                    </div>

                    {{-- ── Order Summary ── --}}
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 lg:sticky lg:top-32">
                            <h2 class="font-display font-bold text-lg text-gray-900 mb-5 pb-4 border-b border-gray-100">
                                Order Summary</h2>

                            <div class="space-y-3 mb-5 text-sm">
                                <div class="flex justify-between text-gray-600">
                                    <span>Subtotal ({{ count($cartItems) }} items)</span>
                                    <span id="page-cart-total"
                                        class="font-semibold text-gray-900">₦{{ number_format($total, 2) }}</span>
                                </div>
                                <div class="flex justify-between text-gray-600">
                                    <span>Delivery fee</span>
                                    <span class="text-primary-600 font-medium">Free 🎉</span>
                                </div>
                            </div>

                            <div class="border-t border-gray-100 pt-4 mb-5">
                                <div class="flex justify-between items-center">
                                    <span class="font-bold text-gray-900 text-base">Total</span>
                                    <span class="font-extrabold text-primary-600 text-xl"
                                        id="page-cart-total-2">₦{{ number_format($total, 2) }}</span>
                                </div>
                            </div>

                            <a href="{{ route('checkout.index') }}"
                                class="block w-full bg-primary-600 text-white text-center py-4 rounded-2xl font-bold text-base hover:bg-primary-700 transition btn-ripple mb-3">
                                Proceed to Checkout
                            </a>

                            <div class="bg-emerald-50 rounded-xl p-3 flex items-start gap-2">
                                <i class="fab fa-whatsapp text-[#25D366] text-lg mt-0.5"></i>
                                <p class="text-xs text-emerald-700 leading-relaxed">
                                    Checkout will redirect you to <strong>WhatsApp</strong> to complete your payment safely.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                {{-- Empty cart --}}
                <div class="flex flex-col items-center justify-center py-20 text-center px-4">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-shopping-bag text-4xl text-gray-300"></i>
                    </div>
                    <h2 class="font-display font-bold text-2xl text-gray-800 mb-2">Your cart is empty</h2>
                    <p class="text-gray-500 mb-8 max-w-sm">Browse our products and add items you love to your cart.</p>
                    <a href="{{ route('shop') }}"
                        class="inline-flex items-center gap-2 bg-primary-600 text-white px-8 py-4 rounded-2xl font-bold hover:bg-primary-700 transition btn-ripple">
                        <i class="fas fa-store"></i> Browse Products
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function cartUpdateQty(productId, newQty, maxQty) {
            if (newQty < 1) {
                cartRemoveItem(productId);
                return;
            }
            if (newQty > maxQty) {
                showToast('Only ' + maxQty + ' items in stock', 'warning');
                return;
            }

            fetch('/cart/update/' + productId, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-HTTP-Method-Override': 'PATCH'
                    },
                    body: JSON.stringify({
                        quantity: newQty
                    })
                })
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        // Update qty display
                        const qtyEl = document.getElementById('qty-' + productId);
                        if (qtyEl) qtyEl.textContent = newQty;

                        // Update button targets
                        const row = document.getElementById('cart-item-' + productId);
                        if (row) {
                            const btns = row.querySelectorAll('button[onclick]');
                            btns[0]?.setAttribute('onclick', `cartUpdateQty(${productId}, ${newQty - 1}, ${maxQty})`);
                            btns[1]?.setAttribute('onclick', `cartUpdateQty(${productId}, ${newQty + 1}, ${maxQty})`);
                        }

                        // Recalculate item total locally
                        const priceText = row?.querySelector('.text-gray-400')?.textContent?.replace(/[^0-9.]/g, '');
                        if (priceText) {
                            const itemTotal = parseFloat(priceText) * newQty;
                            const itemTotalEl = document.getElementById('item-total-' + productId);
                            if (itemTotalEl) itemTotalEl.textContent = '₦' + itemTotal.toLocaleString('en-NG', {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            });
                        }

                        // Update totals
                        if (data.total) {
                            document.getElementById('page-cart-total').textContent = data.total;
                            document.getElementById('page-cart-total-2').textContent = data.total;
                        }
                        updateCartBadge(data.cartCount);
                    }
                });
        }

        function cartRemoveItem(productId) {
            fetch('/cart/remove/' + productId, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                        'X-HTTP-Method-Override': 'DELETE'
                    }
                })
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        const row = document.getElementById('cart-item-' + productId);
                        if (row) {
                            row.style.transition = 'all 0.3s ease';
                            row.style.opacity = '0';
                            row.style.transform = 'translateX(20px)';
                            setTimeout(() => row.remove(), 300);
                        }
                        if (data.total) {
                            document.getElementById('page-cart-total').textContent = data.total;
                            document.getElementById('page-cart-total-2').textContent = data.total;
                        }
                        updateCartBadge(data.cartCount);
                        showToast('Item removed from cart', 'info');
                        if (data.cartCount === 0) {
                            setTimeout(() => location.reload(), 800);
                        }
                    }
                });
        }
    </script>
@endpush
