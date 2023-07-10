<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D24;

use App\Aoc\Challenge;
use App\Aoc\Progress\Progress;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;
use loophp\collection\Collection;

/**
 * @implements Solution<ElectromagneticMoatInput>
 * @see file://var/2017-24.txt
 * @see file://var/2017-24-1-sample.txt
 * @see file://var/2017-24-1-expected.txt
 * @see file://var/2017-24-2-sample.txt
 * @see file://var/2017-24-2-expected.txt
 */
final class ElectromagneticMoat implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2017, 24);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): mixed
    {
        $progress = Progress::ofExpectedIterations(650_000)->reportInSteps(10_000);
        $builder = BridgeBuilder::of(...$input->components);
        return Collection::fromGenerator($builder->build())
            ->map(static fn (Bridge $bridge) => $bridge->strength())
            ->apply($progress->iterate(...))
            ->reduce(StrategyStrongest::reduce(...));
    }
}
