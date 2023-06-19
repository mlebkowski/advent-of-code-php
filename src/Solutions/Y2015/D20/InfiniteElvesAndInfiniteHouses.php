<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D20;

use App\Aoc\Challenge;
use App\Aoc\Progress\Progress;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;
use loophp\collection\Collection;

/** @implements Solution<InfiniteElvesAndInfiniteHousesInput> */
final class InfiniteElvesAndInfiniteHouses implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2015, 20);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): mixed
    {
        $presentsPerHouse = $challenge->isPartOne() ? 10 : 11;
        $maxHousesPerElf = $challenge->isPartTwo() ? 50 : PHP_INT_MAX;
        $iterationsFraction = $challenge->isPartOne() ? 1.1 : 0.33;

        // dunno why, but I’m guessing I can do that in half iterations:
        $max = (int)($input->presents / $presentsPerHouse / 2);
        // int(1 → n) of n/x dx
        $expectedIterations = (int)($max * log($max) * $iterationsFraction);

        $progress = Progress::ofExpectedIterations($expectedIterations)
            ->reportInSteps(50_000)
            ->withMemoryUsage();

        $houses = Houses::upTo($max);

        $report = static fn (int $elf, int $house) => static fn () => sprintf(
            'Efl %s distributes to house %s',
            number_format($elf, thousands_separator: ' '),
            number_format($house, thousands_separator: ' '),
        );

        $sums = [];
        foreach (Elves::upTo($max) as $elf) {
            foreach ($houses->visit($elf, upTo: $maxHousesPerElf) as $house) {
                $progress->step();
                $progress->report($report($elf, $house));
                $sums[$house] = ($sums[$house] ?? 0) + $elf * $presentsPerHouse;
            }
        }

        return Collection::fromIterable($sums)
            ->filter(static fn (int $presents) => $presents > $input->presents)
            ->keys()
            ->reduce(MinimumHouseNumberStrategy::reduce(...), PHP_INT_MAX);
    }
}
