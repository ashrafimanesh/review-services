<?php


namespace Services\Comment;


use Illuminate\Support\ServiceProvider;
use Services\Comment\Classes\Comment;

class CommentServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/config/comment.php', 'comment');
        $this->loadMigrationsFrom(__DIR__ . '/migrations');
        $this->loadRoutesFrom(__DIR__.'/routes/comment.php');
    }

    public function boot()
    {
        $this->app->bind('comment', fn() => new Comment());
    }

}
