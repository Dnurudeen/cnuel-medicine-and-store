@extends('layouts.app')

@section('title', 'Order Complete - C-Nuel Medicine and Store')

@section('content')
    <div class="bg-gray-50 min-h-screen py-12">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-lg p-8 text-center">
                <!-- Success Icon -->
                <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-check text-4xl text-green-600"></i>
                </div>

                <h1 class="text-3xl font-bold text-gray-800 mb-2">Order Placed Successfully!</h1>
                <p class="text-gray-600 mb-6">Thank you for your order. Your order number is:</p>

                <div class="bg-gray-100 rounded-lg p-4 mb-6">
                    <span class="text-2xl font-bold text-primary-600">{{ $order->order_number }}</span>
                </div>

                <!-- Order Details -->
                <div class="text-left bg-gray-50 rounded-lg p-6 mb-6">
                    <h2 class="font-bold text-gray-800 mb-4">Order Details</h2>

                    <div class="space-y-2 mb-4">
                        @foreach ($order->items as $item)
                            <div class="flex justify-between">
                                <span class="text-gray-600">{{ $item->product_name }} x {{ $item->quantity }}</span>
                                <span class="font-medium">₦{{ number_format($item->total, 2) }}</span>
                            </div>
                        @endforeach
                    </div>

                    <div class="border-t pt-4">
                        <div class="flex justify-between font-bold text-lg">
                            <span>Total</span>
                            <span class="text-primary-600">₦{{ number_format($order->total, 2) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Customer Info -->
                <div class="text-left bg-gray-50 rounded-lg p-6 mb-6">
                    <h2 class="font-bold text-gray-800 mb-4">Customer Information</h2>
                    <p class="text-gray-600"><strong>Name:</strong> {{ $order->customer_name }}</p>
                    <p class="text-gray-600"><strong>Email:</strong> {{ $order->customer_email }}</p>
                    <p class="text-gray-600"><strong>Phone:</strong> {{ $order->customer_phone }}</p>
                    @if ($order->customer_address)
                        <p class="text-gray-600"><strong>Address:</strong> {{ $order->customer_address }}</p>
                    @endif
                </div>

                <!-- Action Buttons -->
                <div class="space-y-4">
                    <!-- Download Invoice -->
                    <a href="{{ route('invoice.download', $order) }}"
                        class="block w-full bg-gray-800 text-white py-3 rounded-lg font-semibold hover:bg-gray-900 transition">
                        <i class="fas fa-download mr-2"></i> Download Invoice
                    </a>

                    <!-- Continue to WhatsApp -->
                    <a href="{{ $whatsappUrl }}" target="_blank"
                        class="block w-full bg-green-500 text-white py-4 rounded-lg font-semibold text-lg hover:bg-green-600 transition">
                        <i class="fab fa-whatsapp mr-2"></i> Complete Payment on WhatsApp
                    </a>

                    <!-- Back to Shop -->
                    <a href="{{ route('shop') }}"
                        class="block w-full border border-gray-300 text-gray-700 py-3 rounded-lg font-semibold hover:bg-gray-50 transition">
                        Continue Shopping
                    </a>
                </div>

                <!-- Note -->
                <p class="text-sm text-gray-500 mt-6">
                    Please click the WhatsApp button above to complete your payment. Our team will assist you with the
                    payment process and delivery details.
                </p>
            </div>
        </div>
    </div>
@endsection
