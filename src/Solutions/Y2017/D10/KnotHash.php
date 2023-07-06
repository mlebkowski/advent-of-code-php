<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D10;

use App\Aoc\Challenge;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;
use App\Realms\Passwords\KnotHashBuilder;
use loophp\collection\Collection;

/**
 * @implements Solution<KnotHashInput>
 * @see file://var/2017-10.txt
 * @see file://var/2017-10-1-sample.txt
 * @see file://var/2017-10-1-expected.txt
 * @see file://var/2017-10-2-sample.txt
 * @see file://var/2017-10-2-expected.txt
 */
final class KnotHash implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2017, 10);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): mixed
    {
        $builder = KnotHashBuilder::standard();

        if ($runMode->isSample()) {
            $builder->withListLength(4);
        }

        $seed = $input->input;
        if ($challenge->isPartOne()) {
            $builder->withoutIterations()->withoutAddedLengths();
            $seed = Collection::fromIterable($input->asIntegers)
                ->map(static fn (int $ord) => chr($ord))
                ->implode();
        }

        $hash = $builder->build($seed);

        if ($challenge->isPartOne()) {
            return $hash->sparseHash[0] * $hash->sparseHash[1];
        }

        return $hash->denseHash;
    }
}
