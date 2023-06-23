<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D24;

use App\Aoc\Challenge;
use App\Aoc\Progress\Progress;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;
use loophp\collection\Collection;

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
        $progress = Progress::ofExpectedIterations(216_000)->reportInSteps(1_000);

        $gen = Combinations::selectSetsWithSum($sum)->from($input->weights);
        return Collection::fromGenerator($gen)
            ->apply($progress->step(...))
            ->map(static fn (array $set) => implode(', ', $set))
            ->apply($progress->report(...))
            ->last()[0];
    }
}
