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
        DB::table('users')->inset([[
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
          'name'=>'aldrin buhayo',  
          'email'=>'joe@gmail.com',  
          'password'=>Hash::make('123'),  
        ],
        [
          'name'=>'cedrick tano',  
          'email'=>'cedrick@gmail.com',  
          'password'=>Hash::make('123'),  
        ],
        [
          'name'=>'hussain rabida',  
          'email'=>'hussain@gmail.com',  
          'password'=>Hash::make('123'),  
        ],
        [
          'name'=>'jerlyn boringot',  
          'email'=>'jerlyn@gmail.com',  
          'password'=>Hash::make('123'),  
        ],
        [
          'name'=>'michiel camu',  
          'email'=>'michiel@gmail.com',  
          'password'=>Hash::make('123'),  
        ],
        [
          'name'=>'jushou hoho',  
          'email'=>'jushou@gmail.com',  
          'password'=>Hash::make('123'),  
        ],
        [
          'name'=>'wang wang',  
          'email'=>'wang@gmail.com',  
          'password'=>Hash::make('123'),  
        ],
        [
          'name'=>'jesus smith',  
          'email'=>'jesus@gmail.com',  
          'password'=>Hash::make('123'),  
        ],
        [
          'name'=>'juri boringot',  
          'email'=>'juri@gmail.com',  
          'password'=>Hash::make('123'),  
        ],
        [
          'name'=>'god',  
          'email'=>'god@gmail.com',  
          'password'=>Hash::make('123'),  
        ],
    ]);
    }
}
