<?php

namespace Tests\Unit;

use App\Helpers\MoneyHelper;
use PHPUnit\Framework\TestCase;
use Tests\CreatesApplication;

class MoneyHelperTest extends TestCase
{
    /**
     * @test
     */
    public function formatAsExpected()
    {
        $value = 45000;
        $expected = '$45,000.00';

        $result = MoneyHelper::format($value, 'en_US');

        $this->assertSame($expected, $result);
    }
}
