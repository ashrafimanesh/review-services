<?php


namespace Services\Product\Facades;


use Illuminate\Support\Facades\Facade;

/**
 * Class Product
 * @see \Services\Product\Classes\Product
 * @method static changeVisibility($productKey, int $visibility)
 * @method static bool exists($productKey, $visibility = null)
 */
class Product extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'product';
    }
}
