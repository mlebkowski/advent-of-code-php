<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D06;

use loophp\collection\Collection;
use PHPUnit\Framework\TestCase;

final class MemoryAreaTest extends TestCase
{
    public function test memory reallocation(): void
    {
        $sut = MemoryArea::memoryReallocation([0, 2, 7, 0]);
        $actual = Collection::fromGenerator($sut)
            ->limit(5)
            ->all();

        self::assertSame(
            [
                [2, 4, 1, 2],
                [3, 1, 2, 3],
                [0, 2, 3, 4],
                [1, 3, 4, 1],
                [2, 4, 1, 2],
            ],
            $actual,
        );
    }
}
