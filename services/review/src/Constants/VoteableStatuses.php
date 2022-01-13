<?php


namespace Services\Review\Constants;


class VoteableStatuses
{
    const ALL = 2;
    const BUYERS = 1;
    const NONE = 0;

    public static function asString()
    {
        return self::ALL . ',' . self::BUYERS . ',' . self::NONE;
    }

    public static function label($voteable)
    {
        switch ($voteable) {
            case self::ALL:
                return 'everyone';
            case self::BUYERS:
                return 'buyers';
            case self::NONE:
                return 'none';
        }
        return $voteable;
    }
}
