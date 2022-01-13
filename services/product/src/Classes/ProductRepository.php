<?php


namespace Services\Product\Classes;


use Illuminate\Support\Collection;
use Services\Product\Models\Product;
use Services\Product\Constants\VisibilityValues;

class ProductRepository
{
    public function getProducts($visibility = null, $limit = 20, $offset = 0): Collection
    {
        $builder = Product::query();
        if (!is_null($visibility)) {
            $builder = $builder->whereVisibility($visibility);
        }
        return $builder->limit($limit)->offset($offset)->orderBy('id', 'DESC')->get();
    }

    public function changeVisibility($key, $visibility = VisibilityValues::VISIBLE)
    {
        return Product::where('id', $key)->update(['visibility' => $visibility]);
    }

    public function exists($key, $visibility = null): bool
    {
        $query = Product::where('id', $key);
        if (!is_null($visibility)) {
            $query = $query->whereVisibility($visibility);
        }
        return $query->exists();
    }
}
