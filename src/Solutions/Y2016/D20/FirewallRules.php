<?php

declare(strict_types=1);

namespace App\Solutions\Y2016\D20;

use App\Aoc\Challenge;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;
use loophp\collection\Collection;

/**
 * @implements Solution<FirewallRulesInput>
 * @see file://var/2016-20.txt
 * @see file://var/2016-20-1-sample.txt
 * @see file://var/2016-20-1-expected.txt
 * @see file://var/2016-20-2-sample.txt
 * @see file://var/2016-20-2-expected.txt
 */
final class FirewallRules implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2016, 20);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): mixed
    {
        return Collection::fromIterable($input->ranges)
            ->sort(callback: Range::lowest(...))
            ->reduce(
                static fn (int $min, Range $range) => $range->blocks($min) ? $range->max + 1 : $min,
                0,
            );
    }
}
