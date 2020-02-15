<?php

namespace App\Helpers;

class MoneyHelper
{
    public static function format($value, $locale): string
    {
        setlocale(LC_MONETARY, $locale);
        return money_format('%.2n', $value);
    }
}
