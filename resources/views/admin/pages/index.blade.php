@extends('layouts.admin')

@section('title', 'Pages')
@section('header', 'Manage Pages')

@section('content')
    <p class="text-gray-600 mb-6">Edit your website pages content like Elementor</p>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($pages as $page)
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-start justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">{{ $page->title }}</h3>
                        <p class="text-sm text-gray-500">/{{ $page->slug }}</p>
                    </div>
                    @if ($page->is_active)
                        <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">Active</span>
                    @else
                        <span class="px-2 py-1 bg-red-100 text-red-800 text-xs rounded-full">Inactive</span>
                    @endif
                </div>

                <p class="text-gray-600 text-sm mt-3">{{ $page->sections_count }} sections</p>

                <div class="mt-4 flex space-x-3">
                    <a href="{{ route('admin.pages.edit', $page) }}"
                        class="flex-1 bg-primary-500 text-white text-center py-2 rounded-lg hover:bg-primary-600 transition">
                        <i class="fas fa-edit mr-1"></i> Edit
                    </a>
                    <a href="/{{ $page->slug == 'home' ? '' : $page->slug }}" target="_blank"
                        class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                        <i class="fas fa-external-link-alt"></i>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
