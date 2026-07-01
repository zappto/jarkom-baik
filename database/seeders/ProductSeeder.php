<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $electronics = Category::where('name', 'Electronics')->first()->id;
        $office = Category::where('name', 'Office Supplies')->first()->id;
        $furniture = Category::where('name', 'Furniture')->first()->id;
        $packaging = Category::where('name', 'Packaging')->first()->id;
        $tools = Category::where('name', 'Tools & Hardware')->first()->id;
        $cleaning = Category::where('name', 'Cleaning Supplies')->first()->id;

        $sup1 = Supplier::where('name', 'PT Teknologi Maju')->first()->id;
        $sup2 = Supplier::where('name', 'CV Sinar Abadi')->first()->id;
        $sup3 = Supplier::where('name', 'UD Barokah Jaya')->first()->id;
        $sup4 = Supplier::where('name', 'PT Indo Perkasa')->first()->id;
        $sup5 = Supplier::where('name', 'CV Karya Mandiri')->first()->id;

        $products = [
            ['sku' => 'SKU-001', 'name' => 'Wireless Keyboard', 'category_id' => $electronics, 'supplier_id' => $sup1, 'purchase_price' => 85000, 'selling_price' => 150000, 'current_stock' => 25, 'minimum_stock' => 5, 'description' => 'Wireless keyboard with USB receiver'],
            ['sku' => 'SKU-002', 'name' => 'Wireless Mouse', 'category_id' => $electronics, 'supplier_id' => $sup1, 'purchase_price' => 45000, 'selling_price' => 85000, 'current_stock' => 40, 'minimum_stock' => 10, 'description' => 'Optical wireless mouse, 1600 DPI'],
            ['sku' => 'SKU-003', 'name' => 'USB-C Hub 7-in-1', 'category_id' => $electronics, 'supplier_id' => $sup1, 'purchase_price' => 120000, 'selling_price' => 210000, 'current_stock' => 15, 'minimum_stock' => 5, 'description' => 'USB-C multiport adapter with HDMI, USB-A, SD card'],
            ['sku' => 'SKU-004', 'name' => 'HDMI Cable 2m', 'category_id' => $electronics, 'supplier_id' => $sup2, 'purchase_price' => 25000, 'selling_price' => 50000, 'current_stock' => 60, 'minimum_stock' => 20, 'description' => 'High-speed HDMI 2.0 cable'],
            ['sku' => 'SKU-005', 'name' => 'A4 Paper 80gsm (Box)', 'category_id' => $office, 'supplier_id' => $sup2, 'purchase_price' => 180000, 'selling_price' => 280000, 'current_stock' => 30, 'minimum_stock' => 10, 'description' => 'A4 white paper, 80gsm, 5 reams per box'],
            ['sku' => 'SKU-006', 'name' => 'Ballpoint Pen Blue (Box)', 'category_id' => $office, 'supplier_id' => $sup3, 'purchase_price' => 36000, 'selling_price' => 65000, 'current_stock' => 50, 'minimum_stock' => 15, 'description' => 'Standard ballpoint pen, blue ink, box of 50'],
            ['sku' => 'SKU-007', 'name' => 'Sticky Notes 3x3 (Pack)', 'category_id' => $office, 'supplier_id' => $sup3, 'purchase_price' => 8000, 'selling_price' => 18000, 'current_stock' => 100, 'minimum_stock' => 25, 'description' => 'Yellow sticky notes, 100 sheets per pack'],
            ['sku' => 'SKU-008', 'name' => 'Office Desk 120x60cm', 'category_id' => $furniture, 'supplier_id' => $sup4, 'purchase_price' => 450000, 'selling_price' => 750000, 'current_stock' => 8, 'minimum_stock' => 3, 'description' => 'Wooden office desk with drawer, white finish'],
            ['sku' => 'SKU-009', 'name' => 'Ergonomic Office Chair', 'category_id' => $furniture, 'supplier_id' => $sup4, 'purchase_price' => 650000, 'selling_price' => 1200000, 'current_stock' => 5, 'minimum_stock' => 3, 'description' => 'Adjustable ergonomic chair with lumbar support'],
            ['sku' => 'SKU-010', 'name' => 'Bookshelf 5-Tier', 'category_id' => $furniture, 'supplier_id' => $sup4, 'purchase_price' => 320000, 'selling_price' => 550000, 'current_stock' => 10, 'minimum_stock' => 4, 'description' => '5-tier metal bookshelf, black'],
            ['sku' => 'SKU-011', 'name' => 'Corrugated Box 40x30x20', 'category_id' => $packaging, 'supplier_id' => $sup5, 'purchase_price' => 5000, 'selling_price' => 12000, 'current_stock' => 200, 'minimum_stock' => 50, 'description' => 'Corrugated cardboard box for shipping'],
            ['sku' => 'SKU-012', 'name' => 'Bubble Wrap Roll 50m', 'category_id' => $packaging, 'supplier_id' => $sup5, 'purchase_price' => 75000, 'selling_price' => 140000, 'current_stock' => 12, 'minimum_stock' => 5, 'description' => 'Protective bubble wrap, 50m x 50cm roll'],
            ['sku' => 'SKU-013', 'name' => 'Packing Tape 48mm', 'category_id' => $packaging, 'supplier_id' => $sup5, 'purchase_price' => 12000, 'selling_price' => 25000, 'current_stock' => 80, 'minimum_stock' => 20, 'description' => 'Clear packing tape, 48mm x 100m'],
            ['sku' => 'SKU-014', 'name' => 'Hammer 500g', 'category_id' => $tools, 'supplier_id' => $sup4, 'purchase_price' => 35000, 'selling_price' => 65000, 'current_stock' => 20, 'minimum_stock' => 5, 'description' => 'Claw hammer with rubber grip handle'],
            ['sku' => 'SKU-015', 'name' => 'Screwdriver Set 6pc', 'category_id' => $tools, 'supplier_id' => $sup4, 'purchase_price' => 55000, 'selling_price' => 95000, 'current_stock' => 18, 'minimum_stock' => 5, 'description' => 'Magnetic screwdriver set, Phillips and flathead'],
            ['sku' => 'SKU-016', 'name' => 'Cutter Knife Heavy Duty', 'category_id' => $tools, 'supplier_id' => $sup5, 'purchase_price' => 15000, 'selling_price' => 30000, 'current_stock' => 35, 'minimum_stock' => 10, 'description' => 'Retractable utility knife with spare blades'],
            ['sku' => 'SKU-017', 'name' => 'Multi-purpose Cleaner 1L', 'category_id' => $cleaning, 'supplier_id' => $sup3, 'purchase_price' => 18000, 'selling_price' => 35000, 'current_stock' => 45, 'minimum_stock' => 10, 'description' => 'Liquid multi-purpose cleaner, lemon scent'],
            ['sku' => 'SKU-018', 'name' => 'Microfiber Cloth (Pack 10)', 'category_id' => $cleaning, 'supplier_id' => $sup3, 'purchase_price' => 25000, 'selling_price' => 50000, 'current_stock' => 30, 'minimum_stock' => 10, 'description' => 'Lint-free microfiber cleaning cloth'],
            ['sku' => 'SKU-019', 'name' => 'Trash Bag 60L (Pack 50)', 'category_id' => $cleaning, 'supplier_id' => $sup3, 'purchase_price' => 30000, 'selling_price' => 55000, 'current_stock' => 25, 'minimum_stock' => 10, 'description' => 'Heavy-duty black trash bags, 60 liter'],
            ['sku' => 'SKU-020', 'name' => 'Hand Soap Refill 5L', 'category_id' => $cleaning, 'supplier_id' => $sup3, 'purchase_price' => 45000, 'selling_price' => 85000, 'current_stock' => 2, 'minimum_stock' => 5, 'description' => 'Antibacterial hand soap refill pouch'],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
