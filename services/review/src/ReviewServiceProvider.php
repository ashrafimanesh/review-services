<?php


namespace Services\Review;


use Illuminate\Support\ServiceProvider;
use Services\Review\Classes\Review;

class ReviewServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/config/review.php', 'review');
        $this->loadMigrationsFrom(__DIR__ . '/migrations');
        $this->loadRoutesFrom(__DIR__ . '/routes/review.php');
    }

    public function boot()
    {
        $this->app->bind('review', fn() => new Review());
    }
}
