<?php

namespace App\Providers;

use App\Models\AddProduct;
use Illuminate\Support\ServiceProvider;
use App\Models\Product;
use App\Models\Purchase;

use App\Models\Sale;
use App\Models\Customer;
use App\Models\ProductCategory;
use App\Models\Role;
use App\Models\Supplier;
use App\Models\User;
use App\Observers\ActivityObserver;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    
public function boot()
{
    Product::observe(ActivityObserver::class);
    Customer::observe(ActivityObserver::class);
    Supplier::observe(ActivityObserver::class);
    User::observe(ActivityObserver::class);
    AddProduct::observe(ActivityObserver::class);
    Role::observe(ActivityObserver::class);
    Purchase::observe(ActivityObserver::class);
    Sale::observe(ActivityObserver::class);
    ProductCategory::observe(ActivityObserver::class);
}
}
