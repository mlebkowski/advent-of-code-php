<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D17;

use App\Aoc\Challenge;
use App\Aoc\Progress;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;
use loophp\collection\Collection;

/** @implements Solution<ContainersInput> */
final class NoSuchThingAsTooMuch implements Solution
{
    private const SampleSize = 25;
    private const Eggnog = 150;

    public function challenges(): iterable
    {
        return Challenge::bothParts(2015, 17);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): mixed
    {
        $containerCount = count($input->sizes);
        $expectedSize = $runMode->isSample() ? self::SampleSize : self::Eggnog;
        $expectedIterations = 2 ** $containerCount;
        $progress = Progress::ofExpectedIterations($expectedIterations);

        return Collection::fromIterable(Variation::withRepetition($input->sizes))
            ->apply($progress->step(...))
            ->map(static fn (array $sizes) => array_sum($sizes))
            ->apply($progress->report(...))
            ->filter(static fn (int $sum) => $sum === $expectedSize)
            ->count();
    }
}
