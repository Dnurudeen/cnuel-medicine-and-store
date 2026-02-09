@extends('layouts.app')

@section('title', 'About Us - C-Nuel Medicine and Store')

@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-primary-600 to-secondary-500 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            @if ($page && $page->activeSections->where('type', 'hero')->first())
                @php $hero = $page->activeSections->where('type', 'hero')->first(); @endphp
                <h1 class="text-4xl font-bold mb-4">{{ $hero->title }}</h1>
                <p class="text-xl text-green-100">{{ $hero->content }}</p>
            @else
                <h1 class="text-4xl font-bold mb-4">About Us</h1>
                <p class="text-xl text-green-100">Learn more about C-Nuel Medicine and Store</p>
            @endif
        </div>
    </section>

    <!-- Content Sections -->
    <section class="py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            @if ($page && $page->activeSections->where('type', 'text')->count() > 0)
                @foreach ($page->activeSections->where('type', 'text') as $section)
                    <div class="mb-12">
                        @if ($section->title)
                            <h2 class="text-2xl font-bold text-gray-800 mb-4">{{ $section->title }}</h2>
                        @endif
                        <div class="prose max-w-none text-gray-600">
                            {!! nl2br(e($section->content)) !!}
                        </div>
                    </div>
                @endforeach
            @else
                <div class="mb-12">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Our Story</h2>
                    <p class="text-gray-600 mb-4">
                        C-Nuel Medicine and Store was founded with a simple mission: to make quality healthcare accessible
                        to everyone. We understand the importance of genuine medications and healthcare products in
                        maintaining good health.
                    </p>
                    <p class="text-gray-600 mb-4">
                        Our team of dedicated professionals works tirelessly to ensure that you receive only the best
                        products sourced from trusted manufacturers. We believe that everyone deserves access to affordable,
                        genuine medications.
                    </p>
                </div>

                <div class="mb-12">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Our Mission</h2>
                    <p class="text-gray-600">
                        To provide our community with quality healthcare products at affordable prices, while maintaining
                        the highest standards of customer service and product authenticity.
                    </p>
                </div>

                <div class="mb-12">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Why Choose Us?</h2>
                    <ul class="space-y-3 text-gray-600">
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-primary-500 mt-1 mr-3"></i>
                            <span>100% genuine products from trusted manufacturers</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-primary-500 mt-1 mr-3"></i>
                            <span>Competitive prices and regular discounts</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-primary-500 mt-1 mr-3"></i>
                            <span>Fast and reliable delivery</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-primary-500 mt-1 mr-3"></i>
                            <span>Excellent customer support via WhatsApp</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-primary-500 mt-1 mr-3"></i>
                            <span>Easy ordering process</span>
                        </li>
                    </ul>
                </div>
            @endif
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-primary-600 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold mb-4">Ready to Shop?</h2>
            <p class="text-xl text-green-100 mb-8">Browse our collection of quality medicines and healthcare products.</p>
            <a href="{{ route('shop') }}"
                class="inline-block bg-white text-primary-600 px-8 py-4 rounded-lg font-semibold text-lg hover:bg-gray-100 transition">
                Visit Our Shop
            </a>
        </div>
    </section>
@endsection
