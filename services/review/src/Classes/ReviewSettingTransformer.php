<?php


namespace Services\Review\Classes;


use Services\Review\Constants\CommentableStatuses;
use Services\Review\Constants\VoteableStatuses;
use Services\Review\Traits\Transformer;

class ReviewSettingTransformer
{
    use Transformer;

    protected function transformRow($row)
    {
        return [
            'product_id' => $row->product_id,
            'commentable' => $row->commentable,
            'commentable_label' => CommentableStatuses::label($row->commentable),
            'voteable' => $row->voteable,
            'voteable_label' => VoteableStatuses::label($row->voteable),
            'vote_average' => $row->vote_average ?? 0,
            'comments_count' => $row->comments_count ?? 0,
        ];
    }
}
