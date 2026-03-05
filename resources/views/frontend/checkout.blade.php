@extends('layouts.app')

@section('title', 'Checkout — C-Nuel Medicine and Store')

@section('content')
    <div class="bg-gray-50 min-h-screen pb-28 md:pb-10">

        {{-- Header --}}
        <div class="bg-white border-b border-gray-100">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                <div class="flex items-center gap-3">
                    <a href="{{ route('cart.index') }}"
                        class="w-9 h-9 flex items-center justify-center rounded-xl bg-gray-100 text-gray-600 hover:bg-gray-200 transition flex-shrink-0">
                        <i class="fas fa-arrow-left text-sm"></i>
                    </a>
                    <div>
                        <h1 class="font-display font-extrabold text-xl text-gray-900">Checkout</h1>
                        <p class="text-xs text-gray-400">Fill in your details to place order</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <form action="{{ route('checkout.process') }}" method="POST" id="checkout-form">
                @csrf
                <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">

                    {{-- ── Left: Customer Form ── --}}
                    <div class="lg:col-span-3 space-y-4">

                        {{-- Contact Info --}}
                        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                            <h2 class="font-display font-bold text-base text-gray-900 mb-4 flex items-center gap-2">
                                <span
                                    class="w-7 h-7 rounded-full bg-primary-100 text-primary-600 text-xs font-bold flex items-center justify-center">1</span>
                                Contact Information
                            </h2>
                            <div class="space-y-4">
                                <div>
                                    <label
                                        class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">Full
                                        Name <span class="text-red-400">*</span></label>
                                    <input type="text" name="customer_name" required value="{{ old('customer_name') }}"
                                        placeholder="Enter your full name"
                                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-primary-300 focus:border-primary-400 outline-none transition bg-gray-50 focus:bg-white">
                                    @error('customer_name')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <label
                                            class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">Email
                                            <span class="text-red-400">*</span></label>
                                        <input type="email" name="customer_email" required
                                            value="{{ old('customer_email') }}" placeholder="you@example.com"
                                            class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-primary-300 focus:border-primary-400 outline-none transition bg-gray-50 focus:bg-white">
                                        @error('customer_email')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label
                                            class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">Phone
                                            <span class="text-red-400">*</span></label>
                                        <input type="tel" name="customer_phone" required
                                            value="{{ old('customer_phone') }}" placeholder="08012345678"
                                            class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-primary-300 focus:border-primary-400 outline-none transition bg-gray-50 focus:bg-white">
                                        @error('customer_phone')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Delivery --}}
                        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                            <h2 class="font-display font-bold text-base text-gray-900 mb-4 flex items-center gap-2">
                                <span
                                    class="w-7 h-7 rounded-full bg-primary-100 text-primary-600 text-xs font-bold flex items-center justify-center">2</span>
                                Delivery Address
                            </h2>
                            <div class="space-y-4">
                                <div>
                                    <label
                                        class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">Address</label>
                                    <textarea name="customer_address" rows="3" placeholder="Street address, area, city..."
                                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-primary-300 focus:border-primary-400 outline-none transition bg-gray-50 focus:bg-white resize-none">{{ old('customer_address') }}</textarea>
                                    @error('customer_address')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label
                                        class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">Order
                                        Notes <span class="text-gray-400 font-normal normal-case">(optional)</span></label>
                                    <textarea name="notes" rows="2" placeholder="Any special instructions or requests..."
                                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-primary-300 focus:border-primary-400 outline-none transition bg-gray-50 focus:bg-white resize-none">{{ old('notes') }}</textarea>
                                </div>
                            </div>
                        </div>

                        {{-- Payment notice --}}
                        <div class="bg-emerald-50 border border-emerald-200 rounded-2xl p-4 flex items-start gap-3">
                            <div class="w-10 h-10 rounded-xl bg-[#25D366] flex items-center justify-center flex-shrink-0">
                                <i class="fab fa-whatsapp text-white text-xl"></i>
                            </div>
                            <div>
                                <p class="font-semibold text-emerald-800 text-sm mb-1">Payment via WhatsApp</p>
                                <p class="text-emerald-700 text-xs leading-relaxed">After placing your order you'll be
                                    redirected to WhatsApp to complete payment securely with our team. You'll also receive a
                                    downloadable invoice.</p>
                            </div>
                        </div>

                        {{-- Submit (mobile) --}}
                        <button type="submit"
                            class="lg:hidden w-full flex items-center justify-center gap-2 bg-primary-600 text-white py-4 rounded-2xl font-bold text-base hover:bg-primary-700 transition btn-ripple">
                            <i class="fab fa-whatsapp text-lg"></i>
                            Place Order & Go to WhatsApp
                        </button>
                    </div>

                    {{-- ── Right: Order Summary ── --}}
                    <div class="lg:col-span-2">
                        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 lg:sticky lg:top-24">
                            <h2 class="font-display font-bold text-base text-gray-900 mb-4 pb-4 border-b border-gray-100">
                                Order Summary
                            </h2>
                            <div class="space-y-3 mb-4 max-h-[300px] overflow-y-auto">
                                @foreach ($cartItems as $item)
                                    <div class="flex gap-3 items-center">
                                        <div
                                            class="w-12 h-12 rounded-xl overflow-hidden bg-gray-50 border border-gray-100 flex-shrink-0">
                                            @if ($item['product']->image)
                                                <img src="{{ asset('storage/' . $item['product']->image) }}"
                                                    alt="{{ $item['product']->name }}" class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center"><i
                                                        class="fas fa-pills text-gray-200"></i></div>
                                            @endif
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-xs font-semibold text-gray-800 line-clamp-2 leading-tight">
                                                {{ $item['product']->name }}</p>
                                            <p class="text-xs text-gray-400 mt-0.5">Qty: {{ $item['quantity'] }}</p>
                                        </div>
                                        <p class="text-xs font-bold text-gray-900 flex-shrink-0">
                                            ₦{{ number_format($item['total'], 2) }}</p>
                                    </div>
                                @endforeach
                            </div>

                            <div class="border-t border-gray-100 pt-4 space-y-2 text-sm">
                                <div class="flex justify-between text-gray-600">
                                    <span>Subtotal</span>
                                    <span>₦{{ number_format($total, 2) }}</span>
                                </div>
                                <div class="flex justify-between text-gray-600">
                                    <span>Delivery</span>
                                    <span class="text-primary-600 font-semibold">Free 🎉</span>
                                </div>
                            </div>
                            <div class="border-t border-gray-100 mt-3 pt-3 flex justify-between items-center">
                                <span class="font-bold text-gray-900">Total</span>
                                <span
                                    class="font-extrabold text-primary-600 text-xl">₦{{ number_format($total, 2) }}</span>
                            </div>

                            <button type="submit"
                                class="hidden lg:flex mt-5 w-full items-center justify-center gap-2 bg-primary-600 text-white py-4 rounded-2xl font-bold text-base hover:bg-primary-700 transition btn-ripple">
                                <i class="fab fa-whatsapp text-lg"></i>
                                Place Order & Pay
                            </button>
                            <p class="text-center text-xs text-gray-400 mt-3">🔒 Secure checkout via WhatsApp</p>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
