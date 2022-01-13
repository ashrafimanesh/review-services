<?php


namespace Services\Shop\Models;


use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->connection = config('shop.database.connection');
    }
}
