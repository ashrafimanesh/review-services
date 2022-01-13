<?php


namespace Services\Product\Classes;


class Product
{
    public function changeVisibility($productKey, $visibility)
    {
        /** @var ProductRepository $repository */
        $repository = app(ProductRepository::class);
        return $repository->changeVisibility($productKey, $visibility);
    }

    public function exists($productKey, $visibility = null): bool
    {
        /** @var ProductRepository $repository */
        $repository = app(ProductRepository::class);
        return $repository->exists($productKey, $visibility);
    }
}
