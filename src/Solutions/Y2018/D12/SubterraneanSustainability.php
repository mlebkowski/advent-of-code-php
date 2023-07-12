<?php

declare(strict_types=1);

namespace App\Solutions\Y2018\D12;

use App\Aoc\Challenge;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;

/**
 * @implements Solution<SubterraneanSustainabilityInput>
 * @see file://var/2018-12.txt
 * @see file://var/2018-12-1-sample.txt
 * @see file://var/2018-12-1-expected.txt
 * @see file://var/2018-12-2-sample.txt
 * @see file://var/2018-12-2-expected.txt
 */
final class SubterraneanSustainability implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2018, 12);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): int
    {
        $population = $input->population;
        $generations = 20;
        while ($generations-- > 0) {
            $population = $population->step();
        }

        if ($challenge->isPartOne()) {
            return $population->magicNumber();
        }

        $generations = 180;
        while ($generations-- > 0) {
            $population = $population->step();
        }

        $delta = $population->step()->magicNumber() - $population->magicNumber();
        return $population->magicNumber() + $delta * (50_000_000_000 - 200);
    }
}
