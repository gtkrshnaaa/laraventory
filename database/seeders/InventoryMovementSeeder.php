<?php

namespace Database\Seeders;

use App\Models\InventoryMovement;
use App\Models\Product;
use Illuminate\Database\Seeder;

class InventoryMovementSeeder extends Seeder
{
    public function run(): void
    {
        if (Product::count() === 0) {
            $this->call(ProductSeeder::class);
        }

        $products = Product::all();

        foreach ($products as $product) {
            // Stock in
            InventoryMovement::create([
                'product_id' => $product->id,
                'type' => 'in',
                'quantity' => 5,
                'note' => 'Initial stock in',
                'created_by' => null,
            ]);

            // Stock out (if possible)
            if ($product->stock > 0) {
                InventoryMovement::create([
                    'product_id' => $product->id,
                    'type' => 'out',
                    'quantity' => min(2, max(1, (int) floor($product->stock / 2))),
                    'note' => 'Sample stock out',
                    'created_by' => null,
                ]);
            }
        }
    }
}
