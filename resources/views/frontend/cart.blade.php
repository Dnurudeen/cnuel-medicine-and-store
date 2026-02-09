@extends('layouts.app')

@section('title', 'Shopping Cart - C-Nuel Medicine and Store')

@section('content')
    <div class="bg-gray-50 min-h-screen py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-8">Shopping Cart</h1>

            @if (count($cartItems) > 0)
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Cart Items -->
                    <div class="lg:col-span-2">
                        <div class="bg-white rounded-lg shadow overflow-hidden">
                            <table class="w-full">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Product</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Price</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Quantity</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Total</th>
                                        <th class="px-6 py-3"></th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach ($cartItems as $item)
                                        <tr>
                                            <td class="px-6 py-4">
                                                <div class="flex items-center">
                                                    <div
                                                        class="h-16 w-16 flex-shrink-0 bg-gray-100 rounded-lg overflow-hidden">
                                                        @if ($item['product']->image)
                                                            <img src="{{ asset('storage/' . $item['product']->image) }}"
                                                                alt="{{ $item['product']->name }}"
                                                                class="h-full w-full object-cover">
                                                        @else
                                                            <div
                                                                class="h-full w-full flex items-center justify-center text-gray-400">
                                                                <i class="fas fa-image"></i>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="ml-4">
                                                        <a href="{{ route('product.show', $item['product']->slug) }}"
                                                            class="text-gray-800 font-medium hover:text-primary-600">
                                                            {{ $item['product']->name }}
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 text-gray-600">
                                                ₦{{ number_format($item['product']->sale_price ?? $item['product']->price, 2) }}
                                            </td>
                                            <td class="px-6 py-4">
                                                <form action="{{ route('cart.update', $item['product']) }}" method="POST"
                                                    class="update-qty-form flex items-center">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}"
                                                        min="1" max="{{ $item['product']->stock_quantity }}"
                                                        class="w-20 border border-gray-300 rounded-lg px-3 py-1 text-center focus:ring-primary-500 focus:border-primary-500">
                                                    <button type="submit"
                                                        class="ml-2 text-primary-600 hover:text-primary-800">
                                                        <i class="fas fa-sync-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                            <td class="px-6 py-4 font-semibold text-gray-800">
                                                ₦{{ number_format($item['total'], 2) }}
                                            </td>
                                            <td class="px-6 py-4">
                                                <form action="{{ route('cart.remove', $item['product']) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-500 hover:text-red-700">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4 flex justify-between items-center">
                            <a href="{{ route('shop') }}" class="text-primary-600 hover:text-primary-800">
                                <i class="fas fa-arrow-left mr-2"></i> Continue Shopping
                            </a>
                            <form action="{{ route('cart.clear') }}" method="POST">
                                @csrf
                                <button type="submit" class="text-red-500 hover:text-red-700">
                                    <i class="fas fa-trash mr-2"></i> Clear Cart
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Cart Summary -->
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-lg shadow p-6">
                            <h2 class="text-xl font-bold text-gray-800 mb-4">Order Summary</h2>

                            <div class="space-y-3 mb-6">
                                <div class="flex justify-between text-gray-600">
                                    <span>Subtotal</span>
                                    <span>₦{{ number_format($total, 2) }}</span>
                                </div>
                                <div class="flex justify-between text-gray-600">
                                    <span>Shipping</span>
                                    <span class="text-primary-600">Calculated at checkout</span>
                                </div>
                                <div class="border-t pt-3">
                                    <div class="flex justify-between text-lg font-bold">
                                        <span>Total</span>
                                        <span class="text-primary-600">₦{{ number_format($total, 2) }}</span>
                                    </div>
                                </div>
                            </div>

                            <a href="{{ route('checkout.index') }}"
                                class="block w-full bg-primary-500 text-white text-center py-3 rounded-lg font-semibold hover:bg-primary-600 transition">
                                Proceed to Checkout
                            </a>

                            <div class="mt-4 p-4 bg-green-50 rounded-lg">
                                <p class="text-sm text-green-700">
                                    <i class="fab fa-whatsapp mr-1"></i>
                                    Checkout will redirect you to WhatsApp to complete payment
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-white rounded-lg shadow p-12 text-center">
                    <i class="fas fa-shopping-cart text-6xl text-gray-300 mb-4"></i>
                    <h2 class="text-2xl font-semibold text-gray-600 mb-2">Your cart is empty</h2>
                    <p class="text-gray-500 mb-6">Looks like you haven't added any products yet.</p>
                    <a href="{{ route('shop') }}"
                        class="inline-block bg-primary-500 text-white px-8 py-3 rounded-lg font-semibold hover:bg-primary-600 transition">
                        Start Shopping
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
