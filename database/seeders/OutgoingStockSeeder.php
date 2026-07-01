<?php

namespace Database\Seeders;

use App\Models\OutgoingStock;
use App\Models\Product;
use Illuminate\Database\Seeder;

class OutgoingStockSeeder extends Seeder
{
    public function run(): void
    {
        $productIds = Product::pluck('id')->toArray();

        $records = [
            ['product_id' => $productIds[0], 'quantity' => 5, 'date' => now()->subDays(20), 'destination' => 'Warehouse A', 'notes' => 'Department request'],
            ['product_id' => $productIds[1], 'quantity' => 10, 'date' => now()->subDays(18), 'destination' => 'Warehouse B', 'notes' => null],
            ['product_id' => $productIds[3], 'quantity' => 20, 'date' => now()->subDays(15), 'destination' => 'Warehouse A', 'notes' => 'Bulk transfer'],
            ['product_id' => $productIds[4], 'quantity' => 15, 'date' => now()->subDays(12), 'destination' => 'Office C', 'notes' => 'Office supplies'],
            ['product_id' => $productIds[7], 'quantity' => 3, 'date' => now()->subDays(8), 'destination' => 'Warehouse B', 'notes' => null],
            ['product_id' => $productIds[10], 'quantity' => 100, 'date' => now()->subDays(6), 'destination' => 'Warehouse A', 'notes' => 'Monthly allocation'],
            ['product_id' => $productIds[13], 'quantity' => 8, 'date' => now()->subDays(4), 'destination' => 'Workshop', 'notes' => 'Tool request'],
            ['product_id' => $productIds[16], 'quantity' => 15, 'date' => now()->subDays(2), 'destination' => 'Office D', 'notes' => null],
        ];

        foreach ($records as $record) {
            $outgoing = OutgoingStock::create($record);
            $outgoing->product()->decrement('current_stock', $record['quantity']);
        }
    }
}
