@extends('layouts.admin')

@section('title', 'Settings')
@section('header', 'Site Settings')

@section('content')
    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="max-w-3xl space-y-6">
            <!-- General Settings -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">General Settings</h2>

                <div class="space-y-4">
                    <div>
                        <label for="site_name" class="block text-sm font-medium text-gray-700 mb-1">Site Name</label>
                        <input type="text" name="site_name" id="site_name"
                            value="{{ $settings['general']->firstWhere('key', 'site_name')?->value ?? 'C-Nuel Medicine and Store' }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500">
                    </div>

                    <div>
                        <label for="site_tagline" class="block text-sm font-medium text-gray-700 mb-1">Tagline</label>
                        <input type="text" name="site_tagline" id="site_tagline"
                            value="{{ $settings['general']->firstWhere('key', 'site_tagline')?->value ?? 'Your trusted source for quality medicines' }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500">
                    </div>

                    <div>
                        <label for="site_logo" class="block text-sm font-medium text-gray-700 mb-1">Site Logo</label>
                        @php $logo = $settings['general']->firstWhere('key', 'site_logo')?->value; @endphp
                        @if ($logo)
                            <img src="{{ asset('storage/' . $logo) }}" alt="Logo" class="h-16 mb-2">
                        @endif
                        <input type="file" name="site_logo" id="site_logo" accept="image/*"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500">
                    </div>
                </div>
            </div>

            <!-- Contact Settings -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Contact Information</h2>

                <div class="space-y-4">
                    <div>
                        <label for="whatsapp_number" class="block text-sm font-medium text-gray-700 mb-1">WhatsApp
                            Number</label>
                        <input type="text" name="whatsapp_number" id="whatsapp_number"
                            value="{{ $settings['general']->firstWhere('key', 'whatsapp_number')?->value ?? '+2348034966505' }}"
                            placeholder="+234..."
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500">
                        <p class="text-sm text-gray-500 mt-1">Include country code (e.g., +2348034966505)</p>
                    </div>

                    <div>
                        <label for="contact_email" class="block text-sm font-medium text-gray-700 mb-1">Contact
                            Email</label>
                        <input type="email" name="contact_email" id="contact_email"
                            value="{{ $settings['general']->firstWhere('key', 'contact_email')?->value ?? 'admin@cnuelmedicine.com' }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500">
                    </div>

                    <div>
                        <label for="contact_address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                        <textarea name="contact_address" id="contact_address" rows="2"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500">{{ $settings['general']->firstWhere('key', 'contact_address')?->value ?? 'Nigeria' }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Social Media -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Social Media Links</h2>

                <div class="space-y-4">
                    <div>
                        <label for="facebook_url" class="block text-sm font-medium text-gray-700 mb-1">Facebook URL</label>
                        <input type="url" name="facebook_url" id="facebook_url"
                            value="{{ $settings['general']->firstWhere('key', 'facebook_url')?->value }}"
                            placeholder="https://facebook.com/..."
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500">
                    </div>

                    <div>
                        <label for="instagram_url" class="block text-sm font-medium text-gray-700 mb-1">Instagram
                            URL</label>
                        <input type="url" name="instagram_url" id="instagram_url"
                            value="{{ $settings['general']->firstWhere('key', 'instagram_url')?->value }}"
                            placeholder="https://instagram.com/..."
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500">
                    </div>

                    <div>
                        <label for="twitter_url" class="block text-sm font-medium text-gray-700 mb-1">Twitter/X URL</label>
                        <input type="url" name="twitter_url" id="twitter_url"
                            value="{{ $settings['general']->firstWhere('key', 'twitter_url')?->value }}"
                            placeholder="https://twitter.com/..."
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500">
                    </div>
                </div>
            </div>

            <button type="submit"
                class="w-full bg-primary-500 text-white py-3 rounded-lg font-semibold hover:bg-primary-600 transition">
                <i class="fas fa-save mr-2"></i> Save Settings
            </button>
        </div>
    </form>
@endsection
