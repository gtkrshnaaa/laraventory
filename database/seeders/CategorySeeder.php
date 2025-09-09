<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['name' => 'AC', 'description' => 'Pendingin ruangan'],
            ['name' => 'Kulkas', 'description' => 'Lemari es'],
            ['name' => 'Mesin Cuci', 'description' => 'Perangkat cuci pakaian'],
            ['name' => 'TV', 'description' => 'Televisi'],
            ['name' => 'Kompor', 'description' => 'Peralatan memasak'],
        ];

        foreach ($items as $item) {
            Category::firstOrCreate(['name' => $item['name']], $item);
        }
    }
}
