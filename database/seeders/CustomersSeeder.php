<?php

namespace Database\Seeders;

use Faker\Factory ;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CustomersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        $customers = [];
        for ($i = 1; $i <= 20; $i++) {
            // Determine if the customer is an individual or a business
            $isBusiness = $faker->boolean(50); // 50% chance

            if ($isBusiness) {
                $name = $faker->company;
           
                $taxId = 'P' . $faker->numerify('#########') . $faker->randomLetter;
            } else {
                $name = $faker->name;

                $taxId = 'A' . $faker->numerify('#########') . $faker->randomLetter;
            }

            $customers[] = [
                'name' => $name,
                'email' => $faker->unique()->safeEmail,
                'address' => $faker->address,
                'phone_number' => $faker->unique()->phoneNumber,
              
                'tax_id' => $taxId,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('customers')->insert($customers);
    }
}