<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D15;

use App\Aoc\Challenge;
use App\Aoc\Progress\Progress;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;
use loophp\collection\Collection;

/**
 * @implements Solution<IngredientsInput>
 */
final class ScienceForHungryPeople implements Solution
{
    private const MaxCapacity = 100;
    private const IdealCalories = 500;

    public function challenges(): iterable
    {
        return Challenge::bothParts(2015, 15);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): mixed
    {
        $partitions = Partition::into(self::MaxCapacity, count($input->ingredients));

        $expectedIterations = $this->expectedIterations(count($input->ingredients));

        $caloriesExpectation = $challenge->isPartTwo()
            ? static fn (Score $score) => $score->calories === self::IdealCalories
            : static fn () => true;

        $scoreCounter = new ScoreCounter($input->ingredients);
        $progress = Progress::ofExpectedIterations($expectedIterations);
        return Collection::fromGenerator($partitions)
            ->map($scoreCounter->calculateScore(...))
            ->apply($progress->step(...))
            ->filter($caloriesExpectation)
            ->map(static fn (Score $score) => $score->score)
            ->apply($progress->report(...))
            ->max();
    }

    private function expectedIterations(int $k): int
    {
        return binomialCoefficient(self::MaxCapacity + $k - 1, $k - 1);
    }
}
