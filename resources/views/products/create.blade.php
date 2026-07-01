@extends('layouts.app')

@section('title', 'Create Product')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        {{-- Header --}}
        <div class="px-6 py-5 border-b border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-bold text-gray-900">Create Product</h2>
                    <p class="mt-1 text-sm text-gray-500">Add a new product to your inventory</p>
                </div>
                <a href="{{ route('products.index') }}" class="inline-flex items-center gap-1.5 text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors duration-150">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Back
                </a>
            </div>
        </div>

        {{-- Form --}}
        <form method="POST" action="{{ route('products.store') }}" class="px-6 py-6 space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- SKU --}}
                <div>
                    <label for="sku" class="block text-sm font-medium text-gray-700 mb-1">SKU <span class="text-red-500">*</span></label>
                    <input type="text" id="sku" name="sku" value="{{ old('sku') }}" required
                           class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none @error('sku') border-red-400 @enderror"
                           placeholder="e.g. PRD-001">
                    @error('sku')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Name --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name <span class="text-red-500">*</span></label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required
                           class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none @error('name') border-red-400 @enderror"
                           placeholder="Product name">
                    @error('name')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Category --}}
                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Category <span class="text-red-500">*</span></label>
                    <select id="category_id" name="category_id" required
                            class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none @error('category_id') border-red-400 @enderror">
                        <option value="">Select a category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Supplier --}}
                <div>
                    <label for="supplier_id" class="block text-sm font-medium text-gray-700 mb-1">Supplier</label>
                    <select id="supplier_id" name="supplier_id"
                            class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none @error('supplier_id') border-red-400 @enderror">
                        <option value="">Select a supplier (optional)</option>
                        @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                {{ $supplier->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('supplier_id')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Purchase Price --}}
                <div>
                    <label for="purchase_price" class="block text-sm font-medium text-gray-700 mb-1">Purchase Price</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400 text-sm">$</span>
                        <input type="number" id="purchase_price" name="purchase_price" value="{{ old('purchase_price') }}" min="0" step="0.01"
                               class="w-full rounded-lg border border-gray-300 pl-7 pr-3 py-2.5 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none @error('purchase_price') border-red-400 @enderror"
                               placeholder="0.00">
                    </div>
                    @error('purchase_price')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Selling Price --}}
                <div>
                    <label for="selling_price" class="block text-sm font-medium text-gray-700 mb-1">Selling Price</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400 text-sm">$</span>
                        <input type="number" id="selling_price" name="selling_price" value="{{ old('selling_price') }}" min="0" step="0.01"
                               class="w-full rounded-lg border border-gray-300 pl-7 pr-3 py-2.5 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none @error('selling_price') border-red-400 @enderror"
                               placeholder="0.00">
                    </div>
                    @error('selling_price')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Current Stock --}}
                <div>
                    <label for="current_stock" class="block text-sm font-medium text-gray-700 mb-1">Current Stock <span class="text-red-500">*</span></label>
                    <input type="number" id="current_stock" name="current_stock" value="{{ old('current_stock', 0) }}" min="0" required
                           class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none @error('current_stock') border-red-400 @enderror"
                           placeholder="0">
                    @error('current_stock')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Minimum Stock --}}
                <div>
                    <label for="minimum_stock" class="block text-sm font-medium text-gray-700 mb-1">Minimum Stock <span class="text-red-500">*</span></label>
                    <input type="number" id="minimum_stock" name="minimum_stock" value="{{ old('minimum_stock', 0) }}" min="0" required
                           class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none @error('minimum_stock') border-red-400 @enderror"
                           placeholder="0">
                    @error('minimum_stock')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Description --}}
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea id="description" name="description" rows="4"
                          class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none @error('description') border-red-400 @enderror"
                          placeholder="Product description (optional)">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Actions --}}
            <div class="flex items-center justify-end gap-3 pt-2 border-t border-gray-100">
                <a href="{{ route('products.index') }}" class="rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition-colors duration-150">
                    Cancel
                </a>
                <button type="submit" class="rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-700 transition-colors duration-150">
                    Create Product
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
