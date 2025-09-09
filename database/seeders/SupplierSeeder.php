<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['name' => 'PT. Elektronik Sejahtera', 'phone' => '021-555-111', 'email' => 'sales@elektroniksejahtera.co.id', 'address' => 'Jl. Melati No. 1, Jakarta'],
            ['name' => 'CV. Sumber Barokah Elektronik', 'phone' => '031-777-222', 'email' => 'info@sumberbarokah.co.id', 'address' => 'Jl. Mawar No. 2, Surabaya'],
            ['name' => 'UD. Jaya Abadi', 'phone' => '022-888-333', 'email' => null, 'address' => 'Jl. Kenanga No. 3, Bandung'],
        ];

        foreach ($items as $item) {
            Supplier::firstOrCreate(['name' => $item['name']], $item);
        }
    }
}
