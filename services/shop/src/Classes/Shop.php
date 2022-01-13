<?php


namespace Services\Shop\Classes;

/**
 * Class Shop
 * @package Services\Shop\Classes
 */
class Shop
{
    public function hasBought($productKey, $userKey)
    {
        /** @var OrderRepository $repository */
        $repository = app(OrderRepository::class);
        return $repository->hasBought($productKey, $userKey);
    }
}
