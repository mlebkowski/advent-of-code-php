<?php
declare(strict_types=1);

namespace App\Realms\Cartography;

use PHPUnit\Framework\TestCase;

final class PathTest extends TestCase
{
    public function test combine(): void
    {
        $alpha = Path::ofPoints(
            Point::of(x: 1, y: 1),
            Point::of(x: 1, y: 2),
            Point::of(x: 1, y: 3),
            Point::of(x: 2, y: 3),
            Point::of(x: 3, y: 3),
        );
        $bravo = Path::ofPoints(
            Point::of(x: 3, y: 3),
            Point::of(x: 3, y: 2),
            Point::of(x: 3, y: 1),
            Point::of(x: 4, y: 1),
        );
        $actual = Path::combine($alpha, $bravo);
        self::assertSame(
            <<<EOF
            ╷ ┌╴
            │ │ 
            └─┘ 
            EOF,
            (string)$actual->toMap(),
        );
    }

    public function test around area(): void
    {
        $given = Area::covering(Point::of(0, 0), Point::of(4, 1));
        $actual = Path::aroundArea($given);
        self::assertSame(
            <<<PATH
            ┌─────┐
            │     │
            │     │
            └─────┘
            PATH,
            (string)$actual->toMap(),
        );
    }
}
