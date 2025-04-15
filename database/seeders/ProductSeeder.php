<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            [
                'name' => 'Blue Silent Hours Tee',
                'price' => 149000.00,
                'image' => '/assets/images/home/landingpage/Product1.png',
            ],
            [
                'name' => '"Do Not Disturb" Tee',
                'price' => 149000.00,
                'image' => '/assets/images/home/landingpage/product2.png',
            ],
            [
                'name' => 'Silent Hours Sweater',
                'price' => 349000.00,
                'image' => '/assets/images/home/landingpage/product3.png',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}