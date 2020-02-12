<?php

namespace App\Helpers;

use Money\Currencies\ISOCurrencies;
use Money\Currency;
use Money\Formatter\IntlMoneyFormatter;
use Money\Money;
use Money\Parser\DecimalMoneyParser;
use NumberFormatter;

class MoneyHelper
{
    public static function format($value, string $currency): string
    {
        $money = new Money($value, new Currency($currency));
        $currencies = new ISOCurrencies();

        $numberFormatter = static::getNumberFormatter();
        $moneyFormatter = new IntlMoneyFormatter($numberFormatter, $currencies);

        return $moneyFormatter->format($money);
    }

    public static function normalize($value, Currency $currency): int
    {
        $currencies = new ISOCurrencies();
        $exponent = $currencies->subunitFor($currency);

        $float = round($value, $exponent) * pow(10, $exponent);

        return (int) $float;
    }

    public static function amount($value, string $currency): string
    {
        $currencies = new ISOCurrencies();

        $moneyParser = new DecimalMoneyParser($currencies);

        $money = $moneyParser->parse($value);

        return $money->getAmount();
    }

    public static function getNumberFormatter(): NumberFormatter
    {
        return new NumberFormatter(app()->getLocale(), NumberFormatter::CURRENCY);
    }
}
