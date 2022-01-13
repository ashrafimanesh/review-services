<?php


namespace Services\Vote\Constants;


class VoteStatuses
{
    const APPROVED = 2;
    const CREATED = 1;
    const REJECTED = 0;

    public static function label($status)
    {
        switch ($status) {
            case self::APPROVED:
                return 'approved';
            case self::CREATED:
                return 'new';
            case self::REJECTED:
                return 'rejected';
        }
        return $status;
    }

    public static function asString()
    {
        return self::REJECTED . ',' . self::CREATED . ',' . self::APPROVED;
    }

}
