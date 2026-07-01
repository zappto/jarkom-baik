@extends('layouts.app')

@section('title', 'Categories')

@section('content')
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
            <div class="flex items-center gap-3 flex-1">
                <form method="GET" action="{{ route('categories.index') }}" class="flex-1 max-w-xs">
                    <input type="text" name="search" placeholder="Search categories..." value="{{ request('search') }}"
                        class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none">
                </form>
            </div>
            <a href="{{ route('categories.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors duration-150">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Add Category
            </a>
        </div>
        <div class="p-5">
            @if ($categories->isEmpty())
                <p class="text-sm text-gray-500 text-center py-8">No categories found.</p>
            @else
                <table class="w-full">
                    <thead>
                        <tr class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <th class="pb-3 pr-4">Name</th>
                            <th class="pb-3 pr-4">Products</th>
                            <th class="pb-3 pr-4">Description</th>
                            <th class="pb-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($categories as $category)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="py-3 pr-4">
                                    <span class="text-sm font-medium text-gray-900">{{ $category->name }}</span>
                                </td>
                                <td class="py-3 pr-4">
                                    <span class="text-sm text-gray-600">{{ $category->products_count }}</span>
                                </td>
                                <td class="py-3 pr-4">
                                    <span class="text-sm text-gray-500">{{ $category->description ?: '-' }}</span>
                                </td>
                                <td class="py-3 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('categories.edit', $category) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-150">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                            Edit
                                        </a>
                                        <form action="{{ route('categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Delete this category?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-sm font-medium text-red-600 bg-white border border-red-300 rounded-lg hover:bg-red-50 transition-colors duration-150">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4">
                    {{ $categories->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
