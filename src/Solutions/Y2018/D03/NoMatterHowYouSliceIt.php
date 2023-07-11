<?php

declare(strict_types=1);

namespace App\Solutions\Y2018\D03;

use App\Aoc\Challenge;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;
use loophp\collection\Collection;

/**
 * @implements Solution<NoMatterHowYouSliceItInput>
 * @see file://var/2018-3.txt
 * @see file://var/2018-3-1-sample.txt
 * @see file://var/2018-3-1-expected.txt
 * @see file://var/2018-3-2-sample.txt
 * @see file://var/2018-3-2-expected.txt
 */
final class NoMatterHowYouSliceIt implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2018, 3);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): mixed
    {
        $map = [];

        foreach ($input->claims as $claim) {
            for ($x = $claim->area->minCorner->x; $x <= $claim->area->maxCorner->x; $x++) {
                for ($y = $claim->area->minCorner->y; $y <= $claim->area->maxCorner->y; $y++) {
                    $map[$x][$y] = ($map[$x][$y] ?? 0) + 1;
                }
            }
        }

        return Collection::fromIterable($map)
            ->flatten()
            ->filter(static fn (int $claims) => $claims > 1)
            ->count();
    }
}
