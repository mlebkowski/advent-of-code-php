<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D03;

use App\Aoc\Challenge;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;
use App\Solutions\Y2017\D03\Builder\SpiralBuilder;
use loophp\collection\Collection;

/**
 * @implements Solution<SpiralMemoryInput>
 * @see file://var/2017-3.txt
 * @see file://var/2017-3-1-sample.txt
 * @see file://var/2017-3-1-expected.txt
 * @see file://var/2017-3-2-sample.txt
 * @see file://var/2017-3-2-expected.txt
 */
final class SpiralMemory implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2017, 3);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): mixed
    {
        if ($challenge->isPartOne()) {
            return Spiral::findDistanceToCenter($input->number);
        }

        return Collection::fromGenerator(SpiralBuilder::adjacent())
            ->find(callbacks: static fn (int $value) => $value > $input->number);
    }
}
