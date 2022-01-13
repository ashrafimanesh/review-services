<?php

namespace Services\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'visibility', 'price'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->connection = config('product.database.connection');
    }

    public function providers()
    {
        return $this->hasManyThrough(Provider::class, ProductProvider::class, 'product_id', 'id', 'id', 'provider_id');
    }
}
