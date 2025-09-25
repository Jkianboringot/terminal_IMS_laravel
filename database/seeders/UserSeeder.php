<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->inset([[
          'Name'=>'joe smith',  
          'email'=>'joe@gmail.com',  
          'password'=>Hash::make('123'),  
        ],
        [
          'Name'=>'mark sulas',  
          'email'=>'mark@gmail.com',  
          'password'=>Hash::make('123'),  
        ],
        [
          'Name'=>'loyd oragon',  
          'email'=>'hazel@gmail.com',  
          'password'=>Hash::make('123'),  
        ],
        [
          'Name'=>'aldrin buhayo',  
          'email'=>'joe@gmail.com',  
          'password'=>Hash::make('123'),  
        ],
        [
          'Name'=>'cedrick tano',  
          'email'=>'cedrick@gmail.com',  
          'password'=>Hash::make('123'),  
        ],
        [
          'Name'=>'hussain rabida',  
          'email'=>'hussain@gmail.com',  
          'password'=>Hash::make('123'),  
        ],
        [
          'Name'=>'jerlyn boringot',  
          'email'=>'jerlyn@gmail.com',  
          'password'=>Hash::make('123'),  
        ],
        [
          'Name'=>'michiel camu',  
          'email'=>'michiel@gmail.com',  
          'password'=>Hash::make('123'),  
        ],
        [
          'Name'=>'jushou hoho',  
          'email'=>'jushou@gmail.com',  
          'password'=>Hash::make('123'),  
        ],
        [
          'Name'=>'wang wang',  
          'email'=>'wang@gmail.com',  
          'password'=>Hash::make('123'),  
        ],
        [
          'Name'=>'jesus smith',  
          'email'=>'jesus@gmail.com',  
          'password'=>Hash::make('123'),  
        ],
        [
          'Name'=>'juri boringot',  
          'email'=>'juri@gmail.com',  
          'password'=>Hash::make('123'),  
        ],
        [
          'Name'=>'god',  
          'email'=>'god@gmail.com',  
          'password'=>Hash::make('123'),  
        ],
    ]);
    }
}
