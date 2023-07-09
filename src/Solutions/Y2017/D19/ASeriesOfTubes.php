<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D19;

use App\Aoc\Challenge;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;

/**
 * @implements Solution<ASeriesOfTubesInput>
 * @see file://var/2017-19.txt
 * @see file://var/2017-19-1-sample.txt
 * @see file://var/2017-19-1-expected.txt
 * @see file://var/2017-19-2-sample.txt
 * @see file://var/2017-19-2-expected.txt
 */
final class ASeriesOfTubes implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2017, 19);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): string|int
    {
        $path = PathFactory::of($input->map)->fromShittyLineDrawing();
        if ($challenge->isPartOne()) {
            return LettersAlongPath::of($input->map, $path);
        }

        return $path->steps() + 1;
    }
}
