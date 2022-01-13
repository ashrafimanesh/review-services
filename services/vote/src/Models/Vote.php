<?php


namespace Services\Vote\Models;


use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $fillable = ['product_id', 'user_id', 'vote', 'status'];
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->connection = config('vote.database.connection');
    }
}
