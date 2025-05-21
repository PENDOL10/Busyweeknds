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
                'image' => '/assets/images/products/navy-sweater.png',
                'category' => 'Sweater',
                'size' => 'S,M,L,XL',
                'stock' => 15,
                'description' => 'Comfortable navy sweater made from premium cotton blend. Perfect for casual wear in cooler weather.',
            ],
            [
                'name' => 'White Silent Hours',
                'price' => 125000.00,
                'image' => '/assets/images/products/white-silent-hours.png',
                'category' => 'T-Shirt',
                'size' => 'S,M,L,XL,XXL',
                'stock' => 20,
                'description' => 'Classic white t-shirt featuring our Silent Hours design. Made from 100% organic cotton.',
            ],
            [
                'name' => 'Blue Silent Hours',
                'price' => 400000.00,
                'image' => '/assets/images/products/blue-silent-hours.png',
                'category' => 'T-Shirt',
                'size' => 'M,L,XL',
                'stock' => 12,
                'description' => 'Premium blue t-shirt featuring our Silent Hours design. Soft and comfortable fabric.',
            ],
            [
                'name' => 'The Worship',
                'price' => 400000.00,
                'image' => '/assets/images/products/the-worship.png',
                'category' => 'T-Shirt',
                'size' => 'S,M,L',
                'stock' => 8,
                'description' => 'Stylish t-shirt with The Worship design. Limited edition, premium quality.',
            ],
            [
                'name' => 'Flesh & Blood',
                'price' => 400000.00,
                'image' => '/assets/images/products/flesh-and-blood.png',
                'category' => 'T-Shirt',
                'size' => 'M,L,XL',
                'stock' => 10,
                'description' => 'Flesh & Blood design on premium cotton t-shirt. Comfortable fit for everyday wear.',
            ],
            [
                'name' => 'The Black',
                'price' => 400000.00,
                'image' => '/assets/images/products/the-black.png',
                'category' => 'Headwear',
                'size' => 'One Size',
                'stock' => 25,
                'description' => 'Premium black cap with adjustable strap. Embroidered logo on front.',
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