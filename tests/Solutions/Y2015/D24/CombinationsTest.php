<?php
declare(strict_types=1);

namespace App\Solutions\Y2015\D24;

use loophp\collection\Collection;
use PHPUnit\Framework\TestCase;

final class CombinationsTest extends TestCase
{
    public function test from sample(): void
    {
        $given = [...range(1, 5), ...range(7, 11)];
        $sut = Combinations::selectSetsWithSum(20)->from($given);
        $actual = Collection::fromGenerator($sut)
            ->map(static fn (array $set) => implode(',', $set))
            ->all();

        self::assertSame(
            [
                '1,2,3,4,10',
                '1,2,3,5,9',
                '1,2,4,5,8',
                '1,2,7,10',
                '1,2,8,9',
                '1,3,4,5,7',
                '1,3,5,11',
                '1,3,7,9',
                '1,4,5,10',
                '1,4,7,8',
                '1,8,11',
                '1,9,10',
                '2,3,4,11',
                '2,3,5,10',
                '2,3,7,8',
                '2,4,5,9',
                '2,7,11',
                '2,8,10',
                '3,4,5,8',
                '3,7,10',
                '3,8,9',
                '4,5,11',
                '4,7,9',
                '5,7,8',
                '9,11',
            ],
            $actual,
        );
    }
}
