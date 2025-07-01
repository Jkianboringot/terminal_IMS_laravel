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
                'registration_number' => 'CS200812345',
                'tax_id' => '000-123-456-789',
                'bank_id' => 1,
                'account_number' => '1234567890',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Philippine Airlines, Inc.',
                'email' => 'info@philippineairlines.com',
                'address' => 'Pasay City, Philippines, PAL Gate 1, Andrews Avenue',
                'phone_number' => '+63 2 8855 8888',
                'registration_number' => 'CS198945678',
                'tax_id' => '000-987-654-321',
                'bank_id' => 2,
                'account_number' => '0987654321',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'San Miguel Corporation',
                'email' => 'contact@sanmiguel.com.ph',
                'address' => 'Ortigas Center, Mandaluyong City, Philippines',
                'phone_number' => '+63 2 8632 3000',
                'registration_number' => 'CS199102345',
                'tax_id' => '000-456-789-123',
                'bank_id' => 3,
                'account_number' => '1122334455',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jollibee Foods Corporation',
                'email' => 'corporate@jollibee.com.ph',
                'address' => 'Pasig City, Philippines, Jollibee Plaza, Ortigas Center',
                'phone_number' => '+63 2 8634 1111',
                'registration_number' => 'CS199912345',
                'tax_id' => '000-234-567-890',
                'bank_id' => 4,
                'account_number' => '2233445566',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'ABS-CBN Corporation',
                'email' => 'info@abs-cbn.com',
                'address' => 'Quezon City, Philippines, Mother Ignacia Street',
                'phone_number' => '+63 2 3415 2272',
                'registration_number' => 'CS200001234',
                'tax_id' => '000-345-678-901',
                'bank_id' => 5,
                'account_number' => '3344556677',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}