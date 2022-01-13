<?php


namespace Services\Product\Classes;


use Services\Product\Constants\VisibilityValues;
use Services\Review\Traits\Transformer;

class ProviderTransformer
{
    use Transformer;

    protected function transformRow($row)
    {
       return [
           'id' => $row->id,
           'name' => $row->name,
       ];
    }
}
