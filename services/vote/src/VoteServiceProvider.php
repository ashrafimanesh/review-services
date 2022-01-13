<?php


namespace Services\Vote;


use Illuminate\Support\ServiceProvider;
use Services\Vote\Classes\Vote;

class VoteServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/config/vote.php', 'vote');
        $this->loadMigrationsFrom(__DIR__ . '/migrations');
        $this->loadRoutesFrom(__DIR__.'/routes/vote.php');
    }

    public function boot()
    {
        $this->app->bind('vote', fn() => new Vote());
    }

}
