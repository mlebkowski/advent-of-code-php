<?php

declare(strict_types=1);

namespace App\Solutions\Y2018\D02;

use App\Aoc\Challenge;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;
use loophp\collection\Collection;
use RuntimeException;

/**
 * @implements Solution<InventoryManagementSystemInput>
 * @see file://var/2018-2.txt
 * @see file://var/2018-2-1-sample.txt
 * @see file://var/2018-2-1-expected.txt
 * @see file://var/2018-2-2-sample.txt
 * @see file://var/2018-2-2-expected.txt
 */
final class InventoryManagementSystem implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2018, 2);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): string|int
    {
        $boxes = Boxes::of(...$input->ids);

        if ($challenge->isPartOne()) {
            return $boxes->count(2) * $boxes->count(3);
        }

        foreach (range(0, 25) as $idx) {
            $duplicate = Collection::fromIterable($boxes->withoutNthLetter($idx))
                ->duplicate()
                ->first();
            if ($duplicate) {
                return $duplicate;
            }
        }

        throw new RuntimeException('No duplicates found');
    }
}
