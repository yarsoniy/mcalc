<?php

namespace App\Domain\Shared;

abstract class Enum
{
    public const VALUES = [];

    public static function hasValue(string $value)
    {
        return in_array($value, static::VALUES, true);
    }
}
