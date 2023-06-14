<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D15;

use Generator;

final class Partition
{
    /**
     * @return Generator<int[]>
     */
    public static function into(int $size, int $parts): Generator
    {
        assert($parts >= 1, "You need to have a positive number of parts to divide into");

        if ($parts === 1) {
            yield [$size];
            return;
        }

        foreach (range(0, $size) as $bucket) {
            foreach (Partition::into($size - $bucket, $parts - 1) as $partitions) {
                yield [$bucket, ...$partitions];
            }
        }
    }
}
