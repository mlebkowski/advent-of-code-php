<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D20;

use PHPUnit\Framework\TestCase;

final class HousesTest extends TestCase
{
    public function test visit with limits(): void
    {
        $sut = Houses::upTo(21)->visit(3, upTo: 5);
        $actual = iterator_to_array($sut);
        self::assertSame([3, 6, 9, 12, 15], $actual);
    }

    public function test visit infinite(): void
    {
        $sut = Houses::upTo(21)->visit(3);
        $actual = iterator_to_array($sut);
        self::assertSame([3, 6, 9, 12, 15, 18, 21], $actual);
    }
}
