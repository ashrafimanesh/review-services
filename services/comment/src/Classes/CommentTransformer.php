<?php


namespace Services\Comment\Classes;


use Illuminate\Support\Collection;
use Services\Comment\Constants\CommentStatuses;
use Services\Review\Traits\Transformer;

class CommentTransformer
{
    use Transformer;

    protected function transformRow($row)
    {
        return [
            'id' => $row->id,
            'user_id' => $row->user_id,
            'product_id' => $row->product_id,
            'status' => $row->status,
            'status_label' => CommentStatuses::label($row->status),
            'message' => $row->message
        ];
    }
}
