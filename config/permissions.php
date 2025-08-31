<?php

// return [    
//     'permissions'=>[
//         'manage roles',
//         'manage users',
//         'manage customers',
//         'manage suppliers',
//         'manage brands',
//         'manage activity logs',
//         'manage invoices','manage orders',
//         'manage product categories','manage products',
//         'manage product purchases','manage sales',
//         'manage quotations','manage units','manage payments',
//         'edit permission','delete permission','download permission'
//         ,'create permission'
//     ]
//     ];


return [
    'Admin/Owner' => [
        'manage roles',
        'manage users',
        'manage customers',
        'manage suppliers',
        'manage brands',
        'manage activity logs',
        'manage invoices',
        'manage orders',
        'manage product categories',
        'manage products',
        'manage product purchases',
        'manage sales',
        'manage quotations',
        'manage units',
        'manage payments',
        'edit permission',
        'delete permission',
        'download permission',
        'create permission'
    ],

    'Supervisor' =>  [
        'manage roles',
        'manage users',
        'manage customers',
        'manage suppliers',
        'manage brands',
        'manage activity logs',
        'manage invoices',
        'manage orders',
        'manage product categories',
        'manage products',
        'manage product purchases',
        'manage sales',
        'manage quotations',
        'manage units',
        'manage payments',
        'edit permission',
        'delete permission',
        'download permission',
        'create permission'
    ],

    'Sales Clerk'  =>  [
        'manage customers',
        'manage quotations',
        'manage units',
        'manage payments',
        'manage sales'
    ],

    'Inventory Clerk' =>  [
        'manage invoices',
        'manage orders',
        'manage product categories',
        'manage products',
        'manage product purchases',
    ],

    'Warehouse Keeper' =>  [
        'sales',

    ],

    'Return and Exchange Clerk'  => [
        'edit permission',
        'delete permission',
        'download permission',
        'create permission',
        'manage suppliers',
        'manage brands',
        'manage activity logs',
       
    ],
    
];
