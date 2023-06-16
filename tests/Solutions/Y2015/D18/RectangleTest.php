<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D18;

use PHPUnit\Framework\TestCase;

final class RectangleTest extends TestCase
{
    public function test covering(): void
    {
        $point = Point::of(3, 5);
        $actual = Rectangle::covering(...$point->adjacent());
        self::assertSame('2×4 → 4×6', (string)$actual);
    }
}
