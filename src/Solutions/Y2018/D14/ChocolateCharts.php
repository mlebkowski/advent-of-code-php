<?php

declare(strict_types=1);

namespace App\Solutions\Y2018\D14;

use App\Aoc\Challenge;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;

/**
 * @implements Solution<ChocolateChartsInput>
 * @see file://var/2018-14.txt
 * @see file://var/2018-14-1-sample.txt
 * @see file://var/2018-14-1-expected.txt
 * @see file://var/2018-14-2-sample.txt
 * @see file://var/2018-14-2-expected.txt
 */
final class ChocolateCharts implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2018, 14);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): mixed
    {
        $counter = ScoreCounter::of(2, [3, 7]);
        return $counter->count($input->count);
    }
}
