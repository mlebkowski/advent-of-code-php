<?php

declare(strict_types=1);

namespace App\Solutions\Y2018\D05;

use App\Aoc\Challenge;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;
use loophp\collection\Collection;

/**
 * @implements Solution<AlchemicalReductionInput>
 * @see file://var/2018-5.txt
 * @see file://var/2018-5-1-sample.txt
 * @see file://var/2018-5-1-expected.txt
 * @see file://var/2018-5-2-sample.txt
 * @see file://var/2018-5-2-expected.txt
 */
final class AlchemicalReduction implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2018, 5);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): mixed
    {
        if ($challenge->isPartOne()) {
            return strlen(PolymerReaction::trigger($input->polymer));
        }

        return Collection::fromIterable(ProblematicUnitFinder::of($input->polymer))
            ->map(static fn (string $polymer) => strlen($polymer))
            ->sort(callback: static fn (int $alpha, int $bravo) => $alpha <=> $bravo)
            ->first();
    }
}
