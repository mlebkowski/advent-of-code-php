<?php

declare(strict_types=1);

namespace App\Solutions\Y2018\D04;

use App\Aoc\Challenge;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;

/**
 * @implements Solution<ReposeRecordInput>
 * @see file://var/2018-4.txt
 * @see file://var/2018-4-1-sample.txt
 * @see file://var/2018-4-1-expected.txt
 * @see file://var/2018-4-2-sample.txt
 * @see file://var/2018-4-2-expected.txt
 */
final class ReposeRecord implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2018, 4);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): mixed
    {
        $year = NightBuilder::fromEvents(...$input->eventLog->events);
        echo "\n\n", Visualizer::visualize($year), "\n";

        $selectedGuard = $challenge->isPartOne()
            ? MostSleepyGuardFinder::of($year)
            : MostConsistentSleeperFinder::of($year);

        return $selectedGuard->mostCommonMinute() * $selectedGuard->guardId;
    }
}
