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
        // Ensure categories and suppliers exist
        if (Category::count() === 0) {
            $this->call(CategorySeeder::class);
        }
        if (Supplier::count() === 0) {
            $this->call(SupplierSeeder::class);
        }

        $categoryMap = Category::pluck('id', 'name');
        $supplierId = Supplier::inRandomOrder()->value('id');

        $items = [
            ['name' => 'AC Split 1 PK Standard', 'sku' => 'AC-SPLIT-1PK', 'category' => 'AC', 'price' => 3500000, 'cost' => 2800000, 'stock' => 15, 'min_stock' => 5],
            ['name' => 'Kulkas 2 Pintu 300L', 'sku' => 'KULKAS-2P-300L', 'category' => 'Kulkas', 'price' => 4500000, 'cost' => 3600000, 'stock' => 3, 'min_stock' => 5],
            ['name' => 'Mesin Cuci 8KG Front Load', 'sku' => 'MESIN-CUCI-8KG', 'category' => 'Mesin Cuci', 'price' => 5200000, 'cost' => 4200000, 'stock' => 8, 'min_stock' => 4],
            ['name' => 'TV LED 32 Inch', 'sku' => 'TV-LED-32', 'category' => 'TV', 'price' => 2800000, 'cost' => 2200000, 'stock' => 0, 'min_stock' => 3],
            ['name' => 'Kompor Gas 2 Tungku', 'sku' => 'KOMPOR-GAS-2T', 'category' => 'Kompor', 'price' => 750000, 'cost' => 500000, 'stock' => 2, 'min_stock' => 5],
        ];

        foreach ($items as $item) {
            Product::updateOrCreate(
                ['sku' => $item['sku']],
                [
                    'name' => $item['name'],
                    'category_id' => $categoryMap[$item['category']] ?? Category::first()->id,
                    'supplier_id' => $supplierId,
                    'price' => $item['price'],
                    'cost' => $item['cost'],
                    'stock' => $item['stock'],
                    'min_stock' => $item['min_stock'],
                    'description' => null,
                    'image_path' => null,
                ]
            );
        }
    }
}
