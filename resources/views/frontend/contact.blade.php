@extends('layouts.app')

@section('title', 'Contact Us — C-Nuel Medicine and Store')

@section('content')
    <div class="bg-gray-50 min-h-screen pb-20 md:pb-0">

        {{-- Hero --}}
        <div class="relative bg-gradient-to-br from-primary-800 via-primary-700 to-emerald-600 text-white overflow-hidden">
            <div class="absolute inset-0 opacity-10"
                style="background: radial-gradient(circle at 20% 80%, #fff 0%, transparent 40%);"></div>
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-14 md:py-20 relative text-center">
                @if ($page && $page->activeSections->where('type', 'hero')->first())
                    @php $hero = $page->activeSections->where('type', 'hero')->first(); @endphp
                    <h1 class="font-display font-extrabold text-4xl md:text-5xl mb-3">{{ $hero->title }}</h1>
                    <p class="text-emerald-100 text-lg">{{ $hero->content }}</p>
                @else
                    <div
                        class="inline-flex items-center gap-2 bg-white/10 backdrop-blur rounded-full px-4 py-2 text-sm font-medium mb-5">
                        <i class="fas fa-headset text-emerald-300"></i> We're here to help
                    </div>
                    <h1 class="font-display font-extrabold text-4xl md:text-5xl mb-3">Contact Us</h1>
                    <p class="text-emerald-100 text-lg max-w-xl mx-auto">Got questions about your order or our products?
                        Reach out — we respond fast!</p>
                @endif
            </div>
        </div>

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-6">

            {{-- Contact Cards Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                {{-- WhatsApp --}}
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $whatsapp) }}?text=Hello!%20I%20have%20a%20question."
                    target="_blank"
                    class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 flex flex-col items-center text-center hover:shadow-md hover:border-[#25D366]/30 transition group">
                    <div
                        class="w-14 h-14 rounded-2xl bg-[#25D366]/10 flex items-center justify-center mb-3 group-hover:bg-[#25D366]/20 transition">
                        <i class="fab fa-whatsapp text-[#25D366] text-2xl"></i>
                    </div>
                    <p class="font-semibold text-gray-900 text-sm">WhatsApp</p>
                    <p class="text-primary-600 text-sm font-medium mt-1">{{ $whatsapp }}</p>
                    <p class="text-gray-400 text-xs mt-1">Tap to chat instantly</p>
                </a>

                {{-- Email --}}
                <a href="mailto:{{ $email }}"
                    class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 flex flex-col items-center text-center hover:shadow-md hover:border-primary-200 transition group">
                    <div
                        class="w-14 h-14 rounded-2xl bg-primary-50 flex items-center justify-center mb-3 group-hover:bg-primary-100 transition">
                        <i class="fas fa-envelope text-primary-600 text-2xl"></i>
                    </div>
                    <p class="font-semibold text-gray-900 text-sm">Email</p>
                    <p class="text-primary-600 text-sm font-medium mt-1 break-all">{{ $email }}</p>
                    <p class="text-gray-400 text-xs mt-1">Reply within 24 hours</p>
                </a>

                {{-- Location --}}
                <div
                    class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 flex flex-col items-center text-center">
                    <div class="w-14 h-14 rounded-2xl bg-amber-50 flex items-center justify-center mb-3">
                        <i class="fas fa-map-marker-alt text-amber-500 text-2xl"></i>
                    </div>
                    <p class="font-semibold text-gray-900 text-sm">Location</p>
                    <p class="text-gray-600 text-sm mt-1 leading-relaxed">{{ $address }}</p>
                    <p class="text-gray-400 text-xs mt-1">Visit our store</p>
                </div>
            </div>

            {{-- Business Hours + WhatsApp CTA --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                {{-- Hours --}}
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                    <h2 class="font-display font-bold text-base text-gray-900 mb-4 flex items-center gap-2">
                        <i class="fas fa-clock text-primary-400 text-sm"></i> Business Hours
                    </h2>
                    <div class="space-y-2.5 text-sm">
                        @php
                            $hours = [
                                ['day' => 'Monday – Friday', 'time' => '8:00 AM – 7:00 PM', 'open' => true],
                                ['day' => 'Saturday', 'time' => '9:00 AM – 6:00 PM', 'open' => true],
                                ['day' => 'Sunday', 'time' => '10:00 AM – 4:00 PM', 'open' => true],
                            ];
                        @endphp
                        @foreach ($hours as $h)
                            <div class="flex justify-between items-center py-2 border-b border-gray-50 last:border-0">
                                <span class="text-gray-600">{{ $h['day'] }}</span>
                                <span
                                    class="font-semibold {{ $h['open'] ? 'text-primary-600' : 'text-red-400' }}">{{ $h['time'] }}</span>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-4 bg-emerald-50 rounded-xl p-3 flex items-center gap-2">
                        <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                        <p class="text-emerald-700 text-xs font-medium">WhatsApp available outside business hours</p>
                    </div>
                </div>

                {{-- Quick WhatsApp chat --}}
                <div class="bg-gradient-to-br from-[#128C7E] to-[#25D366] rounded-2xl p-6 text-white flex flex-col">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center">
                            <i class="fab fa-whatsapp text-2xl"></i>
                        </div>
                        <div>
                            <p class="font-bold">Chat on WhatsApp</p>
                            <p class="text-green-100 text-xs">Fastest way to reach us</p>
                        </div>
                    </div>
                    <p class="text-green-100 text-sm leading-relaxed mb-5">
                        Get instant help with product info, order status, or anything else. We usually reply within minutes!
                    </p>
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $whatsapp) }}?text=Hello!%20I%20need%20help%20with%20an%20order."
                        target="_blank"
                        class="mt-auto flex items-center justify-center gap-2 bg-white text-[#128C7E] py-3 rounded-xl font-bold text-sm hover:bg-green-50 transition btn-ripple">
                        <i class="fab fa-whatsapp text-lg"></i> Start a Chat
                    </a>
                </div>
            </div>

            {{-- FAQ Accordion --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <h2 class="font-display font-bold text-base text-gray-900 mb-5 flex items-center gap-2">
                    <i class="fas fa-question-circle text-primary-400 text-sm"></i> Frequently Asked Questions
                </h2>
                @php
                    $faqs = [
                        [
                            'q' => 'How do I place an order?',
                            'a' =>
                                'Simply browse our shop, add items to your cart, and proceed to checkout. After filling in your details, you\'ll be redirected to WhatsApp to complete payment with our team.',
                        ],
                        [
                            'q' => 'Are your products genuine?',
                            'a' =>
                                'Yes! All products sold at C-Nuel are 100% genuine, sourced directly from certified and trusted manufacturers. We guarantee authenticity on every item.',
                        ],
                        [
                            'q' => 'How long does delivery take?',
                            'a' =>
                                'Delivery time depends on your location. For local areas, same-day or next-day delivery is available. Contact us on WhatsApp for specific estimates.',
                        ],
                        [
                            'q' => 'Can I return a product?',
                            'a' =>
                                'We accept returns for damaged or incorrect items. Contact us on WhatsApp within 24 hours of receiving your order and we\'ll sort it out for you.',
                        ],
                        [
                            'q' => 'What payment methods do you accept?',
                            'a' =>
                                'We currently accept bank transfers, mobile money, and cash on delivery for local areas. Payment is coordinated through WhatsApp.',
                        ],
                    ];
                @endphp
                <div class="space-y-2" id="faq-container">
                    @foreach ($faqs as $i => $faq)
                        <div class="border border-gray-100 rounded-xl overflow-hidden">
                            <button type="button" onclick="toggleFaq({{ $i }})"
                                class="w-full flex items-center justify-between px-4 py-3.5 text-left hover:bg-gray-50 transition">
                                <span class="font-semibold text-gray-800 text-sm pr-4">{{ $faq['q'] }}</span>
                                <i class="fas fa-chevron-down text-gray-400 text-xs flex-shrink-0 faq-icon transition-transform"
                                    id="faq-icon-{{ $i }}"></i>
                            </button>
                            <div class="faq-body hidden px-4 pb-4 text-sm text-gray-600 leading-relaxed"
                                id="faq-body-{{ $i }}">
                                {{ $faq['a'] }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function toggleFaq(i) {
                const body = document.getElementById('faq-body-' + i);
                const icon = document.getElementById('faq-icon-' + i);
                const isOpen = !body.classList.contains('hidden');
                // Close all
                document.querySelectorAll('.faq-body').forEach(el => el.classList.add('hidden'));
                document.querySelectorAll('.faq-icon').forEach(el => el.style.transform = '');
                // Open clicked if it was closed
                if (!isOpen) {
                    body.classList.remove('hidden');
                    icon.style.transform = 'rotate(180deg)';
                }
            }
        </script>
    @endpush
@endsection
