<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\IncomingStock;
use App\Models\OutgoingStock;
use App\Models\Product;
use App\Models\Supplier;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalSuppliers = Supplier::count();
        $totalIncoming = IncomingStock::sum('quantity');
        $totalOutgoing = OutgoingStock::sum('quantity');
        $totalStock = Product::sum('current_stock');
        $lowStockCount = Product::whereColumn('current_stock', '<=', 'minimum_stock')->count();

        $recentIncoming = IncomingStock::with('product')
            ->latest()
            ->take(5)
            ->get()
            ->map(fn ($item) => [
                'type' => 'incoming',
                'product' => $item->product->name,
                'quantity' => $item->quantity,
                'date' => $item->date,
            ]);

        $recentOutgoing = OutgoingStock::with('product')
            ->latest()
            ->take(5)
            ->get()
            ->map(fn ($item) => [
                'type' => 'outgoing',
                'product' => $item->product->name,
                'quantity' => $item->quantity,
                'date' => $item->date,
            ]);

        $recentTransactions = $recentIncoming->concat($recentOutgoing)
            ->sortByDesc('date')
            ->take(10);

        $lowStockProducts = Product::with('category')
            ->whereColumn('current_stock', '<=', 'minimum_stock')
            ->orderBy('current_stock')
            ->take(5)
            ->get();

        return view('dashboard.index', compact(
            'totalProducts',
            'totalCategories',
            'totalSuppliers',
            'totalIncoming',
            'totalOutgoing',
            'totalStock',
            'lowStockCount',
            'recentTransactions',
            'lowStockProducts',
        ));
    }
}
