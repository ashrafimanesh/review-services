<?php


namespace Services\Shop\Facades;


use Illuminate\Support\Facades\Facade;

/**
 * Class Shop
 * @see \Services\Shop\Classes\Shop
 * @method static hasBought($productKey, $userKey)
 */
class Shop extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'shop';
    }
}
