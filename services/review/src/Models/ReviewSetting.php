<?php


namespace Services\Review\Models;


use Illuminate\Database\Eloquent\Model;
use Services\Review\Constants\CommentableStatuses;
use Services\Review\Constants\VoteableStatuses;
use Services\Review\Contracts\ReviewSettingInterface;

class ReviewSetting extends Model implements ReviewSettingInterface
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->connection = config('review.database.connection');
    }

    public function getCommentableStatus()
    {
        return $this->commentable;
    }

    public function getVoteableStatus()
    {
        return $this->voteable;
    }

    public function isCommentable()
    {
        return $this->commentable != CommentableStatuses::NONE;
    }

    public function isVoteable()
    {
        return $this->voteable != VoteableStatuses::NONE;
    }
}
