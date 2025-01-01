<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Master\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        // Menambahkan data kategori secara manual
        $categories = [
            ['code' => 'CAT001', 'name' => 'Olahraga'],
            ['code' => 'CAT002', 'name' => 'Formal'],
            ['code' => 'CAT003', 'name' => 'Santai'],
            ['code' => 'CAT004', 'name' => 'Boot'],
            ['code' => 'CAT005', 'name' => 'Sandal'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
