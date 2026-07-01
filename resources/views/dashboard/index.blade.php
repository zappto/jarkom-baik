@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">
            <div class="flex items-center justify-between mb-2">
                <span class="text-sm font-medium text-gray-500">Total Products</span>
                <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-gray-900">{{ number_format($totalProducts) }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">
            <div class="flex items-center justify-between mb-2">
                <span class="text-sm font-medium text-gray-500">Categories</span>
                <div class="w-10 h-10 rounded-lg bg-purple-50 flex items-center justify-center">
                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-gray-900">{{ number_format($totalCategories) }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">
            <div class="flex items-center justify-between mb-2">
                <span class="text-sm font-medium text-gray-500">Suppliers</span>
                <div class="w-10 h-10 rounded-lg bg-orange-50 flex items-center justify-center">
                    <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-gray-900">{{ number_format($totalSuppliers) }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">
            <div class="flex items-center justify-between mb-2">
                <span class="text-sm font-medium text-gray-500">Current Stock</span>
                <div class="w-10 h-10 rounded-lg bg-cyan-50 flex items-center justify-center">
                    <svg class="w-5 h-5 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-gray-900">{{ number_format($totalStock) }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">
            <div class="flex items-center justify-between mb-2">
                <span class="text-sm font-medium text-gray-500">Incoming Items</span>
                <div class="w-10 h-10 rounded-lg bg-green-50 flex items-center justify-center">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-gray-900">{{ number_format($totalIncoming) }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">
            <div class="flex items-center justify-between mb-2">
                <span class="text-sm font-medium text-gray-500">Outgoing Items</span>
                <div class="w-10 h-10 rounded-lg bg-red-50 flex items-center justify-center">
                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 8l-4-4m0 0l-4 4m4-4v12"/></svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-gray-900">{{ number_format($totalOutgoing) }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">
            <div class="flex items-center justify-between mb-2">
                <span class="text-sm font-medium text-gray-500">Low Stock Items</span>
                <div class="w-10 h-10 rounded-lg bg-red-50 flex items-center justify-center">
                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
                </div>
            </div>
            <p class="text-3xl font-bold {{ $lowStockCount > 0 ? 'text-red-600' : 'text-gray-900' }}">{{ number_format($lowStockCount) }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="px-5 py-4 border-b border-gray-100">
                <h3 class="text-base font-semibold text-gray-900">Recent Transactions</h3>
            </div>
            <div class="p-5">
                @if ($recentTransactions->isEmpty())
                    <p class="text-sm text-gray-500 text-center py-8">No transactions yet.</p>
                @else
                    <div class="space-y-3">
                        @foreach ($recentTransactions as $tx)
                            <div class="flex items-center justify-between py-2">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full {{ $tx['type'] === 'incoming' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }} flex items-center justify-center">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            @if ($tx['type'] === 'incoming')
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                            @else
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 8l-4-4m0 0l-4 4m4-4v12"/>
                                            @endif
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">{{ $tx['product'] }}</p>
                                        <p class="text-xs text-gray-500">{{ $tx['type'] === 'incoming' ? 'Received' : 'Issued' }} {{ $tx['quantity'] }} items</p>
                                    </div>
                                </div>
                                <span class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($tx['date'])->format('d M Y') }}</span>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="px-5 py-4 border-b border-gray-100">
                <h3 class="text-base font-semibold text-gray-900 {{ $lowStockCount > 0 ? 'text-red-600' : '' }}">Low Stock Products</h3>
            </div>
            <div class="p-5">
                @if ($lowStockProducts->isEmpty())
                    <p class="text-sm text-gray-500 text-center py-8">All products are well stocked.</p>
                @else
                    <div class="space-y-3">
                        @foreach ($lowStockProducts as $product)
                            <div class="flex items-center justify-between py-2">
                                <div>
                                    <p class="text-sm font-medium text-gray-900">{{ $product->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $product->category->name }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-medium {{ $product->current_stock == 0 ? 'text-red-600' : 'text-orange-500' }}">{{ $product->current_stock }}</p>
                                    <p class="text-xs text-gray-500">min: {{ $product->minimum_stock }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
