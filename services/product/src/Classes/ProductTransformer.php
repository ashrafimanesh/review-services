<?php


namespace Services\Product\Classes;


use Services\Product\Constants\VisibilityValues;
use Services\Review\Traits\Transformer;

class ProductTransformer
{
    use Transformer;

    protected function transformRow($row)
    {
       return [
           'id' => $row->id,
           'name' => $row->name,
           'visibility' => $row->visibility,
           'visibility_label' => VisibilityValues::label($row->visibility),
           'price' => $row->price,
           'providers' => app(ProviderTransformer::class)->transform($row->providers)
       ];
    }
}
