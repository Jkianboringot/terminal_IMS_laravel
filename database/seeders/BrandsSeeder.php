<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('brands')->insert([
            [
                'name' => 'Nike',
                'logo_path' => 'logos/nike.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Adidas',
                'logo_path' => 'logos/adidas.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'apple',
                'logo_path' => 'logos/apple.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Samsung',
                'logo_path' => 'logos/samsung.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Coca-cola',
                'logo_path' => 'logos/coca_cola.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sony',
                'logo_path' => 'logos/sony.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tesla',
                'logo_path' => 'logos/tesla.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Microsoft',
                'logo_path' => 'logos/microsoft.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Toyota',
                'logo_path' => 'logos/toyota.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}