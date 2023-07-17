<?php

declare(strict_types=1);

namespace App\Solutions\Y2018\D18;

use App\Aoc\Challenge;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;

/**
 * @implements Solution<SettlersOfTheNorthPoleInput>
 * @see file://var/2018-18.txt
 * @see file://var/2018-18-1-sample.txt
 * @see file://var/2018-18-1-expected.txt
 * @see file://var/2018-18-2-sample.txt
 * @see file://var/2018-18-2-expected.txt
 */
final class SettlersOfTheNorthPole implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2018, 18);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): int
    {
        $days = 10;
        $project = ConstructionProject::ofMap($input->map);
        while ($days-- > 0) {
            $project = $project->step();
        }

        return $project->resourceValue();
    }
}
