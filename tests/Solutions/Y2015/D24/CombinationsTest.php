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
        $sut = Combinations::selectSmallestSetsWithSum(20)->from($given);
        $actual = Collection::fromGenerator($sut)->all();

        self::assertSame([[9, 11]], $actual);
    }
}
