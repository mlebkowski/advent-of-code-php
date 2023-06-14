<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D15;

use PHPUnit\Framework\TestCase;

final class PartitionTest extends TestCase
{
    public function test into two(): void
    {
        $sut = Partition::into(...);

        $actual = iterator_to_array($sut(5, 2));

        self::assertSame([
            [0, 5],
            [1, 4],
            [2, 3],
            [3, 2],
            [4, 1],
            [5, 0],
        ], $actual);
    }

    public function test into three(): void
    {
        $sut = Partition::into(...);

        $actual = iterator_to_array($sut(4, 3));

        self::assertSame([
            [0, 0, 4],
            [0, 1, 3],
            [0, 2, 2],
            [0, 3, 1],
            [0, 4, 0],
            [1, 0, 3],
            [1, 1, 2],
            [1, 2, 1],
            [1, 3, 0],
            [2, 0, 2],
            [2, 1, 1],
            [2, 2, 0],
            [3, 0, 1],
            [3, 1, 0],
            [4, 0, 0],
        ], $actual);
    }

    public function test into hundred(): void
    {
        $sut = Partition::into(...);

        $count = 0;
        foreach ($sut(100, 4) as $_) {
            $count++;
        }

        self::assertSame(176851, $count);
    }

    public function test partition zero(): void
    {
        $sut = Partition::into(...);

        $actual = iterator_to_array($sut(0, 3));

        self::assertSame([[0, 0, 0]], $actual);
    }
}
