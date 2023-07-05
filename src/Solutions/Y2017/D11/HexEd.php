<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D11;

use App\Aoc\Challenge;
use App\Aoc\Progress\Progress;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;
use loophp\collection\Collection;

/**
 * @implements Solution<HexEdInput>
 * @see file://var/2017-11.txt
 * @see file://var/2017-11-1-sample.txt
 * @see file://var/2017-11-1-expected.txt
 * @see file://var/2017-11-2-sample.txt
 * @see file://var/2017-11-2-expected.txt
 */
final class HexEd implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2017, 11);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): mixed
    {
        $path = StepCounter::count(...$input->directions);

        if ($challenge->isPartOne()) {
            iterator_to_array($path);
            return $path->getReturn();
        }

        $progress = Progress::ofExpectedIterations(count($input->directions));
        return Collection::fromGenerator($path)
            ->apply($progress->iterate(...))
            ->max();
    }
}
