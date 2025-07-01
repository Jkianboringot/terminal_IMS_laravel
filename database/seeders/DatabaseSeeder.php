<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            BanksSeeder::class,
            ClientsSeeder::class,
            SuppliersSeeder::class,
            UnitsSeeder::class,
            BrandsSeeder::class,
            ProductCategoriesSeeder::class,
            ProductsSeeder::class,
            PurchasesSeeder::class,
            SalesSeeder::class,
        ]);
    }
}
