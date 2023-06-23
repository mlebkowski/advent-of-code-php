<?php

declare(strict_types=1);

namespace App\Solutions\Y2016\D01;

use App\Aoc\Challenge;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;

/** @implements Solution<Input\NoTimeForATaxicabInput> */
final class NoTimeForATaxicab implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2016, 1);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): int
    {
        $x = 0;
        $y = 0;
        $orientation = Orientation::North;

        foreach ($input->instructions as $instruction) {
            $orientation = $orientation->turn($instruction->turn);
            $x += $instruction->distance * $orientation->xMultiplier();
            $y += $instruction->distance * $orientation->yMultiplier();
        }

        return abs($x) + abs($y);
    }
}
