<?php


namespace Services\Vote\Facades;


use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Facade;

/**
 * Class Review
 * @see \Services\Vote\Classes\Vote
 * @method static Collection getApprovedAverageByProductKeys(array $productKeys)
 */
class Vote extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'vote';
    }
}
