<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'brand_id' => rand(1, count(Brand::all())),
                'product_category_id' => 1, // Laptops
                'name' => 'Dell XPS 13',
                'description' => 'High-performance laptop with an Intel i7 processor and 16GB RAM.',
                'unit_id' => 1, // Assuming 1 is for 'Piece'
                'quantity' => 5,
                'purchase_price' => 150000.00,
                'sale_price' => 170000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'brand_id' => rand(1, count(Brand::all())),
                'product_category_id' => 2, // Smartphones
                'name' => 'Samsung Galaxy S23',
                'description' => 'Latest smartphone with advanced camera features and 256GB storage.',
                'unit_id' => 1, // Piece
                'quantity' => 10,
                'purchase_price' => 80000.00,   
                'sale_price' => 95000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'brand_id' => rand(1, count(Brand::all())),
                'product_category_id' => 3, // Tablets
                'name' => 'Apple iPad Pro 11"',
                'description' => 'Premium tablet with M2 chip and 128GB storage.',
                'unit_id' => 1, // Piece
                'quantity' => 8,
                'purchase_price' => 90000.00,
                'sale_price' => 105000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'brand_id' => rand(1, count(Brand::all())),
                'product_category_id' => 4, // Accessories
                'name' => 'Wireless Earbuds',
                'description' => 'Bluetooth 5.0 wireless earbuds with noise cancellation.',
                'unit_id' => 1, // Piece
                'quantity' => 20,
                'purchase_price' => 3000.00,
                'sale_price' => 4500.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'brand_id' => rand(1, count(Brand::all())), //
                'product_category_id' => 5, // PC Components
                'name' => 'NVIDIA GeForce RTX 4080',
                'description' => 'High-end graphics card for gaming and creative work.',
                'unit_id' => 1, // Piece
                'quantity' => 2,
                'purchase_price' => 200000.00,
                'sale_price' => 250000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'brand_id' => rand(1, count(Brand::all())), //
                'product_category_id' => 6, // Networking Equipment
                'name' => 'TP-Link Archer AX6000',
                'description' => 'Dual-band Wi-Fi 6 router with high-speed connectivity.',
                'unit_id' => 1, // Piece
                'quantity' => 15,
                'purchase_price' => 15000.00,
                'sale_price' => 18000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'brand_id' => rand(1, count(Brand::all())), //
                'product_category_id' => 7, // Gaming Consoles
                'name' => 'PlayStation 5',
                'description' => 'Next-generation gaming console with 4K resolution and dual sense controller.',
                'unit_id' => 1, // Piece
                'quantity' => 3,
                'purchase_price' => 60000.00,
                'sale_price' => 70000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}