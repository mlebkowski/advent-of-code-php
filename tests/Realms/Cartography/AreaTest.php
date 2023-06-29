<?php

declare(strict_types=1);

namespace App\Realms\Cartography;

use PHPUnit\Framework\TestCase;

final class AreaTest extends TestCase
{
    public function test covering(): void
    {
        $points = [
            Point::of(2, 4),
            Point::of(3, 5),
            Point::of(2, 6),
            Point::of(4, 6),
        ];
        $actual = Area::covering(...$points);
        self::assertSame('2×4 → 4×6', (string)$actual);
    }
}
