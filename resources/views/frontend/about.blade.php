@extends('layouts.app')

@section('title', 'About Us — C-Nuel Medicine and Store')
@section('description', 'Learn about C-Nuel Medicine and Store — your trusted source for genuine medicines and
    healthcare products.')

@section('content')
    <div class="bg-gray-50 min-h-screen pb-20 md:pb-0">

        {{-- Hero --}}
        <div class="relative bg-gradient-to-br from-emerald-900 via-primary-800 to-emerald-700 text-white overflow-hidden">
            <div class="absolute inset-0 opacity-10"
                style="background-image: radial-gradient(circle at 30% 70%, #fff 0%, transparent 50%), radial-gradient(circle at 80% 20%, #4ade80 0%, transparent 50%);">
            </div>
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24 relative">
                @if ($page && $page->activeSections->where('type', 'hero')->first())
                    @php $hero = $page->activeSections->where('type', 'hero')->first(); @endphp
                    <div
                        class="inline-flex items-center gap-2 bg-white/10 backdrop-blur rounded-full px-4 py-2 text-sm font-medium mb-6">
                        <i class="fas fa-hospital text-emerald-300"></i> Our Story
                    </div>
                    <h1 class="font-display font-extrabold text-4xl md:text-5xl mb-4 leading-tight">{{ $hero->title }}</h1>
                    <p class="text-emerald-100 text-lg max-w-2xl">{{ $hero->content }}</p>
                @else
                    <div
                        class="inline-flex items-center gap-2 bg-white/10 backdrop-blur rounded-full px-4 py-2 text-sm font-medium mb-6">
                        <i class="fas fa-hospital text-emerald-300"></i> Our Story
                    </div>
                    <h1 class="font-display font-extrabold text-4xl md:text-5xl mb-4 leading-tight">About C-Nuel<br>Medicine
                        &amp; Store</h1>
                    <p class="text-emerald-100 text-lg max-w-2xl">Your trusted local partner for genuine medicines,
                        vitamins, and healthcare essentials — delivered with care.</p>
                @endif
            </div>
        </div>

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-8">

            {{-- Dynamic content sections --}}
            @if ($page && $page->activeSections->where('type', 'text')->count() > 0)
                @foreach ($page->activeSections->where('type', 'text') as $section)
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 md:p-8">
                        @if ($section->title)
                            <h2 class="font-display font-bold text-xl text-gray-900 mb-4">{{ $section->title }}</h2>
                        @endif
                        <div class="prose max-w-none text-gray-600 text-sm leading-relaxed">
                            {!! nl2br(e($section->content)) !!}
                        </div>
                    </div>
                @endforeach
            @else
                {{-- Default fallback content --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                        <div class="w-12 h-12 rounded-2xl bg-emerald-100 flex items-center justify-center mb-4">
                            <i class="fas fa-leaf text-emerald-600 text-xl"></i>
                        </div>
                        <h2 class="font-display font-bold text-lg text-gray-900 mb-3">Our Story</h2>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            C-Nuel Medicine and Store was founded with a simple mission: to make quality healthcare
                            accessible to everyone in our community. We understand the importance of genuine medications in
                            maintaining good health.
                        </p>
                        <p class="text-gray-600 text-sm leading-relaxed mt-3">
                            Our team of dedicated professionals works tirelessly to ensure you receive only the best
                            products sourced from trusted manufacturers.
                        </p>
                    </div>
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                        <div class="w-12 h-12 rounded-2xl bg-blue-100 flex items-center justify-center mb-4">
                            <i class="fas fa-bullseye text-blue-600 text-xl"></i>
                        </div>
                        <h2 class="font-display font-bold text-lg text-gray-900 mb-3">Our Mission</h2>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            To provide our community with quality healthcare products at affordable prices, while
                            maintaining the highest standards of customer service and product authenticity.
                        </p>
                        <p class="text-gray-600 text-sm leading-relaxed mt-3">
                            We believe that every person deserves access to genuine, affordable healthcare — without
                            compromise.
                        </p>
                    </div>
                </div>

                {{-- Why choose us --}}
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 md:p-8">
                    <h2 class="font-display font-bold text-xl text-gray-900 mb-6">Why Choose Us?</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @php
                            $features = [
                                [
                                    'icon' => 'fas fa-shield-alt',
                                    'color' => 'emerald',
                                    'title' => '100% Genuine Products',
                                    'desc' =>
                                        'All our products are sourced directly from trusted, certified manufacturers.',
                                ],
                                [
                                    'icon' => 'fas fa-tag',
                                    'color' => 'blue',
                                    'title' => 'Competitive Pricing',
                                    'desc' =>
                                        'We offer the best prices in the market with regular discounts and offers.',
                                ],
                                [
                                    'icon' => 'fas fa-truck',
                                    'color' => 'purple',
                                    'title' => 'Fast Delivery',
                                    'desc' => 'Quick and reliable delivery right to your doorstep.',
                                ],
                                [
                                    'icon' => 'fab fa-whatsapp',
                                    'color' => 'green',
                                    'title' => 'WhatsApp Support',
                                    'desc' => 'Instant support and order assistance via WhatsApp chat.',
                                ],
                                [
                                    'icon' => 'fas fa-clock',
                                    'color' => 'orange',
                                    'title' => '24/7 Availability',
                                    'desc' => 'Browse and order anytime — we are always here for you.',
                                ],
                                [
                                    'icon' => 'fas fa-heart',
                                    'color' => 'red',
                                    'title' => 'Trusted by Many',
                                    'desc' => 'Thousands of satisfied customers trust us for their healthcare needs.',
                                ],
                            ];
                        @endphp
                        @foreach ($features as $f)
                            <div class="flex gap-4 items-start p-4 rounded-xl bg-gray-50 border border-gray-100">
                                <div
                                    class="w-10 h-10 rounded-xl bg-{{ $f['color'] }}-100 flex items-center justify-center flex-shrink-0">
                                    <i class="{{ $f['icon'] }} text-{{ $f['color'] }}-600"></i>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900 text-sm">{{ $f['title'] }}</p>
                                    <p class="text-gray-500 text-xs mt-0.5 leading-relaxed">{{ $f['desc'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Stats row --}}
            <div class="grid grid-cols-3 gap-4">
                <div class="bg-gradient-to-br from-primary-600 to-emerald-600 rounded-2xl p-5 text-center text-white">
                    <p class="font-display font-extrabold text-3xl">500+</p>
                    <p class="text-emerald-100 text-xs mt-1">Products</p>
                </div>
                <div class="bg-gradient-to-br from-blue-600 to-blue-500 rounded-2xl p-5 text-center text-white">
                    <p class="font-display font-extrabold text-3xl">1K+</p>
                    <p class="text-blue-100 text-xs mt-1">Customers</p>
                </div>
                <div class="bg-gradient-to-br from-amber-500 to-orange-500 rounded-2xl p-5 text-center text-white">
                    <p class="font-display font-extrabold text-3xl">100%</p>
                    <p class="text-orange-100 text-xs mt-1">Genuine</p>
                </div>
            </div>

            {{-- CTA --}}
            <div class="bg-gradient-to-br from-primary-600 to-emerald-500 rounded-3xl p-8 md:p-10 text-center text-white">
                <h2 class="font-display font-extrabold text-2xl md:text-3xl mb-3">Ready to Shop?</h2>
                <p class="text-emerald-100 mb-6">Browse our collection of quality medicines and healthcare products.</p>
                <div class="flex flex-col sm:flex-row gap-3 justify-center">
                    <a href="{{ route('shop') }}"
                        class="inline-flex items-center justify-center gap-2 bg-white text-primary-700 px-6 py-3.5 rounded-2xl font-bold hover:bg-gray-50 transition btn-ripple">
                        <i class="fas fa-store"></i> Visit Our Shop
                    </a>
                    <a href="https://wa.me/2348034966505" target="_blank"
                        class="inline-flex items-center justify-center gap-2 bg-[#25D366] text-white px-6 py-3.5 rounded-2xl font-bold hover:bg-[#20bd5a] transition btn-ripple">
                        <i class="fab fa-whatsapp"></i> Chat with Us
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
