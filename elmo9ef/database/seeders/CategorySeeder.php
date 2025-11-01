<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'Handyman'],
            ['name' => 'Moving Services'],
            ['name' => 'Mounting & Installation'],
            ['name' => 'Furniture Assembly'],
            ['name' => 'Cleaning'],
        ];

        Category::insert($categories);
    }
}
