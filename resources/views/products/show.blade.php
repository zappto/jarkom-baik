@extends('layouts.app')

@section('title', 'Product Details: ' . $product->name)

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Product Details</h2>
            <p class="mt-1 text-sm text-gray-500">{{ $product->name }}</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('products.edit', $product) }}" class="inline-flex items-center gap-2 rounded-lg bg-amber-500 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-amber-600 transition-colors duration-150">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                Edit Product
            </a>
            <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition-colors duration-150">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Back to Products
            </a>
        </div>
    </div>

    {{-- Low Stock Warning --}}
    @if ($product->current_stock <= $product->minimum_stock)
        <div class="rounded-xl border {{ $product->current_stock <= 0 ? 'border-red-200 bg-red-50' : 'border-orange-200 bg-orange-50' }} px-5 py-4">
            <div class="flex items-start gap-3">
                <svg class="w-5 h-5 mt-0.5 {{ $product->current_stock <= 0 ? 'text-red-500' : 'text-orange-500' }} flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4.5c-.77-.833-2.694-.833-3.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                </svg>
                <div>
                    <p class="text-sm font-semibold {{ $product->current_stock <= 0 ? 'text-red-800' : 'text-orange-800' }}">
                        @if ($product->current_stock <= 0)
                            This product is out of stock.
                        @else
                            Low stock alert — only {{ $product->current_stock }} units remaining.
                        @endif
                    </p>
                    <p class="mt-0.5 text-sm {{ $product->current_stock <= 0 ? 'text-red-600' : 'text-orange-600' }}">
                        Minimum stock threshold: {{ $product->minimum_stock }} units.
                    </p>
                </div>
            </div>
        </div>
    @endif

    {{-- Product Details Card --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100">
            <h3 class="text-base font-semibold text-gray-900">General Information</h3>
        </div>
        <div class="px-6 py-5">
            <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-5">
                <div>
                    <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">SKU</dt>
                    <dd class="mt-1 text-sm font-mono font-medium text-gray-900">{{ $product->sku }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Name</dt>
                    <dd class="mt-1 text-sm font-medium text-gray-900">{{ $product->name }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Category</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $product->category?->name ?? '—' }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Supplier</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $product->supplier?->name ?? '—' }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Purchase Price</dt>
                    <dd class="mt-1 text-sm font-medium text-gray-900">${{ number_format($product->purchase_price, 2) }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Selling Price</dt>
                    <dd class="mt-1 text-sm font-medium text-gray-900">${{ number_format($product->selling_price, 2) }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Current Stock</dt>
                    <dd class="mt-1">
                        @php
                            $stockBadge = match (true) {
                                $product->current_stock <= 0 => 'bg-red-50 text-red-700 ring-red-600/20',
                                $product->current_stock <= $product->minimum_stock => 'bg-orange-50 text-orange-700 ring-orange-600/20',
                                default => 'bg-green-50 text-green-700 ring-green-600/20',
                            };
                        @endphp
                        <span class="inline-flex items-center gap-1.5 rounded-full px-2.5 py-1 text-xs font-medium ring-1 ring-inset {{ $stockBadge }}">
                            {{ $product->current_stock }} units
                        </span>
                    </dd>
                </div>
                <div>
                    <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Minimum Stock</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $product->minimum_stock }} units</dd>
                </div>
                <div class="md:col-span-2">
                    <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Description</dt>
                    <dd class="mt-1 text-sm text-gray-900">{!! nl2br(e($product->description ?? 'No description provided.')) !!}</dd>
                </div>
            </dl>
        </div>
    </div>

    {{-- Recent Stock Transactions --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100">
            <h3 class="text-base font-semibold text-gray-900">Recent Stock Transactions</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Date</th>
                        <th scope="col" class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Type</th>
                        <th scope="col" class="px-6 py-3.5 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Quantity</th>
                        <th scope="col" class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Notes</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($product->transactions()->latest()->limit(10)->get() as $transaction)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $transaction->created_at->format('M d, Y H:i') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($transaction->type === 'incoming')
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-green-50 px-2.5 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                                        Incoming
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-red-50 px-2.5 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/20">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 8l-4-4m0 0l-4 4m4-4v12"/></svg>
                                        Outgoing
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium {{ $transaction->type === 'incoming' ? 'text-green-600' : 'text-red-600' }}">
                                {{ $transaction->type === 'incoming' ? '+' : '-' }}{{ $transaction->quantity }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600 max-w-[200px] truncate">{{ $transaction->notes ?? '—' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center">
                                <svg class="mx-auto w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                                <p class="mt-3 text-sm font-medium text-gray-900">No transactions yet</p>
                                <p class="mt-1 text-sm text-gray-500">Stock movements will appear here once recorded.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
