<?php


namespace Services\Comment\Models;


use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['product_id', 'user_id', 'message', 'status'];
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->connection = config('comment.database.connection');
    }
}
