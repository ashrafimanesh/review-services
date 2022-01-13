<?php


namespace Services\Shop;


use Illuminate\Support\ServiceProvider;
use Services\Shop\Classes\Shop;

class ShopServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/config/shop.php', 'shop');
        $this->loadMigrationsFrom(__DIR__ . '/migrations');
    }

    public function boot()
    {
        $this->app->bind('shop', fn() => new Shop());
    }
}
