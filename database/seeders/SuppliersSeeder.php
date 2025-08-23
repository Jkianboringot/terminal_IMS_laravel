<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SuppliersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
  public function run(): void
    {
        DB::table('suppliers')->insert([
            [
                'name' => 'PLDT Inc.',
                'email' => 'info@pldt.com.ph',
                'address' => 'Makati City, Philippines, Ramon Cojuangco Building',
                'phone_number' => '+63 2 8888 8171',
               
                'tax_id' => '000-123-456-789',
                'account_number' => '1234567890',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Philippine Airlines, Inc.',
                'email' => 'info@philippineairlines.com',
                'address' => 'Pasay City, Philippines, PAL Gate 1, Andrews Avenue',
                'phone_number' => '+63 2 8855 8888',
            
                'tax_id' => '000-987-654-321',
                'account_number' => '0987654321',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'San Miguel Corporation',
                'email' => 'contact@sanmiguel.com.ph',
                'address' => 'Ortigas Center, Mandaluyong City, Philippines',
                'phone_number' => '+63 2 8632 3000',
               
                'tax_id' => '000-456-789-123',
                'account_number' => '1122334455',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jollibee Foods Corporation',
                'email' => 'corporate@jollibee.com.ph',
                'address' => 'Pasig City, Philippines, Jollibee Plaza, Ortigas Center',
                'phone_number' => '+63 2 8634 1111',
                'tax_id' => '000-234-567-890',
                'account_number' => '2233445566',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'ABS-CBN Corporation',
                'email' => 'info@abs-cbn.com',
                'address' => 'Quezon City, Philippines, Mother Ignacia Street',
                'phone_number' => '+63 2 3415 2272',
                'tax_id' => '000-345-678-901',
                'account_number' => '3344556677',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}