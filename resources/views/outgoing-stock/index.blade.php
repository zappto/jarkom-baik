@extends('layouts.app')

@section('title', 'Outgoing Stock')

@section('content')
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
            <div class="flex items-center gap-3 flex-1">
                <form method="GET" action="{{ route('outgoing-stock.index') }}" class="flex items-center gap-3">
                    <input type="text" name="search" placeholder="Search by product..." value="{{ request('search') }}"
                        class="w-60 rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none">
                    <button type="submit" class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">Search</button>
                </form>
            </div>
            <a href="{{ route('outgoing-stock.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors duration-150">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Record Outgoing
            </a>
        </div>
        <div class="p-5">
            @if ($outgoingStocks->isEmpty())
                <p class="text-sm text-gray-500 text-center py-8">No outgoing stock records found.</p>
            @else
                <table class="w-full">
                    <thead>
                        <tr class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <th class="pb-3 pr-4">Date</th>
                            <th class="pb-3 pr-4">Product</th>
                            <th class="pb-3 pr-4">Quantity</th>
                            <th class="pb-3 pr-4">Destination</th>
                            <th class="pb-3 pr-4">Notes</th>
                            <th class="pb-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($outgoingStocks as $stock)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="py-3 pr-4">
                                    <span class="text-sm text-gray-600">{{ $stock->date->format('d M Y') }}</span>
                                </td>
                                <td class="py-3 pr-4">
                                    <a href="{{ route('products.show', $stock->product) }}" class="text-sm font-medium text-blue-600 hover:text-blue-700">{{ $stock->product->name }}</a>
                                </td>
                                <td class="py-3 pr-4">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-700">-{{ $stock->quantity }}</span>
                                </td>
                                <td class="py-3 pr-4">
                                    <span class="text-sm text-gray-600">{{ $stock->destination ?: '-' }}</span>
                                </td>
                                <td class="py-3 pr-4">
                                    <span class="text-sm text-gray-500">{{ $stock->notes ?: '-' }}</span>
                                </td>
                                <td class="py-3 text-right">
                                    <form action="{{ route('outgoing-stock.destroy', $stock) }}" method="POST" onsubmit="return confirm('Delete this record? This will increase product stock back.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-sm font-medium text-red-600 bg-white border border-red-300 rounded-lg hover:bg-red-50 transition-colors duration-150">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4">
                    {{ $outgoingStocks->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
