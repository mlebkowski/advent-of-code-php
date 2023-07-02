<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D21\Operations;

use PHPUnit\Framework\TestCase;

final class ReverseRangeTest extends TestCase
{
    public function test(): void
    {
        self::assertSame('adcbe', ReverseRange::of(1, 3)->apply('abcde'));
        self::assertSame('edcba', ReverseRange::of(0, 4)->apply('abcde'));
    }
}
