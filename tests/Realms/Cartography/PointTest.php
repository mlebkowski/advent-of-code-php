<?php
declare(strict_types=1);

namespace App\Realms\Cartography;

use PHPUnit\Framework\TestCase;

final class PointTest extends TestCase
{
    public function test offset(): void
    {
        $sut = Point::of(-1, 3);
        $offset = Point::of(-1, 0);
        $actual = $sut->offset($offset);
        self::assertSame(0, $actual->x);
        self::assertSame(3, $actual->y);
    }
}
