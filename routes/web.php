<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin;

Route::get('/', function () {
    return redirect('dashboard');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->name('admin.')->group(function () {
    Route::get('/dashboard',Admin\Dashboard::class)->name('dashboard');
  
    Route::prefix('users')->name('users.')->group(function(){
    Route::get('/',Admin\Users\Index::class)->name('index');
    Route::get('/create',Admin\Users\Create::class)->name('create');
    Route::get('/edit',Admin\Users\Edit::class)->name('edit');
    });

    Route::prefix('banks')->name('banks.')->group(function () {
    Route::get('/', Admin\Banks\Index::class)->name('index');
    Route::get('/create', Admin\Banks\Create::class)->name('create');
    Route::get('/edit', Admin\Banks\Edit::class)->name('edit');
});

Route::prefix('brands')->name('brands.')->group(function () {
    Route::get('/', Admin\Brands\Index::class)->name('index');
    Route::get('/create', Admin\Brands\Create::class)->name('create');
    Route::get('/edit', Admin\Brands\Edit::class)->name('edit');
});

Route::prefix('clients')->name('clients.')->group(function () {
    Route::get('/', Admin\Clients\Index::class)->name('index');
    Route::get('/create', Admin\Clients\Create::class)->name('create');
    Route::get('/edit', Admin\Clients\Edit::class)->name('edit');
});

Route::prefix('credit-notes')->name('creditnotes.')->group(function () {
    Route::get('/', Admin\CreditNotes\Index::class)->name('index');
    Route::get('/create', Admin\CreditNotes\Create::class)->name('create');
    Route::get('/edit', Admin\CreditNotes\Edit::class)->name('edit');
});

Route::prefix('delivery-notes')->name('deliverynotes.')->group(function () {
    Route::get('/', Admin\DeliveryNotes\Index::class)->name('index');
    Route::get('/create', Admin\DeliveryNotes\Create::class)->name('create');
    Route::get('/edit', Admin\DeliveryNotes\Edit::class)->name('edit');
});

Route::prefix('invoices')->name('invoices.')->group(function () {
    Route::get('/', Admin\Invoices\Index::class)->name('index');
    Route::get('/create', Admin\Invoices\Create::class)->name('create');
    Route::get('/edit', Admin\Invoices\Edit::class)->name('edit');
});

Route::prefix('orders')->name('orders.')->group(function () {
    Route::get('/', Admin\Orders\Index::class)->name('index');
    Route::get('/create', Admin\Orders\Create::class)->name('create');
    Route::get('/edit', Admin\Orders\Edit::class)->name('edit');
});

Route::prefix('product-categories')->name('productcategories.')->group(function () {
    Route::get('/', Admin\ProductCategories\Index::class)->name('index');
    Route::get('/create', Admin\ProductCategories\Create::class)->name('create');
    Route::get('/edit', Admin\ProductCategories\Edit::class)->name('edit');
});

Route::prefix('products')->name('products.')->group(function () {
    Route::get('/', Admin\Products\Index::class)->name('index');
    Route::get('/create', Admin\Products\Create::class)->name('create');
    Route::get('/edit', Admin\Products\Edit::class)->name('edit');
});

Route::prefix('purchases')->name('purchases.')->group(function () {
    Route::get('/', Admin\Purchases\Index::class)->name('index');
    Route::get('/create', Admin\Purchases\Create::class)->name('create');
    Route::get('/edit', Admin\Purchases\Edit::class)->name('edit');
});

Route::prefix('quotations')->name('quotations.')->group(function () {
    Route::get('/', Admin\Quotations\Index::class)->name('index');
    Route::get('/create', Admin\Quotations\Create::class)->name('create');
    Route::get('/edit', Admin\Quotations\Edit::class)->name('edit');
});

Route::prefix('roles')->name('roles.')->group(function () {
    Route::get('/', Admin\Roles\Index::class)->name('index');
    Route::get('/create', Admin\Roles\Create::class)->name('create');
    Route::get('/edit', Admin\Roles\Edit::class)->name('edit');
});

Route::prefix('sales')->name('sales.')->group(function () {
    Route::get('/', Admin\Sales\Index::class)->name('index');
    Route::get('/create', Admin\Sales\Create::class)->name('create');
    Route::get('/edit', Admin\Sales\Edit::class)->name('edit');
});

Route::prefix('suppliers')->name('suppliers.')->group(function () {
    Route::get('/', Admin\Suppliers\Index::class)->name('index');
    Route::get('/create', Admin\Suppliers\Create::class)->name('create');
    Route::get('/edit', Admin\Suppliers\Edit::class)->name('edit');
});

Route::prefix('units')->name('units.')->group(function () {
    Route::get('/', Admin\Units\Index::class)->name('index');
    Route::get('/create', Admin\Units\Create::class)->name('create');
    Route::get('/edit', Admin\Units\Edit::class)->name('edit');
});




});
