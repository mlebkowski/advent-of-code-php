<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D18;

use loophp\collection\Collection;
use PHPUnit\Framework\TestCase;

final class PointTest extends TestCase
{
    public function test adjacent(): void
    {
        $sut = Point::of(4, 5);
        $actual = Collection::fromIterable($sut->adjacent())
            ->map(static fn (Point $point) => (string)$point)
            ->sort()
            ->implode(', ');

        self::assertSame('3×4, 3×5, 3×6, 4×4, 4×6, 5×4, 5×5, 5×6', $actual);
    }

    public function test adjacent when point at the edge(): void
    {
        $sut = Point::of(0, 5);
        $actual = Collection::fromIterable($sut->adjacent())
            ->map(static fn (Point $point) => (string)$point)
            ->sort()
            ->implode(', ');

        self::assertSame('0×4, 0×6, 1×4, 1×5, 1×6', $actual);
    }

    public function test adjacent when point in the corner(): void
    {
        $sut = Point::of(0, 0);
        $actual = Collection::fromIterable($sut->adjacent())
            ->map(static fn (Point $point) => (string)$point)
            ->sort()
            ->implode(', ');

        self::assertSame('0×1, 1×0, 1×1', $actual);
    }
}
