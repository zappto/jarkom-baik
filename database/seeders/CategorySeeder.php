<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Electronics', 'description' => 'Electronic devices and accessories'],
            ['name' => 'Office Supplies', 'description' => 'Stationery and office equipment'],
            ['name' => 'Furniture', 'description' => 'Office and warehouse furniture'],
            ['name' => 'Packaging', 'description' => 'Packaging materials and supplies'],
            ['name' => 'Tools & Hardware', 'description' => 'Hand tools and hardware items'],
            ['name' => 'Cleaning Supplies', 'description' => 'Cleaning products and equipment'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
