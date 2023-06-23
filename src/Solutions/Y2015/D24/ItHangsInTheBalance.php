<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D24;

use App\Aoc\Challenge;
use App\Aoc\Progress\Progress;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;
use loophp\collection\Collection;
use loophp\collection\Contract\Operation\Sortable;

/** @implements Solution<ItHangsInTheBalanceInput> */
final class ItHangsInTheBalance implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2015, 24);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): mixed
    {
        $sum = (int)(array_sum($input->weights) / 3);
        $progress = Progress::ofExpectedIterations(300)->withDelay(3_000);

        $gen = Combinations::selectSmallestSetsWithSum($sum)->from($input->weights);

        return Collection::fromGenerator($gen)
            ->apply($progress->step(...))
            ->apply(static fn (array $set) => $progress->report(implode(', ', $set)))
            ->groupBy(static fn (array $set) => count($set))
            ->sort(type: Sortable::BY_KEYS)
            // reset group keys, I want the first one to have index = 0
            ->normalize()
            // now I ungroup, but I also erase any group that is not at index = 0
            // which means that I drop everything but the smallest sets
            ->flatMap(static fn (array $group, int $idx) => $idx ? [] : $group)
            ->map(QuantumEntanglement::of(...))
            ->reduce(LowestValueStrategy::select(...), PHP_FLOAT_MAX);
    }
}
