@extends('layouts.app')

@section('title', 'Contact Us - C-Nuel Medicine and Store')

@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-primary-600 to-secondary-500 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            @if ($page && $page->activeSections->where('type', 'hero')->first())
                @php $hero = $page->activeSections->where('type', 'hero')->first(); @endphp
                <h1 class="text-4xl font-bold mb-4">{{ $hero->title }}</h1>
                <p class="text-xl text-green-100">{{ $hero->content }}</p>
            @else
                <h1 class="text-4xl font-bold mb-4">Contact Us</h1>
                <p class="text-xl text-green-100">We're here to help with all your healthcare needs</p>
            @endif
        </div>
    </section>

    <!-- Contact Section -->
    <section class="py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <!-- Contact Info -->
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Get In Touch</h2>
                    <p class="text-gray-600 mb-8">
                        Have questions about our products or need assistance with your order? We're here to help! Reach out
                        to us through any of the channels below.
                    </p>

                    <div class="space-y-6">
                        <!-- WhatsApp -->
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mr-4">
                                <i class="fab fa-whatsapp text-2xl text-green-600"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-800">WhatsApp</h3>
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $whatsapp) }}" target="_blank"
                                    class="text-primary-600 hover:underline">
                                    {{ $whatsapp }}
                                </a>
                                <p class="text-sm text-gray-500 mt-1">Click to chat directly</p>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-primary-100 rounded-full flex items-center justify-center mr-4">
                                <i class="fas fa-envelope text-2xl text-primary-600"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-800">Email</h3>
                                <a href="mailto:{{ $email }}" class="text-primary-600 hover:underline">
                                    {{ $email }}
                                </a>
                                <p class="text-sm text-gray-500 mt-1">We'll respond within 24 hours</p>
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-secondary-100 rounded-full flex items-center justify-center mr-4">
                                <i class="fas fa-map-marker-alt text-2xl text-secondary-600"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-800">Location</h3>
                                <p class="text-gray-600">{{ $address }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Contact via WhatsApp -->
                <div>
                    <div class="bg-white rounded-lg shadow-lg p-8">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6">Quick Contact</h2>
                        <p class="text-gray-600 mb-6">
                            The fastest way to reach us is through WhatsApp. Click the button below to start a conversation.
                        </p>

                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $whatsapp) }}?text=Hello! I have a question about your products."
                            target="_blank"
                            class="block w-full bg-green-500 text-white text-center py-4 rounded-lg font-semibold text-lg hover:bg-green-600 transition mb-4">
                            <i class="fab fa-whatsapp mr-2"></i> Chat on WhatsApp
                        </a>

                        <div class="text-center text-sm text-gray-500">
                            <p>Available Monday - Saturday</p>
                            <p>9:00 AM - 6:00 PM</p>
                        </div>
                    </div>

                    <!-- FAQ Preview -->
                    <div class="mt-8 bg-gray-50 rounded-lg p-6">
                        <h3 class="font-bold text-gray-800 mb-4">Frequently Asked Questions</h3>

                        <div class="space-y-4">
                            <div>
                                <h4 class="font-medium text-gray-800">How do I place an order?</h4>
                                <p class="text-sm text-gray-600">Simply add products to your cart and proceed to checkout.
                                    You'll complete payment via WhatsApp.</p>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-800">Are your products genuine?</h4>
                                <p class="text-sm text-gray-600">Yes, all our products are 100% genuine and sourced from
                                    trusted manufacturers.</p>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-800">How long does delivery take?</h4>
                                <p class="text-sm text-gray-600">Delivery time depends on your location. Contact us for
                                    specific estimates.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
