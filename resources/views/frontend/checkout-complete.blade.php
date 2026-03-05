@extends('layouts.app')

@section('title', 'Order Placed! — C-Nuel Medicine and Store')

@push('styles')
    <style>
        @keyframes successPop {
            0% {
                transform: scale(0);
                opacity: 0;
            }

            60% {
                transform: scale(1.15);
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        @keyframes checkDraw {
            from {
                stroke-dashoffset: 50;
            }

            to {
                stroke-dashoffset: 0;
            }
        }

        .success-icon {
            animation: successPop 0.6s cubic-bezier(.36, .07, .19, .97) forwards;
        }

        .confetti-dot {
            position: absolute;
            border-radius: 50%;
            animation: confettiFall 1.5s ease forwards;
        }

        @keyframes confettiFall {
            0% {
                transform: translateY(-20px) rotate(0deg);
                opacity: 1;
            }

            100% {
                transform: translateY(80px) rotate(360deg);
                opacity: 0;
            }
        }
    </style>
@endpush

@section('content')
    <div class="bg-gray-50 min-h-screen pb-28 md:pb-10">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            {{-- Success card --}}
            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">

                {{-- Green top banner --}}
                <div
                    class="relative bg-gradient-to-br from-emerald-500 to-primary-600 px-6 pt-10 pb-16 text-center overflow-hidden">
                    {{-- Decorative circles --}}
                    <div class="absolute top-0 left-0 w-40 h-40 rounded-full bg-white/5 -translate-x-1/2 -translate-y-1/2">
                    </div>
                    <div class="absolute bottom-0 right-0 w-32 h-32 rounded-full bg-white/5 translate-x-1/2 translate-y-1/2">
                    </div>

                    <div
                        class="success-icon relative w-20 h-20 bg-white rounded-full mx-auto flex items-center justify-center shadow-lg mb-5">
                        <i class="fas fa-check text-3xl text-primary-600"></i>
                        {{-- Confetti dots --}}
                        <span class="confetti-dot w-3 h-3 bg-yellow-400 absolute -top-1 -right-1"
                            style="animation-delay:0.1s"></span>
                        <span class="confetti-dot w-2 h-2 bg-pink-400 absolute top-0 left-2"
                            style="animation-delay:0.2s"></span>
                        <span class="confetti-dot w-2.5 h-2.5 bg-blue-400 absolute -bottom-1 -right-2"
                            style="animation-delay:0.15s"></span>
                        <span class="confetti-dot w-2 h-2 bg-orange-400 absolute -bottom-2 left-0"
                            style="animation-delay:0.3s"></span>
                    </div>
                    <h1 class="font-display font-extrabold text-white text-2xl mb-1">Order Placed! 🎉</h1>
                    <p class="text-emerald-100 text-sm">Thank you, your order is confirmed</p>
                </div>

                {{-- Order number --}}
                <div class="relative -mt-8 mx-6">
                    <div
                        class="bg-white rounded-2xl border border-gray-100 shadow-md px-5 py-4 flex items-center justify-between">
                        <div>
                            <p class="text-xs text-gray-400 font-medium uppercase tracking-wide">Order Number</p>
                            <p class="font-display font-extrabold text-primary-600 text-xl mt-0.5">
                                {{ $order->order_number }}</p>
                        </div>
                        <div class="w-10 h-10 rounded-xl bg-primary-50 flex items-center justify-center">
                            <i class="fas fa-receipt text-primary-500"></i>
                        </div>
                    </div>
                </div>

                <div class="px-6 py-6 space-y-5">
                    {{-- Order Items --}}
                    <div class="bg-gray-50 rounded-2xl p-4">
                        <h2 class="font-semibold text-gray-800 text-sm mb-3 flex items-center gap-2">
                            <i class="fas fa-shopping-bag text-primary-400 text-xs"></i> Items Ordered
                        </h2>
                        <div class="space-y-2.5">
                            @foreach ($order->items as $item)
                                <div class="flex justify-between items-center text-sm">
                                    <span class="text-gray-600">{{ $item->product_name }} <span class="text-gray-400">×
                                            {{ $item->quantity }}</span></span>
                                    <span class="font-semibold text-gray-900">₦{{ number_format($item->total, 2) }}</span>
                                </div>
                            @endforeach
                        </div>
                        <div class="border-t border-gray-200 mt-3 pt-3 flex justify-between items-center">
                            <span class="font-bold text-gray-900">Total</span>
                            <span
                                class="font-extrabold text-primary-600 text-lg">₦{{ number_format($order->total, 2) }}</span>
                        </div>
                    </div>

                    {{-- Customer Info --}}
                    <div class="bg-gray-50 rounded-2xl p-4">
                        <h2 class="font-semibold text-gray-800 text-sm mb-3 flex items-center gap-2">
                            <i class="fas fa-user text-primary-400 text-xs"></i> Delivery Details
                        </h2>
                        <div class="space-y-1.5 text-sm">
                            <p><span class="text-gray-500">Name:</span> <span
                                    class="font-medium text-gray-800 ml-1">{{ $order->customer_name }}</span></p>
                            <p><span class="text-gray-500">Phone:</span> <span
                                    class="font-medium text-gray-800 ml-1">{{ $order->customer_phone }}</span></p>
                            <p><span class="text-gray-500">Email:</span> <span
                                    class="font-medium text-gray-800 ml-1">{{ $order->customer_email }}</span></p>
                            @if ($order->customer_address)
                                <p><span class="text-gray-500">Address:</span> <span
                                        class="font-medium text-gray-800 ml-1">{{ $order->customer_address }}</span></p>
                            @endif
                        </div>
                    </div>

                    {{-- CTA Buttons --}}
                    <div class="space-y-3">
                        <a href="{{ $whatsappUrl }}" target="_blank"
                            class="flex items-center justify-center gap-2.5 w-full bg-[#25D366] text-white py-4 rounded-2xl font-bold text-base hover:bg-[#20bd5a] transition btn-ripple">
                            <i class="fab fa-whatsapp text-xl"></i>
                            Complete Payment on WhatsApp
                        </a>
                        <a href="{{ route('invoice.download', $order) }}"
                            class="flex items-center justify-center gap-2.5 w-full bg-gray-900 text-white py-3.5 rounded-2xl font-bold text-sm hover:bg-gray-800 transition btn-ripple">
                            <i class="fas fa-file-pdf text-red-400"></i>
                            Download Invoice (PDF)
                        </a>
                        <a href="{{ route('shop') }}"
                            class="flex items-center justify-center gap-2 w-full border border-gray-200 text-gray-700 py-3 rounded-2xl font-semibold text-sm hover:bg-gray-50 transition">
                            <i class="fas fa-store text-xs text-gray-400"></i> Continue Shopping
                        </a>
                    </div>

                    <p class="text-center text-xs text-gray-400 leading-relaxed">
                        Tap the WhatsApp button above to finalize payment. Our team will confirm your order and arrange
                        delivery.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
