<?php

namespace App\Http\Controllers;

use App\Models\IncomingStock;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;

class IncomingStockController extends Controller
{
    public function index(Request $request)
    {
        $query = IncomingStock::with(['product', 'supplier']);

        if ($search = $request->get('search')) {
            $query->whereHas('product', fn ($q) => $q->where('name', 'like', "%{$search}%"));
        }

        if ($productId = $request->get('product_id')) {
            $query->where('product_id', $productId);
        }

        $incomingStocks = $query->latest()->paginate(10);

        return view('incoming-stock.index', compact('incomingStocks'));
    }

    public function create()
    {
        $products = Product::orderBy('name')->get();
        $suppliers = Supplier::orderBy('name')->get();

        return view('incoming-stock.create', compact('products', 'suppliers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'date' => 'required|date',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'notes' => 'nullable|string',
        ]);

        $incoming = IncomingStock::create($validated);

        $incoming->product()->increment('current_stock', $validated['quantity']);

        return redirect()->route('incoming-stock.index')
            ->with('success', 'Incoming stock recorded successfully.');
    }

    public function destroy(IncomingStock $incomingStock)
    {
        $incomingStock->product()->decrement('current_stock', $incomingStock->quantity);
        $incomingStock->delete();

        return redirect()->route('incoming-stock.index')
            ->with('success', 'Incoming stock deleted successfully.');
    }
}
