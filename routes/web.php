<?php

use App\Models\Invoice;
use App\Models\Order;
use App\Models\Quotation;
use \Barryvdh\DomPDF\Facade\PDF;
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

    // order download
    Route::get('/{id}/order', function ($id) {
        $order = Order::find($id);

        return PDF::loadView('pdf.purchase-order', [
            'order' => $order
        ])->stream();
        // ->download('Order - #' . sprintf('%04d', $order->id) . 'pdf')
    })->name('order-download');

    // quotation download
    Route::get('/{id}/quotation', function ($id) {
        $quotation = Quotation::find($id);

        return PDF::loadView('pdf.quotation', [
            'quotation' => $quotation
        ])->stream();
        // ->download('Order - #' . sprintf('%04d', $order->id) . 'pdf')
    })->name('quotation-download');


 // invoice download
    Route::get('/{id}/invoice', function ($id) {
        $invoice = Invoice::find($id);

        return PDF::loadView('pdf.invoice', [
            'invoice' => $invoice
        ])->stream();
        // ->download('Order - #' . sprintf('%04d', $order->id) . 'pdf')
    })->name('invoice-download');


    Route::get('/dashboard', Admin\Dashboard::class)->name('dashboard');
    // Route::get('/accounts-summary', Admin\AccountsSummary::class)->name('accounts-summary');

    Route::prefix('users')->middleware('permission:manage users')->name('users.')->group(function () {
        Route::get('/', Admin\Users\Index::class)->name('index');
        Route::get('/create', Admin\Users\Create::class)->middleware('permission:create permission')->name('create');
        Route::get('{id}/edit', Admin\Users\Edit::class)->name('edit');
    });

    Route::prefix('banks')->middleware('permission:manage banks')->name('banks.')->group(function () {
        Route::get('/', Admin\Banks\Index::class)->name('index');
        Route::get('/create', Admin\Banks\Create::class)->middleware('permission:create permission')->name('create');
        Route::get('{id}/edit', Admin\Banks\Edit::class)->name('edit');
    });

    Route::prefix('brands')->middleware('permission:manage brands')->name('brands.')->group(function () {
        Route::get('/', Admin\Brands\Index::class)->name('index');
        Route::get('/create', Admin\Brands\Create::class)->middleware('permission:create permission')->name('create');
        Route::get('{id}/edit', Admin\Brands\Edit::class)->name('edit');
    });

    Route::prefix('clients')->middleware('permission:manage clients')->name('clients.')->group(function () {
        Route::get('/', Admin\Clients\Index::class)->name('index');
        Route::get('/create', Admin\Clients\Create::class)->middleware('permission:create permission')->name('create');
        Route::get('{id}/edit', Admin\Clients\Edit::class)->name('edit');
    });

    // Route::prefix('credit-notes')->middleware('permission:manage credit notes')->name('creditnotes.')->group(function () {
    //     Route::get('/', Admin\CreditNotes\Index::class)->name('index');
    //     Route::get('/create', Admin\CreditNotes\Create::class)->middleware('permission:create permission')->name('create');
    //     Route::get('{id}/edit', Admin\CreditNotes\Edit::class)->name('edit');
    // });

    // Route::prefix('delivery-notes')->middleware('permission:manage delivery notes')->name('deliverynotes.')->group(function () {
    //     Route::get('/', Admin\DeliveryNotes\Index::class)->name('index');
    //     Route::get('/create', Admin\DeliveryNotes\Create::class)->middleware('permission:create permission')->name('create');
    //     Route::get('{id}/edit', Admin\DeliveryNotes\Edit::class)->name('edit');
    // });

    // Route::prefix('invoices')->middleware('permission:manage invoices')->name('invoices.')->group(function () {
    //     Route::get('/', Admin\Invoices\Index::class)->name('index');
    //     Route::get('/create', Admin\Invoices\Create::class)->middleware('permission:create permission')->name('create');
    //     Route::get('{id}/edit', Admin\Invoices\Edit::class)->name('edit');
    // });

    // Route::prefix('orders')->middleware('permission:manage orders')->name('orders.')->group(function () {
    //     Route::get('/', Admin\Orders\Index::class)->name('index');
    //     Route::get('/create', Admin\Orders\Create::class)->middleware('permission:create permission')->name('create');
    //     Route::get('{id}/edit', Admin\Orders\Edit::class)->name('edit');
    // });

    Route::prefix('product-categories')->middleware('permission:manage product categories')->name('productcategories.')->group(function () {
        Route::get('/', Admin\ProductCategories\Index::class)->name('index');
        Route::get('/create', Admin\ProductCategories\Create::class)->middleware('permission:create permission')->name('create');
        Route::get('{id}/edit', Admin\ProductCategories\Edit::class)->name('edit');
    });

    Route::prefix('products')->middleware('permission:manage products')->name('products.')->group(function () {
        Route::get('/', Admin\Products\Index::class)->name('index');
        Route::get('/create', Admin\Products\Create::class)->middleware('permission:create permission')->name('create');
        Route::get('{id}/edit', Admin\Products\Edit::class)->name('edit');
    });

    Route::prefix('purchases')->middleware('permission:manage product purchases')->name('purchases.')->group(function () {
        Route::get('/', Admin\Purchases\Index::class)->name('index');
        Route::get('/create', Admin\Purchases\Create::class)->middleware('permission:create permission')->name('create');
        Route::get('{id}/edit', Admin\Purchases\Edit::class)->name('edit');
    });

    // Route::prefix('quotations')->middleware('permission:manage quotations')->name('quotations.')->group(function () {
    //     Route::get('/', Admin\Quotations\Index::class)->name('index');
    //     Route::get('/create', Admin\Quotations\Create::class)->middleware('permission:create permission')->name('create');
    //     Route::get('{id}/edit', Admin\Quotations\Edit::class)->name('edit');
    // });

    Route::prefix('roles')->middleware('permission:manage roles')->name('roles.')->group(function () {
        Route::get('/', Admin\Roles\Index::class)->name('index');
        Route::get('/create', Admin\Roles\Create::class)->middleware('permission:create permission')->name('create');
        Route::get('{id}/edit', Admin\Roles\Edit::class)->name('edit');
    });

    // Route::prefix('sales')->middleware('permission:manage sales')->name('sales.')->group(function () {
    //     Route::get('/', Admin\Sales\Index::class)->name('index');
    //     Route::get('/create', Admin\Sales\Create::class)->middleware('permission:create permission')->name('create');
    //     Route::get('{id}/edit', Admin\Sales\Edit::class)->name('edit');
    // });

    Route::prefix('suppliers')->middleware('permission:manage suppliers')->name('suppliers.')->group(function () {
        Route::get('/', Admin\Suppliers\Index::class)->name('index');
        Route::get('/create', Admin\Suppliers\Create::class)->middleware('permission:create permission')->name('create');
        Route::get('{id}/edit', Admin\Suppliers\Edit::class)->name('edit');
    });

    Route::prefix('units')->middleware('permission:manage units')->name('units.')->group(function () {
        Route::get('/', Admin\Units\Index::class)->name('index');
        Route::get('/create', Admin\Units\Create::class)->middleware('permission:create permission')->name('create');
        Route::get('{id}/edit', Admin\Units\Edit::class)->name('edit');
    });


//   Route::prefix('purchase-payments')->middleware('permission:manage payments')->name('purchase-payments.')->group(function () {
//         Route::get('/', Admin\PurchasePayments\Index::class)->name('index');
//         Route::get('/create', Admin\PurchasePayments\Create::class)->middleware('permission:create permission')->name('create');
//         Route::get('{id}/edit', Admin\PurchasePayments\Edit::class)->name('edit');
//     });

    
//   Route::prefix('sale-payments')->middleware('permission:manage payments')->name('sale-payments.')->group(function () {
//         Route::get('/', Admin\SalePayments\Index::class)->name('index');
//         Route::get('/create', Admin\SalePayments\Create::class)->middleware('permission:create permission')->name('create');
//         Route::get('{id}/edit', Admin\SalePayments\Edit::class)->name('edit');
//     });

});
