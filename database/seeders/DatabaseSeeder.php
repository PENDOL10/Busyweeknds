<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Panggil UserSeeder
        $this->call(UserSeeder::class); 

        // Panggil CategorySeeder (penting agar categories ada sebelum product)
        $this->call(CategorySeeder::class); 

        // Panggil ProductSeeder
        $this->call(ProductSeeder::class); 

        // Contoh User::factory() jika Anda ingin membuatnya di sini,
        // tetapi biasanya lebih baik di dalam UserSeeder.
        // User::factory(10)->create(); 
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}