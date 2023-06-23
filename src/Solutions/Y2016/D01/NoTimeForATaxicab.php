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
        $path = Path::of(...$input->instructions);
        echo "\n", $path->map, "\n";

        $position = $challenge->isPartOne() ? $path->lastPosition : $path->firstIntersection;
        return $position->distanceFromStart();
    }
}
