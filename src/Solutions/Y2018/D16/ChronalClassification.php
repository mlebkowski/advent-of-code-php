<?php

declare(strict_types=1);

namespace App\Solutions\Y2018\D16;

use App\Aoc\Challenge;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;
use App\Lib\Filters\Number;
use App\Solutions\Y2018\D16\Instructions\D16Instruction;
use App\Solutions\Y2018\D16\Testers\ObservationTester;
use loophp\collection\Collection;

/**
 * @implements Solution<ChronalClassificationInput>
 * @see file://var/2018-16.txt
 * @see file://var/2018-16-1-sample.txt
 * @see file://var/2018-16-1-expected.txt
 * @see file://var/2018-16-2-sample.txt
 * @see file://var/2018-16-2-expected.txt
 */
final class ChronalClassification implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2018, 16);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): mixed
    {
        if ($challenge->isPartOne()) {
            return Collection::fromIterable($input->observations)
                ->map(ObservationTester::count(...))
                ->filter(Number::greaterThanOrEqual(3))
                ->count();
        }

        $resolver = OpcodeResolver::of(...$input->observations);
        $instructions = array_map($resolver->resolve(...), $input->calls);

        return array_reduce(
            $instructions,
            static fn (RegisterSet $input, D16Instruction $instruction) => $instruction->call($input),
            RegisterSet::empty(),
        )->alpha;
    }
}
