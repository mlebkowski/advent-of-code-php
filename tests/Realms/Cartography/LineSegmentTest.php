<?php
declare(strict_types=1);

namespace App\Realms\Cartography;

use PHPUnit\Framework\TestCase;

final class LineSegmentTest extends TestCase
{
    public function test between(): void
    {
        $alpha = Point::of(x: 2, y: 2);
        $bravo = Point::of(x: 2, y: 5);
        $actual = LineSegment::between($alpha, $bravo);
        self::assertSame(
            '2×2, 2×3, 2×4, 2×5',
            implode(", ", $actual->points),
        );
    }
}
