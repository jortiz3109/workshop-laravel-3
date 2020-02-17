<?php

namespace App\Constants\Concerns;

trait HasEnumValues
{
    public static function supported(): array
    {
        return collect(static::toArray())->values()->toArray();
    }

    public static function isSupported(string $value): bool
    {
        return static::isValid($value);
    }
}
