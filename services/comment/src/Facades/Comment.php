<?php


namespace Services\Comment\Facades;


use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Facade;

/**
 * Class Review
 * @see \Services\Comment\Classes\Comment
 * @method static Collection getApprovedCountByProductKeys(array $productKeys)
 */
class Comment extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'comment';
    }
}
