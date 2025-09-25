<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([[
          'name'=>'joe smith',  
          'email'=>'joe@gmail.com',  
          'password'=>Hash::make('123'),  
        ],
        [
          'name'=>'mark sulas',  
          'email'=>'mark@gmail.com',  
          'password'=>Hash::make('123'),  
        ],
        [
          'name'=>'loyd oragon',  
          'email'=>'hazel@gmail.com',  
          'password'=>Hash::make('123'),  
        ],

        [
          'name'=>'kian boringot',  
          'email'=>'kian@gmail.com',  
          'password'=>Hash::make('123'),  
        ],
        [
          'name'=>'jerlyn boringot',  
          'email'=>'jerlyn@gmail.com',  
          'password'=>Hash::make('123'),  
        ],
      
    ]);
    }
}
