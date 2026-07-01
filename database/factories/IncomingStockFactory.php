<?php

namespace Database\Factories;

use App\Models\IncomingStock;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

class IncomingStockFactory extends Factory
{
    protected $model = IncomingStock::class;

    public function definition(): array
    {
        return [
            'product_id' => Product::factory(),
            'quantity' => fake()->numberBetween(1, 100),
            'date' => fake()->date(),
            'supplier_id' => Supplier::factory(),
            'notes' => fake()->sentence(),
        ];
    }
}
