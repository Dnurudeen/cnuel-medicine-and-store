@extends('layouts.admin')

@section('title', 'Products')
@section('header', 'Products')

@section('content')
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <p class="text-gray-600">Manage your products</p>
        </div>
        <a href="{{ route('admin.products.create') }}"
            class="bg-primary-500 text-white px-4 py-2 rounded-lg hover:bg-primary-600 transition">
            <i class="fas fa-plus mr-2"></i> Add Product
        </a>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-lg shadow p-4 mb-6">
        <form action="{{ route('admin.products.index') }}" method="GET" class="flex flex-wrap gap-4">
            <div class="flex-1 min-w-[200px]">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search products..."
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500">
            </div>
            <div class="w-48">
                <select name="category"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500">
                    <option value="">All Categories</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="w-40">
                <select name="status"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500">
                    <option value="">All Status</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            <button type="submit" class="bg-gray-800 text-white px-6 py-2 rounded-lg hover:bg-gray-900 transition">
                Filter
            </button>
        </form>
    </div>

    <!-- Products Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        @if ($products->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Product</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Category</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Stock</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($products as $product)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="h-12 w-12 bg-gray-100 rounded-lg overflow-hidden mr-4">
                                            @if ($product->image)
                                                <img src="{{ asset('storage/' . $product->image) }}"
                                                    alt="{{ $product->name }}" class="h-full w-full object-cover">
                                            @else
                                                <div class="h-full w-full flex items-center justify-center text-gray-400">
                                                    <i class="fas fa-image"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-800">{{ $product->name }}</p>
                                            @if ($product->sku)
                                                <p class="text-sm text-gray-500">SKU: {{ $product->sku }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-600">
                                    {{ $product->category?->name ?? 'Uncategorized' }}
                                </td>
                                <td class="px-6 py-4">
                                    @if ($product->sale_price)
                                        <span
                                            class="font-medium text-primary-600">₦{{ number_format($product->sale_price, 2) }}</span>
                                        <span
                                            class="text-sm text-gray-400 line-through ml-1">₦{{ number_format($product->price, 2) }}</span>
                                    @else
                                        <span class="font-medium">₦{{ number_format($product->price, 2) }}</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <span class="{{ $product->stock_quantity > 0 ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $product->stock_quantity }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @if ($product->is_active)
                                        <span
                                            class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">Active</span>
                                    @else
                                        <span class="px-2 py-1 bg-red-100 text-red-800 text-xs rounded-full">Inactive</span>
                                    @endif
                                    @if ($product->is_featured)
                                        <span
                                            class="ml-1 px-2 py-1 bg-yellow-100 text-yellow-800 text-xs rounded-full">Featured</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-3">
                                        <a href="{{ route('admin.products.edit', $product) }}"
                                            class="text-blue-600 hover:text-blue-800">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                                            class="inline"
                                            onsubmit="return confirm('Are you sure you want to delete this product?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="px-6 py-4 border-t">
                {{ $products->links() }}
            </div>
        @else
            <div class="p-12 text-center">
                <i class="fas fa-box-open text-4xl text-gray-300 mb-4"></i>
                <p class="text-gray-500">No products found</p>
                <a href="{{ route('admin.products.create') }}"
                    class="inline-block mt-4 text-primary-600 hover:text-primary-800">
                    Add your first product
                </a>
            </div>
        @endif
    </div>
@endsection
