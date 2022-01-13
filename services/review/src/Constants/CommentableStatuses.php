<?php


namespace Services\Review\Constants;


class CommentableStatuses
{
    const ALL = 2;
    const BUYERS = 1;
    const NONE = 0;

    public static function asString()
    {
        return self::ALL . ',' . self::BUYERS . ',' . self::NONE;
    }

    public static function label($commentable)
    {
        switch ($commentable) {
            case self::ALL:
                return 'everyone';
            case self::BUYERS:
                return 'buyers';
            case self::NONE:
                return 'none';
        }
        return $commentable;
    }
}
