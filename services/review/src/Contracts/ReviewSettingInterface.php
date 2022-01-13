<?php


namespace Services\Review\Contracts;


interface ReviewSettingInterface
{
    public function getCommentableStatus();
    public function getVoteableStatus();
}
