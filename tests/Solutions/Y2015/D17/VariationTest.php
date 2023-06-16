<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D17;

use PHPUnit\Framework\TestCase;

final class VariationTest extends TestCase
{
    public function test empty set()
    {
        self::assertSame([[]], iterator_to_array(Variation::withRepetition([])));
    }

    public function test one()
    {
        self::assertSame([[], [1]], iterator_to_array(Variation::withRepetition([1])));
    }

    public function test two()
    {
        $input = [1, 2];
        $expected = [
            [],
            [1],
            [2],
            [2, 1],
        ];

        $sut = Variation::withRepetition(...);
        $actual = iterator_to_array($sut($input));
        self::assertSame($expected, $actual);
    }

    public function test permute()
    {
        $input = [1, 2, 3];
        $expected = [
            [],
            [1],
            [2],
            [2, 1],
            [3],
            [3, 1],
            [3, 2],
            [3, 2, 1],
        ];

        $sut = Variation::withRepetition(...);
        $actual = iterator_to_array($sut($input));
        self::assertSame($expected, $actual);
    }
}
