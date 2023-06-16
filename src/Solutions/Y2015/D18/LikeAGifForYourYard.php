<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D18;

use App\Aoc\Challenge;
use App\Aoc\Progress;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;
use loophp\collection\Collection;

/** @implements Solution<LightMatrixInput> */
final class LikeAGifForYourYard implements Solution
{
    private const SampleSteps = 4;
    private const ActualSteps = 100;

    public function challenges(): iterable
    {
        return Challenge::bothParts(2015, 18);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): mixed
    {
        $steps = $runMode->isSample() ? self::SampleSteps : self::ActualSteps;
        $progress = Progress::ofExpectedIterations($steps ^ 2);
        return Collection::range(1, $steps)
            ->reduce(static fn (LightMatrix $matrix) => $matrix->update($progress), $input->matrix)
            ->countLightsOn();
    }
}
