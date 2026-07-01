<?php

namespace App\Http\Controllers;

use App\Models\OutgoingStock;
use App\Models\Product;
use Illuminate\Http\Request;

class OutgoingStockController extends Controller
{
    public function index(Request $request)
    {
        $query = OutgoingStock::with(['product']);

        if ($search = $request->get('search')) {
            $query->whereHas('product', fn ($q) => $q->where('name', 'like', "%{$search}%"));
        }

        if ($productId = $request->get('product_id')) {
            $query->where('product_id', $productId);
        }

        $outgoingStocks = $query->latest()->paginate(10);

        return view('outgoing-stock.index', compact('outgoingStocks'));
    }

    public function create()
    {
        $products = Product::where('current_stock', '>', 0)->orderBy('name')->get();

        return view('outgoing-stock.create', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'date' => 'required|date',
            'destination' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $product = Product::findOrFail($validated['product_id']);

        if ($product->current_stock < $validated['quantity']) {
            return back()->withErrors(['quantity' => 'Insufficient stock. Available: '.$product->current_stock])
                ->withInput();
        }

        $outgoing = OutgoingStock::create($validated);

        $product->decrement('current_stock', $validated['quantity']);

        return redirect()->route('outgoing-stock.index')
            ->with('success', 'Outgoing stock recorded successfully.');
    }

    public function destroy(OutgoingStock $outgoingStock)
    {
        $outgoingStock->product()->increment('current_stock', $outgoingStock->quantity);
        $outgoingStock->delete();

        return redirect()->route('outgoing-stock.index')
            ->with('success', 'Outgoing stock deleted successfully.');
    }
}
