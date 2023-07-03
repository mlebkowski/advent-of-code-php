<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D02;

use App\Aoc\Challenge;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;
use App\Lib\Generators\Combination;
use loophp\collection\Collection;

/**
 * @implements Solution<CorruptionChecksumInput>
 * @see file://var/2017-2.txt
 * @see file://var/2017-2-1-sample.txt
 * @see file://var/2017-2-1-expected.txt
 * @see file://var/2017-2-2-sample.txt
 * @see file://var/2017-2-2-expected.txt
 */
final class CorruptionChecksum implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2017, 2);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): mixed
    {
        if ($challenge->isPartOne()) {
            return Collection::fromIterable($input->rows)
                ->map(static fn (array $values) => max(...$values) - min(...$values))
                ->reduce(static fn (int $sum, int $value) => $sum + $value, 0);
        }

        $combination = Combination::takeWithoutRepeats(2);
        return Collection::fromIterable($input->rows)
            ->flatMap($combination->from(...))
            ->flatMap(static fn (array $pair) => [$pair, array_reverse($pair)])
            ->reject(static fn (array $pair) => fmod(...$pair))
            ->map(static fn (array $pair) => intdiv(...$pair))
            ->reduce(static fn (int $sum, int $value) => $sum + $value, 0);
    }
}
