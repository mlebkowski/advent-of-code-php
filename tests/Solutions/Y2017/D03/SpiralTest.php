<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D03;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class SpiralTest extends TestCase
{
    public static function data(): iterable
    {
        yield [1, 0];
        yield [2, 1];
        yield [3, 2];
        yield [4, 1];
        yield [5, 2];
        yield [6, 1];
        yield [7, 2];
        yield [8, 1];
        yield [9, 2];
        yield [10, 3];
        yield [11, 2];
        yield [12, 3];
        yield [13, 4];
        yield [14, 3];
        yield [15, 2];
        yield [16, 3];
        yield [17, 4];
        yield [18, 3];
        yield [19, 2];
        yield [20, 3];
        yield [21, 4];
        yield [22, 3];
        yield [23, 2];
        yield [24, 3];
        yield [25, 4];
        yield [1024, 31];
    }

    #[DataProvider('data')]
    public function test(int $n, int $expected): void
    {
        self::assertSame($expected, Spiral::findDistanceToCenter($n));
    }
}
