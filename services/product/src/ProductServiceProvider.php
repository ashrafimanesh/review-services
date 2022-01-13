<?php


namespace Services\Product;


use Illuminate\Support\ServiceProvider;
use Services\Product\Classes\Product;

class ProductServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/config/product.php', 'product');
        $this->loadMigrationsFrom(__DIR__ . '/migrations');
        $this->loadRoutesFrom(__DIR__.'/routes/product.php');
    }

    public function boot()
    {
        $this->app->bind('product', fn() => new Product());
    }
}
