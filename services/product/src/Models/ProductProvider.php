<?php

namespace Services\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductProvider extends Pivot
{
    use HasFactory;

    protected $fillable = ['product_id', 'provider_id'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->connection = config('product.database.connection');
    }
}
