<?php

declare(strict_types=1);

namespace App\Solutions\Y2016\D13;

use App\Aoc\Challenge;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;

/** @implements Solution<AMazeOfTwistyLittleCubiclesInput> */
final class AMazeOfTwistyLittleCubicles implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2016, 13);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): mixed
    {
        $width = 32;
        $builder = CoordinateBuilder::of($input->designersFavouriteNumber, $width);
        return Maze::ofMagicNumber($builder, width: $width, height: 40);
    }
}
