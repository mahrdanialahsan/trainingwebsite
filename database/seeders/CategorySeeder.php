<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Shirts', 'order' => 0],
            ['name' => 'Hats', 'order' => 1],
            ['name' => 'Bags', 'order' => 2],
            ['name' => 'Accessories', 'order' => 3],
            ['name' => 'Safety Gear', 'order' => 4],
            ['name' => 'Office', 'order' => 5],
        ];

        foreach ($categories as $item) {
            Category::firstOrCreate(
                ['name' => $item['name']],
                ['order' => $item['order']]
            );
        }
    }
}
