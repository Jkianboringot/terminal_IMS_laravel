<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'title' => 'Supervisor',
                'permissions' => Json::encode(["manage roles","manage users", "manage customers","manage suppliers", "manage brands","manage activity logs", "manage invoices","manage orders", "manage product categories","manage products", "manage product purchases","manage sales", "manage quotations", "manage units", "manage payments","edit permission", "delete permission","download permission", "manage add products","manage unsuccessfull transactions", "manage approvals", "create permission"]),

            ],
            [
                'title' => 'Sales Clerk',
                'permissions' => Json::encode(['manage customers','manage sales']),

            ],
            [
                'title' => 'Inventory Clerk',
                'permissions' => Json::encode(['manage new arrivals']),

            ],
            [
                'title' => 'Warehouse Keeper',
                'permissions' => Json::encode([
                        'manage unsuccessfull transactions','manage orders']),

            ],
            [
                'title' => 'Return and Exchange Clerk',
                'permissions' => Json::encode(['manage returns']),


            ],
        ]);
    }
}
