<?php

namespace Database\Factories;

use App\Models\OutgoingStock;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class OutgoingStockFactory extends Factory
{
    protected $model = OutgoingStock::class;

    public function definition(): array
    {
        return [
            'product_id' => Product::factory(),
            'quantity' => fake()->numberBetween(1, 50),
            'date' => fake()->date(),
            'destination' => fake()->city(),
            'notes' => fake()->sentence(),
        ];
    }
}
