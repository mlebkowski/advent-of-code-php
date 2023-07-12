<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D11;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class SummedAreaTableTest extends TestCase
{
    public static function data(): iterable
    {
        yield [
            [
                [31, 2, 4, 33, 5, 36],
                [12, 26, 9, 10, 29, 25],
                [13, 17, 21, 22, 20, 18],
                [24, 23, 15, 16, 14, 19],
                [30, 8, 28, 27, 11, 7],
                [1, 35, 34, 3, 32, 6],
            ],
            [
                [31, 33, 37, 70, 75, 111],
                [43, 71, 84, 127, 161, 222],
                [56, 101, 135, 200, 254, 333],
                [80, 148, 197, 278, 346, 444],
                [110, 186, 263, 371, 450, 555],
                [111, 222, 333, 444, 555, 666],
            ],
        ];
    }

    #[DataProvider('data')]
    public function test factory(array $given, array $expected): void
    {
        $sut = SummedAreaTable::of($given);
        $actual = $sut->sums;
        self::assertSame($expected, $actual);
        self::assertSame(111, $sut->sum(2, 3, 3, 2));
    }
}
