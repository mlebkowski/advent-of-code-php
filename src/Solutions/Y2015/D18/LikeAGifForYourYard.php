<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D18;

use App\Aoc\Challenge;
use App\Aoc\Part;
use App\Aoc\Progress\Progress;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;
use loophp\collection\Collection;

/** @implements Solution<LightMatrixInput> */
final class LikeAGifForYourYard implements Solution
{
    private const FirstPartSampleSteps = 4;
    private const SecondPartSampleSteps = 5;
    private const ActualSteps = 100;

    public function challenges(): iterable
    {
        return Challenge::bothParts(2015, 18);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): mixed
    {
        $matrix = $input->matrix;
        $steps = match ($runMode) {
            RunMode::Sample => match ($challenge->part) {
                Part::One => self::FirstPartSampleSteps,
                Part::Two => self::SecondPartSampleSteps,
            },
            RunMode::Actual => self::ActualSteps,
        };

        if ($challenge->isPartTwo()) {
            $matrix = $matrix->withStuckPoints(...$matrix->corners());
        }

        $progress = Progress::ofExpectedIterations($matrix->count() * $steps);
        return Collection::range(0, $steps)
            ->reduce(static fn (LightMatrix $matrix) => $matrix->update($progress), $matrix)
            ->countLightsOn();
    }
}
