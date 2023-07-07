<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D15;

use App\Aoc\Challenge;
use App\Aoc\Progress\Progress;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;
use loophp\collection\Collection;

/**
 * @implements Solution<DuelingGeneratorsInput>
 * @see file://var/2017-15.txt
 * @see file://var/2017-15-1-sample.txt
 * @see file://var/2017-15-1-expected.txt
 * @see file://var/2017-15-2-sample.txt
 * @see file://var/2017-15-2-expected.txt
 */
final class DuelingGenerators implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2017, 15);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): mixed
    {
        $iterations = $challenge->isPartOne() ? 40_000_000 : 5_000_000;
        $picky = $challenge->isPartTwo();
        $progress = Progress::ofExpectedIterations($iterations)->reportInSteps(100_000);
        return Collection::fromIterable($input->generators[0]->generate(picky: $picky))
            ->zip($input->generators[1]->generate(picky: $picky))
            ->apply(static fn (array $values) => $progress->iterate(implode(',', $values)))
            ->limit($iterations)
            ->filter(Judge::bitsMatch(...))
            ->count();
    }
}
