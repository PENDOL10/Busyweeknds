<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // Ensure categories exist first (they should be seeded by CategorySeeder)
        $tshirtCategory = Category::where('name', 'T-Shirt')->first();
        $sweaterCategory = Category::where('name', 'Sweater')->first();
        $headwearCategory = Category::where('name', 'Headwear')->first();

        // Fallback in case categories are somehow missing
        if (!$tshirtCategory) {
            $tshirtCategory = Category::firstOrCreate(['name' => 'T-Shirt'], ['slug' => 't-shirt']);
        }
        if (!$sweaterCategory) {
            $sweaterCategory = Category::firstOrCreate(['name' => 'Sweater'], ['slug' => 'sweater']);
        }
        if (!$headwearCategory) {
            $headwearCategory = Category::firstOrCreate(['name' => 'Headwear'], ['slug' => 'headwear']);
        }

        $products = [
            [
                'name' => 'Navy Sweater',
                'description' => 'Comfortable navy sweater made from premium cotton blend. Perfect for casual wear in cooler weather.',
                'sizes' => ['S', 'M', 'L', 'XL'], // Array of sizes
                'gender' => 'Unisex',
                'price' => 459000.00,
                'discount' => null,
                'stock' => 15,
                'shipping_cost' => 15000.00,
                'category_id' => $sweaterCategory->id,
                'image' => '/assets/images/products/product3.png', // Updated path relative to storage/app/public
                'image_front' => '/assets/images/products/product3.png', // Explicit front view
                'image_back' => '/assets/images/products/product3_back.png',   // Back view
            ],
            [
                'name' => 'White Silent Hours',
                'description' => 'Classic white t-shirt featuring our Silent Hours design. Made from 100% organic cotton.',
                'sizes' => ['S', 'M', 'L', 'XL', 'XXL'],
                'gender' => 'Unisex',
                'price' => 289000.00,
                'discount' => null,
                'stock' => 20,
                'shipping_cost' => 10000.00,
                'category_id' => $tshirtCategory->id,
                'image' => '/assets/images/products/product2.png', // Updated path
                'image_front' => '/assets/images/products/product2.png', // Explicit front view
                'image_back' => '/assets/images/products/product2_back.png',   // Back view
            ],
            [
                'name' => 'Blue Silent Hours',
                'description' => 'Premium blue t-shirt featuring our Silent Hours design. Soft and comfortable fabric.',
                'sizes' => ['M', 'L', 'XL'],
                'gender' => 'Unisex',
                'price' => 289000.00,
                'discount' => null,
                'stock' => 12,
                'shipping_cost' => 10000.00,
                'category_id' => $tshirtCategory->id,
                'image' => '/assets/images/products/Product1.png', // Updated path
                'image_front' => '/assets/images/products/Product1.png', // Explicit front view
                'image_back' => '/assets/images/products/Product1_back.png',   // Back view
            ],
            [
                'name' => 'Eclipse Curve Tee',
                'description' => 'The Eclipse Curve Tee blends retro sport vibes with a modern edge. Featuring contrast black curve panels and signature emblem, it’s made for those who see the world differently. Soft, oversized, and effortlessly bold.',
                'sizes' => ['S', 'M', 'L'],
                'gender' => 'Unisex',
                'price' => 189000.00,
                'discount' => null,
                'stock' => 18,
                'shipping_cost' => 10000.00,
                'category_id' => $tshirtCategory->id,
                'image' => '/assets/images/products/product4.png', // Updated path
                'image_front' => '/assets/images/products/product4.png', // Explicit front view
                'image_back' => '/assets/images/products/product4.png',   // Back view
            ],
            [
                'name' => 'Phantom Flare Zip Hoodie',
                'description' => 'The Phantom Flare hoodie merges sharp flame-like panels with a sleek dark base for a high-contrast, high-impact look. Designed with a full-face zip for mystery and style, this piece is built for those who move in silence—but never go unnoticed.',
                'sizes' => ['M', 'L', 'XL'],
                'gender' => 'Men',
                'price' => 499000.00,
                'discount' => null,
                'stock' => 10,
                'shipping_cost' => 20000.00,
                'category_id' => $sweaterCategory->id,
                'image' => '/assets/images/products/product5.png', // Updated path
                'image_front' => '/assets/images/products/product5.png', // Explicit front view
                'image_back' => '/assets/images/products/product5_back.png',   // Back view
            ],
            [
                'name' => 'Distressed Denim Statement Cap',
                'description' => 'Make a bold impression with this rugged denim cap, featuring heavy distressing and high-impact embroidered text. Highlighted by a deconstructed circular emblem and frayed visor, this hat blends streetwear attitude with vintage flair. Perfect for those who embrace originality and edge in everyday fashion.',
                'sizes' => ['One Size'],
                'gender' => 'Unisex',
                'price' => 159000.00,
                'discount' => null,
                'stock' => 30,
                'shipping_cost' => 5000.00,
                'category_id' => $headwearCategory->id,
                'image' => '/assets/images/products/product6.jpg', // Updated path
                'image_front' => '/assets/images/products/product6.jpg', // Explicit front view
                'image_back' => '/assets/images/products/product6_back.jpg',   // Back view
            ],
            [
                'name' => 'Fairplay Racing Shirt',
                'description' => 'Inspired by vintage pit-crew uniforms, the Fairplay Racing Shirt blends sporty flair with a sharp silhouette. With bold typography and contrast paneling on cool pinstripe blue, it’s built for those who play fair but stand out loud.',
                'sizes' => ['S', 'M', 'L', 'XL'],
                'gender' => 'Men',
                'price' => 399000.00,
                'discount' => null,
                'stock' => 15,
                'shipping_cost' => 10000.00,
                'category_id' => $tshirtCategory->id,
                'image' => '/assets/images/products/product7.jpg', // Updated path
                'image_front' => '/assets/images/products/product7.jpg', // Explicit front view
                'image_back' => '/assets/images/products/product7.jpg',   // Back view
            ],
            [
                'name' => 'Strides Memory Knit',
                'description' => 'The Strides Memory Knit captures a nostalgic street mood in a rich olive tone. Featuring vintage-style visuals with a textured graphic knit, this relaxed-fit sweater blends cozy comfort with visual storytelling. A staple piece with character.',
                'sizes' => ['M', 'L', 'XL'],
                'gender' => 'Unisex',
                'price' => 459000.00,
                'discount' => null,
                'stock' => 12,
                'shipping_cost' => 15000.00,
                'category_id' => $sweaterCategory->id,
                'image' => '/assets/images/products/product8.png', // Updated path
                'image_front' => '/assets/images/products/product8.png', // Explicit front view
                'image_back' => '/assets/images/products/product8.png',   // Back view
            ],
            [
                'name' => 'Ape Icon Beanie',
                'description' => 'A soft brown knit beanie featuring a bold ape face graphic on the front. Cozy, minimal, and perfect for adding a playful touch to your outfit.',
                'sizes' => ['One Size'],
                'gender' => 'Unisex',
                'price' => 129000.00,
                'discount' => null,
                'stock' => 25,
                'shipping_cost' => 5000.00,
                'category_id' => $headwearCategory->id,
                'image' => '/assets/images/products/product9.jpg', // Updated path
                'image_front' => '/assets/images/products/product9.jpg', // Explicit front view
                'image_back' => '/assets/images/products/product9.jpg',   // Back view
            ],
            [
                'name' => 'Venezia 95 Denim Jacket',
                'description' => 'Venezia 95 is a limited-edition unisex blazer that fuses Venetian Renaissance craftsmanship with 90s Hollywood grunge. Featuring hand-embroidered Baroque-inspired motifs in eco-metallic thread, deconstructed shoulders, and hidden tech pockets (yes, it’s phone-charging compatible), this piece is art you can wear.Gen Z Must-Haves:',
                'sizes' => ['S', 'M', 'L', 'XL'],
                'gender' => 'Unisex',
                'price' => 699000.00,
                'discount' => null,
                'stock' => 25,
                'shipping_cost' => 5000.00,
                'category_id' => $sweaterCategory->id,
                'image' => '/assets/images/products/product10.png', // Updated path
                'image_front' => '/assets/images/products/product10.png', // Explicit front view
                'image_back' => '/assets/images/products/product10.png',   // Back view
            ],
        ];

        foreach ($products as $productData) {
            Product::updateOrCreate(
                ['name' => $productData['name']],
                $productData
            );
        }
    }
}