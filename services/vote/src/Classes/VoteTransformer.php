<?php


namespace Services\Vote\Classes;


use Services\Review\Traits\Transformer;
use Services\Vote\Constants\VoteStatuses;

class VoteTransformer
{
    use Transformer;
    protected function transformRow($row)
    {
        return [
            'id' => $row->id,
            'user_id' => $row->user_id,
            'product_id' => $row->product_id,
            'status' => $row->status,
            'status_label' => VoteStatuses::label($row->status),
            'vote' => $row->vote
        ];
    }
}
