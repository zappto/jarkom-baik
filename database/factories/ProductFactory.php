<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'sku' => fake()->unique()->ean8(),
            'name' => fake()->words(3, true),
            'category_id' => Category::factory(),
            'supplier_id' => Supplier::factory(),
            'purchase_price' => fake()->randomFloat(2, 1000, 50000),
            'selling_price' => fake()->randomFloat(2, 10000, 100000),
            'current_stock' => fake()->numberBetween(0, 100),
            'minimum_stock' => fake()->numberBetween(1, 10),
            'description' => fake()->sentence(),
        ];
    }
}
