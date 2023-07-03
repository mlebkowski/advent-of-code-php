<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D06;

use App\Aoc\Challenge;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;

/**
 * @implements Solution<MemoryReallocationInput>
 * @see file://var/2017-6.txt
 * @see file://var/2017-6-1-sample.txt
 * @see file://var/2017-6-1-expected.txt
 * @see file://var/2017-6-2-sample.txt
 * @see file://var/2017-6-2-expected.txt
 */
final class MemoryReallocation implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2017, 6);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): mixed
    {
        $seen = [];
        $i = 0;
        foreach (MemoryArea::memoryReallocation($input->memoryBanks) as $reallocation) {
            $key = implode(',', $reallocation);
            if (isset($seen[$key])) {
                return count($seen) + 1 - ($challenge->isPartTwo() ? $seen[$key] : 0);
            }
            $seen[$key] = ++$i;
        }
        return null;
    }
}
