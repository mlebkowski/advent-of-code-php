<?php

declare(strict_types=1);

namespace App\Solutions\Y2016\D22;

use App\Aoc\Challenge;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;
use loophp\collection\Collection;

/**
 * @implements Solution<GridComputingInput>
 * @see file://var/2016-22.txt
 * @see file://var/2016-22-1-sample.txt
 * @see file://var/2016-22-1-expected.txt
 * @see file://var/2016-22-2-sample.txt
 * @see file://var/2016-22-2-expected.txt
 */
final class GridComputing implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2016, 22);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): mixed
    {
        return Collection::fromIterable($input->nodes)
            ->product($input->nodes)
            ->unpack()
            ->filter(Node::isViablePair(...))
            ->count();
    }
}
