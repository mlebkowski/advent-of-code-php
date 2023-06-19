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
        $expectedPresents = (int)($input->presents / 10);
        $max = $expectedPresents;
        // int(1 → n) of n/x dx
        $expectedIterations = (int)($expectedPresents * log($expectedPresents) * 1.1);

        $progress = Progress::ofExpectedIterations($expectedIterations)
            ->reportInSteps(100_000)
            ->withMemoryUsage();

        $houses = Houses::upTo($max);

        $report = static fn (int $elf, int $house) => static fn () => sprintf(
            'Efl %s distributes to house %s',
            number_format($elf, thousands_separator: ' '),
            number_format($house, thousands_separator: ' '),
        );

        $sums = [];
        foreach (Elves::upTo($max) as $elf) {
            foreach ($houses->visit($elf) as $house) {
                $progress->step();
                $progress->report($report($elf, $house));
                $sums[$house] = ($sums[$house] ?? 0) + $elf;
            }
        }
        [$house] = Collection::fromIterable($sums)
            ->pack()
            ->find([PHP_INT_MAX], static fn (array $item) => end($item) > $expectedPresents);

        return $house;
    }
}
