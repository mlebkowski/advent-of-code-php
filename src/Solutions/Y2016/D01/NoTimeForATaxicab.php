<?php

declare(strict_types=1);

namespace App\Solutions\Y2016\D01;

use App\Aoc\Challenge;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;
use App\Realms\Cartography\Path;
use App\Realms\Cartography\Point;

/** @implements Solution<NoTimeForATaxicabInput> */
final class NoTimeForATaxicab implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2016, 1);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): int
    {
        $path = Path::ofInstructions(...$input->instructions);
        echo "\n", $path->toMap(), "\n";

        $position = $challenge->isPartOne() ? $path->lastPosition : $path->firstIntersection;
        return $position->distance(Point::center())->manhattan;
    }
}
