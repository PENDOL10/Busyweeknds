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
                'name' => 'Navy Sweater',
                'price' => 200000.00,
                'image' => '/assets/images/products/product3.png',
                'category' => 'Sweater',
                'size' => 'S,M,L,XL',
                'stock' => 15,
                'description' => 'Comfortable navy sweater made from premium cotton blend. Perfect for casual wear in cooler weather.',
            ],
            [
                'name' => 'White Silent Hours',
                'price' => 125000.00,
                'image' => '/assets/images/products/product2.png',
                'category' => 'T-Shirt',
                'size' => 'S,M,L,XL,XXL',
                'stock' => 20,
                'description' => 'Classic white t-shirt featuring our Silent Hours design. Made from 100% organic cotton.',
            ],
            [
                'name' => 'Blue Silent Hours',
                'price' => 400000.00,
                'image' => '/assets/images/products/Product1.png',
                'category' => 'T-Shirt',
                'size' => 'M,L,XL',
                'stock' => 12,
                'description' => 'Premium blue t-shirt featuring our Silent Hours design. Soft and comfortable fabric.',
            ],
            [
                'name' => 'Green Signature Tee',
                'price' => 159000.00,
                'image' => '/assets/images/products/product3.png',
                'category' => 'T-Shirt',
                'size' => 'S,M,L',
                'stock' => 18,
                'description' => 'Stylish green t-shirt with a unique signature design. Made from soft cotton.',
            ],
            [
                'name' => 'Grey Hoodie',
                'price' => 250000.00,
                'image' => '/assets/images/products/product2.png',
                'category' => 'Sweater',
                'size' => 'M,L,XL',
                'stock' => 10,
                'description' => 'Cozy grey hoodie perfect for outdoor activities. High-quality material.',
            ],
            [
                'name' => 'Black Cap',
                'price' => 150000.00,
                'image' => '/assets/images/products/Product1.png',
                'category' => 'Headwear',
                'size' => 'One Size',
                'stock' => 30,
                'description' => 'Sleek black cap with adjustable strap. Ideal for casual use.',
            ],
            [
                'name' => 'Red Polo Shirt',
                'price' => 180000.00,
                'image' => '/assets/images/products/product3.png',
                'category' => 'T-Shirt',
                'size' => 'S,M,L,XL',
                'stock' => 15,
                'description' => 'Classic red polo shirt with a modern fit. Breathable fabric.',
            ],
            [
                'name' => 'Brown Jacket',
                'price' => 300000.00,
                'image' => '/assets/images/products/product2.png',
                'category' => 'Sweater',
                'size' => 'M,L,XL',
                'stock' => 12,
                'description' => 'Stylish brown jacket for all seasons. Durable and warm.',
            ],
            [
                'name' => 'Beige Beanie',
                'price' => 120000.00,
                'image' => '/assets/images/products/Product1.png',
                'category' => 'Headwear',
                'size' => 'One Size',
                'stock' => 25,
                'description' => 'Soft beige beanie for a cozy look. Perfect for cold weather.',
            ],
        ];

        foreach ($products as $product) {
            Product::updateOrCreate(
                ['name' => $product['name']],
                $product
            );
        }
    }
}