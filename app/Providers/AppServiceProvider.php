<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Unit;
use App\Models\Brand;
use App\Models\ProductCategory;
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
    Brand::observe(ActivityObserver::class);

    Unit::observe(ActivityObserver::class);

    Purchase::observe(ActivityObserver::class);
    ProductCategory::observe(ActivityObserver::class);
}
}
