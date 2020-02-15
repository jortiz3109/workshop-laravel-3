<?php

namespace App\Helpers;

class MoneyHelper
{
    public static function format($value): string
    {
        setlocale(LC_MONETARY, config('app.monetary_locale'));
        return money_format('%.2n', $value);
    }
}
