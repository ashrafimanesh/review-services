<?php


namespace Services\Review\Facades;


use Illuminate\Support\Facades\Facade;

/**
 * Class Review
 * @see \Services\Review\Classes\Review
 * @method static canCreateComment($productKey, $userKey)
 * @method static canCreateVote($productKey, $userKey)
 */
class Review extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'review';
    }
}
