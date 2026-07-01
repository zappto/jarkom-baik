<?php

namespace Database\Seeders;

use App\Models\IncomingStock;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Database\Seeder;

class IncomingStockSeeder extends Seeder
{
    public function run(): void
    {
        $productIds = Product::pluck('id')->toArray();
        $supplierIds = Supplier::pluck('id')->toArray();

        $records = [
            ['product_id' => $productIds[0], 'quantity' => 50, 'date' => now()->subDays(30), 'supplier_id' => $supplierIds[0], 'notes' => 'Initial stock'],
            ['product_id' => $productIds[1], 'quantity' => 80, 'date' => now()->subDays(28), 'supplier_id' => $supplierIds[0], 'notes' => 'Monthly replenishment'],
            ['product_id' => $productIds[4], 'quantity' => 40, 'date' => now()->subDays(25), 'supplier_id' => $supplierIds[1], 'notes' => 'Bulk order'],
            ['product_id' => $productIds[7], 'quantity' => 15, 'date' => now()->subDays(20), 'supplier_id' => $supplierIds[3], 'notes' => 'New stock arrival'],
            ['product_id' => $productIds[10], 'quantity' => 500, 'date' => now()->subDays(18), 'supplier_id' => $supplierIds[4], 'notes' => 'Warehouse restock'],
            ['product_id' => $productIds[2], 'quantity' => 30, 'date' => now()->subDays(15), 'supplier_id' => $supplierIds[0], 'notes' => null],
            ['product_id' => $productIds[5], 'quantity' => 100, 'date' => now()->subDays(12), 'supplier_id' => $supplierIds[2], 'notes' => 'Monthly order'],
            ['product_id' => $productIds[12], 'quantity' => 150, 'date' => now()->subDays(10), 'supplier_id' => $supplierIds[4], 'notes' => null],
            ['product_id' => $productIds[16], 'quantity' => 60, 'date' => now()->subDays(7), 'supplier_id' => $supplierIds[2], 'notes' => 'Weekly replenishment'],
            ['product_id' => $productIds[19], 'quantity' => 20, 'date' => now()->subDays(3), 'supplier_id' => $supplierIds[2], 'notes' => 'Urgent order'],
        ];

        foreach ($records as $record) {
            $incoming = IncomingStock::create($record);
            $incoming->product()->increment('current_stock', $record['quantity']);
        }
    }
}
