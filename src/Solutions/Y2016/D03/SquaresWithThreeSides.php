<?php

declare(strict_types=1);

namespace App\Solutions\Y2016\D03;

use App\Aoc\Challenge;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;
use loophp\collection\Collection;

/** @implements Solution<Input\SquaresWithThreeSidesInput> */
final class SquaresWithThreeSides implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2016, 03);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): mixed
    {
        $inColumns = static fn (array $triplet) => Collection::fromIterable($triplet)->transpose();
        $inRows = static fn (array $triplet) => $triplet;
        $readTriplet = $challenge->isPartOne() ? $inRows : $inColumns;

        return Collection::fromIterable($input->triplets)
            ->chunk(3)
            ->flatMap($readTriplet)
            ->map(static fn (array $sides) => Triangle::tryOf(...$sides))
            ->filter()
            ->count();
    }
}
