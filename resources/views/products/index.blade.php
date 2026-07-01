@extends('layouts.app')

@section('title', 'Products')

@section('content')
<div class="space-y-6">
    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Products</h2>
            <p class="mt-1 text-sm text-gray-500">Manage your product inventory</p>
        </div>
        <a href="{{ route('products.create') }}" class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-700 transition-colors duration-150">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Add Product
        </a>
    </div>

    {{-- Filters --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">
        <form method="GET" action="{{ route('products.index') }}">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-4">
                {{-- Search --}}
                <div class="lg:col-span-2">
                    <label for="search" class="block text-xs font-medium text-gray-500 mb-1">Search</label>
                    <input type="text" id="search" name="search" placeholder="Search by SKU or name..." value="{{ request('search') }}"
                           class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none">
                </div>

                {{-- Category --}}
                <div>
                    <label for="category_id" class="block text-xs font-medium text-gray-500 mb-1">Category</label>
                    <select id="category_id" name="category_id"
                            class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none">
                        <option value="">All Categories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Supplier --}}
                <div>
                    <label for="supplier_id" class="block text-xs font-medium text-gray-500 mb-1">Supplier</label>
                    <select id="supplier_id" name="supplier_id"
                            class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none">
                        <option value="">All Suppliers</option>
                        @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->id }}" {{ request('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                {{ $supplier->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Stock Status --}}
                <div>
                    <label for="stock_status" class="block text-xs font-medium text-gray-500 mb-1">Stock Status</label>
                    <select id="stock_status" name="stock_status"
                            class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none">
                        <option value="">All Stock</option>
                        <option value="available" {{ request('stock_status') == 'available' ? 'selected' : '' }}>Available</option>
                        <option value="low" {{ request('stock_status') == 'low' ? 'selected' : '' }}>Low Stock</option>
                        <option value="out" {{ request('stock_status') == 'out' ? 'selected' : '' }}>Out of Stock</option>
                    </select>
                </div>

                {{-- Sort / Per Page (secondary row) --}}
                <div>
                    <label for="sort" class="block text-xs font-medium text-gray-500 mb-1">Sort By</label>
                    <select id="sort" name="sort"
                            class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none">
                        <option value="name" {{ request('sort', 'name') == 'name' ? 'selected' : '' }}>Name</option>
                        <option value="stock" {{ request('sort') == 'stock' ? 'selected' : '' }}>Stock</option>
                        <option value="price" {{ request('sort') == 'price' ? 'selected' : '' }}>Price</option>
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                    </select>
                </div>

                <div>
                    <label for="per_page" class="block text-xs font-medium text-gray-500 mb-1">Per Page</label>
                    <select id="per_page" name="per_page"
                            class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none">
                        <option value="10" {{ request('per_page', '10') == '10' ? 'selected' : '' }}>10</option>
                        <option value="25" {{ request('per_page') == '25' ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('per_page') == '50' ? 'selected' : '' }}>50</option>
                        <option value="100" {{ request('per_page') == '100' ? 'selected' : '' }}>100</option>
                    </select>
                </div>
            </div>

            <div class="mt-4 flex items-center justify-end gap-3">
                <a href="{{ route('products.index') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors duration-150">Reset</a>
                <button type="submit" class="inline-flex items-center gap-2 rounded-lg bg-gray-900 px-4 py-2.5 text-sm font-semibold text-white hover:bg-gray-800 transition-colors duration-150">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    Filter
                </button>
            </div>
        </form>
    </div>

    {{-- Products Table --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">SKU</th>
                        <th scope="col" class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Name</th>
                        <th scope="col" class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Category</th>
                        <th scope="col" class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Supplier</th>
                        <th scope="col" class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Stock</th>
                        <th scope="col" class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Price</th>
                        <th scope="col" class="px-6 py-3.5 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($products as $product)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-900">{{ $product->sku }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $product->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $product->category?->name ?? '—' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $product->supplier?->name ?? '—' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $badgeColors = match (true) {
                                        $product->current_stock <= 0 => ['bg-red-50 text-red-700 ring-red-600/20', 'Out of Stock'],
                                        $product->current_stock <= $product->minimum_stock => ['bg-orange-50 text-orange-700 ring-orange-600/20', 'Low Stock'],
                                        default => ['bg-green-50 text-green-700 ring-green-600/20', 'Available'],
                                    };
                                @endphp
                                <span class="inline-flex items-center gap-1.5 rounded-full px-2.5 py-1 text-xs font-medium ring-1 ring-inset {{ $badgeColors[0] }}">
                                    <span>{{ $product->current_stock }}</span>
                                    <span class="w-1 h-1 rounded-full bg-current opacity-40"></span>
                                    <span>{{ $badgeColors[1] }}</span>
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${{ number_format($product->selling_price, 2) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end gap-1">
                                    <a href="{{ route('products.show', $product) }}" class="inline-flex items-center rounded-lg px-2.5 py-1.5 text-gray-600 hover:text-blue-600 hover:bg-blue-50 transition-colors duration-150" title="View">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    </a>
                                    <a href="{{ route('products.edit', $product) }}" class="inline-flex items-center rounded-lg px-2.5 py-1.5 text-gray-600 hover:text-amber-600 hover:bg-amber-50 transition-colors duration-150" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <form method="POST" action="{{ route('products.destroy', $product) }}" onsubmit="return confirm('Are you sure you want to delete {{ $product->name }}?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center rounded-lg px-2.5 py-1.5 text-gray-600 hover:text-red-600 hover:bg-red-50 transition-colors duration-150" title="Delete">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <svg class="mx-auto w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                                <p class="mt-3 text-sm font-medium text-gray-900">No products found</p>
                                <p class="mt-1 text-sm text-gray-500">Try adjusting your search or filter criteria.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    <div>
        {{ $products->links() }}
    </div>
</div>
@endsection
