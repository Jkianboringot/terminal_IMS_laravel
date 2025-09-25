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

// make all prural becuase its confusing except for button
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
        'manage add products',
        'manage unsuccessfull transactions',
        'manage approvals',
        'manage returns',

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
        'manage add products',
        'manage unsuccessfull transactions',
        'manage approvals',
        'manage returns',

        'create permission'
    ],

    'Sales Clerk'  =>  [
        'manage customers',
        'manage sales'
    ],

    'Inventory Clerk' =>  [
        'manage new arrivals',

    ],

    'Warehouse Keeper' =>  [
        'manage unsuccessfull transactions',
        'manage orders',


    ],

    'Return and Exchange Clerk'  => [
        'manage returns',


    ],

];

// this is the prep and final preparetion for permissions
// prep=['user','dashboard','unit','sale','role','customer','supplier','brand',
// 'category','product','purchase','order','new arrival','return','unsuccesfull transaction',
// 'approval','product defect','notes',];