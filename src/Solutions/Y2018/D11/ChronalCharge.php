<?php

declare(strict_types=1);

namespace App\Solutions\Y2018\D11;

use App\Aoc\Challenge;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;

/**
 * @implements Solution<ChronalChargeInput>
 * @see file://var/2018-11.txt
 * @see file://var/2018-11-1-sample.txt
 * @see file://var/2018-11-1-expected.txt
 * @see file://var/2018-11-2-sample.txt
 * @see file://var/2018-11-2-expected.txt
 */
final class ChronalCharge implements Solution
{
    private const Size = 300;
    private const Square = 3;

    public function challenges(): iterable
    {
        return Challenge::bothParts(2018, 11);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): string
    {
        echo "\n\n", PowerMapFactory::ofSize(100, $input->gridSerialNumber), "\n\n";

        $grid = PowerGrid::of($input->gridSerialNumber);
        $squareSize = $challenge->isPartOne() ? self::Square : null;

        return SquareFinder::of($grid, $squareSize)->id;
    }
}
