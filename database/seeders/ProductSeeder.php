<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::insert([
        [
            'name' => 'Blue T-Shirt',
            'price' => 25.00,
            'stock_quantity' => 10,
            'description' => 'A comfortable blue t-shirt.',
        ],
        [
            'name' => 'White Hoodie',
            'price' => 45.00,
            'stock_quantity' => 0,
            'description' => 'A warm white hoodie.',
        ],
        [
            'name' => 'Red Hoodie',
            'price' => 45.00,
            'stock_quantity' => 5,
            'description' => 'A warm red hoodie.',
        ],
        [
            'name' => 'Black Jeans',
            'price' => 70.00,
            'stock_quantity' => 7,
            'description' => 'Stylish black jeans.',
        ],
        [
            'name' => 'Kids Jacket',
            'price' => 60.00,
            'stock_quantity' => 3,
            'description' => 'A cozy jacket for kids.',
        ],
    ]);
    }
}
