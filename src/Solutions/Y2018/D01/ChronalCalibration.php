<?php

declare(strict_types=1);

namespace App\Solutions\Y2018\D01;

use App\Aoc\Challenge;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;
use RuntimeException;

/**
 * @implements Solution<ChronalCalibrationInput>
 * @see file://var/2018-1.txt
 * @see file://var/2018-1-1-sample.txt
 * @see file://var/2018-1-1-expected.txt
 * @see file://var/2018-1-2-sample.txt
 * @see file://var/2018-1-2-expected.txt
 */
final class ChronalCalibration implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2018, 1);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): mixed
    {
        if ($challenge->isPartOne()) {
            return array_sum($input->frequencyChanges);
        }

        $sequence = FrequencySequence::ofChanges($input->frequencyChanges);
        $seen = [];
        foreach ($sequence->stream() as $next) {
            if (isset($seen[$next])) {
                return $next;
            }
            $seen[$next] = true;
        }

        throw new RuntimeException('Unsolved');
    }
}
