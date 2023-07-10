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

    public function test orientation between(): void
    {
        $sut = Point::of(x: 1, y: 1);
        $toSouth = $sut->inDirection(Orientation::South);
        $toEast = $sut->inDirection(Orientation::East);
        $toNorth = $sut->inDirection(Orientation::North);
        $toWest = $sut->inDirection(Orientation::West);
        self::assertSame(Orientation::North, $sut->orientationBetween($toNorth));
        self::assertSame(Orientation::East, $sut->orientationBetween($toEast));
        self::assertSame(Orientation::South, $sut->orientationBetween($toSouth));
        self::assertSame(Orientation::West, $sut->orientationBetween($toWest));
    }
}
