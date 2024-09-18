<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::insert([
            [
                'name' => 'Title goes here',
                'price' => 18.25,
                'image' => 'product_01.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Title goes here',
                'price' => 32.50,
                'image' => 'product_03.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Title goes here',
                'price' => 24.60,
                'image' => 'product_04.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Title goes here',
                'price' => 18.75,
                'image' => 'product_05.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Title goes here',
                'price' => 12.50,
                'image' => 'product_06.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}