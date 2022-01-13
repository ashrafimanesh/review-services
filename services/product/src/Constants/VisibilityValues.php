<?php


namespace Services\Product\Constants;


class VisibilityValues
{

    const VISIBLE = 1;
    const HIDDEN = 0;

    public static function asString()
    {
        return self::VISIBLE . ',' . self::HIDDEN;
    }

    public static function label($visibility)
    {
        return $visibility == self::VISIBLE ? "visible" : 'hidden';
    }
}
