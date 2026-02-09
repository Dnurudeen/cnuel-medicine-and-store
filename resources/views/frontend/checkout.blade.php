@extends('layouts.app')

@section('title', 'Checkout - C-Nuel Medicine and Store')

@section('content')
    <div class="bg-gray-50 min-h-screen py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-8">Checkout</h1>

            <form action="{{ route('checkout.process') }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 gap-8">
                    <!-- Customer Information -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <h2 class="text-xl font-bold text-gray-800 mb-6">Your Information</h2>

                        <div class="space-y-4">
                            <div>
                                <label for="customer_name" class="block text-sm font-medium text-gray-700 mb-1">Full Name
                                    *</label>
                                <input type="text" name="customer_name" id="customer_name" required
                                    value="{{ old('customer_name') }}"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500">
                                @error('customer_name')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="customer_email" class="block text-sm font-medium text-gray-700 mb-1">Email
                                    Address *</label>
                                <input type="email" name="customer_email" id="customer_email" required
                                    value="{{ old('customer_email') }}"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500">
                                @error('customer_email')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="customer_phone" class="block text-sm font-medium text-gray-700 mb-1">Phone
                                    Number *</label>
                                <input type="tel" name="customer_phone" id="customer_phone" required
                                    value="{{ old('customer_phone') }}"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500">
                                @error('customer_phone')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="customer_address" class="block text-sm font-medium text-gray-700 mb-1">Delivery
                                    Address</label>
                                <textarea name="customer_address" id="customer_address" rows="3"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500">{{ old('customer_address') }}</textarea>
                                @error('customer_address')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">Order Notes
                                    (Optional)</label>
                                <textarea name="notes" id="notes" rows="2" placeholder="Any special instructions..."
                                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500">{{ old('notes') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <h2 class="text-xl font-bold text-gray-800 mb-6">Order Summary</h2>

                        <div class="space-y-4 mb-6">
                            @foreach ($cartItems as $item)
                                <div class="flex justify-between items-center py-2 border-b">
                                    <div class="flex items-center">
                                        <div class="h-12 w-12 bg-gray-100 rounded-lg overflow-hidden mr-3">
                                            @if ($item['product']->image)
                                                <img src="{{ asset('storage/' . $item['product']->image) }}"
                                                    alt="{{ $item['product']->name }}" class="h-full w-full object-cover">
                                            @endif
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-800">{{ $item['product']->name }}</p>
                                            <p class="text-sm text-gray-500">Qty: {{ $item['quantity'] }}</p>
                                        </div>
                                    </div>
                                    <span class="font-semibold">₦{{ number_format($item['total'], 2) }}</span>
                                </div>
                            @endforeach
                        </div>

                        <div class="border-t pt-4">
                            <div class="flex justify-between text-lg font-bold">
                                <span>Total</span>
                                <span class="text-primary-600">₦{{ number_format($total, 2) }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Info -->
                    <div class="bg-green-50 rounded-lg p-6">
                        <div class="flex items-start">
                            <i class="fab fa-whatsapp text-3xl text-green-600 mr-4"></i>
                            <div>
                                <h3 class="font-bold text-green-800 mb-2">Payment via WhatsApp</h3>
                                <p class="text-green-700 text-sm">After placing your order, you will be redirected to
                                    WhatsApp to complete payment with our team. You will also receive a downloadable
                                    invoice.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Submit -->
                    <button type="submit"
                        class="w-full bg-primary-500 text-white py-4 rounded-lg font-semibold text-lg hover:bg-primary-600 transition">
                        Place Order & Continue to WhatsApp
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
