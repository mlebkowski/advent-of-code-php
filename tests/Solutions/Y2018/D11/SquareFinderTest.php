<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D11;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class SquareFinderTest extends TestCase
{
    public static function data(): iterable
    {
        yield [18, 3, Square::of(33, 45, 3, 29)];
        yield [42, 3, Square::of(21, 61, 3, 30)];
        yield [18, null, Square::of(90, 269, 16, 113)];
        yield [42, null, Square::of(232, 251, 12, 119)];
    }

    #[DataProvider('data')]
    public function test(int $serial, ?int $squareSize, Square $expected): void
    {
        if (null === $squareSize && false === in_array('--teamcity', $_SERVER['argv'], true)) {
            $this->markTestSkipped('Expensive test');
        }

        $grid = PowerGrid::of($serial);
        $actual = SquareFinder::of($grid, $squareSize);
        self::assertSame($expected->toArray(), $actual->toArray());
    }
}
