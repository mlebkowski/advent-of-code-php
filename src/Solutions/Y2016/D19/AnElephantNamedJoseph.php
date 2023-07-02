<?php

declare(strict_types=1);

namespace App\Solutions\Y2016\D19;

use App\Aoc\Challenge;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;

/**
 * @implements Solution<AnElephantNamedJosephInput>
 * @see file://var/2016-19.txt
 * @see file://var/2016-19-1-sample.txt
 * @see file://var/2016-19-1-expected.txt
 * @see file://var/2016-19-2-sample.txt
 * @see file://var/2016-19-2-expected.txt
 */
final class AnElephantNamedJoseph implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2016, 19);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): int
    {
        if ($challenge->isPartOne()) {
            return SimpleRules::of($input->numberOfElves);
        }

        return AcrossRules::of($input->numberOfElves);
    }
}
