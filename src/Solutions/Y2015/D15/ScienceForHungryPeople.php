<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D15;

use App\Aoc\Challenge;
use App\Aoc\Progress;
use App\Aoc\Solution;
use loophp\collection\Collection;

final class ScienceForHungryPeople implements Solution
{
    private const MaxCapacity = 100;

    public function challenges(): iterable
    {
        yield Challenge::of(2015, 15, 1);
    }

    public function solve(Challenge $challenge, string $input): mixed
    {
        $input = InputParser::parse($input);
        $partitions = Partition::into(self::MaxCapacity, count($input->ingredients));

        $expectedIterations = $this->expectedIterations(count($input->ingredients));

        return Collection::fromGenerator($partitions)
            ->map(
                static fn (array $counts) => Collection::fromIterable($counts)
                    ->zip($input->ingredients)
                    ->map(static fn (array $pairs) => IngredientSpoons::fromPairs(...$pairs))
                    ->flatMap(static fn (IngredientSpoons $spoons) => $spoons->values())
                    ->unpack()
                    ->groupBy(static fn (mixed $value, mixed $key) => $key)
                    ->map(static fn (array $values) => max(0, array_sum($values)))
                    ->reduce(static fn (int $product, int $value) => $product * $value, 1),
            )
            ->apply(Progress::ofExpectedIterations($expectedIterations))
            ->max();
    }

    private function expectedIterations(int $k): int
    {
        return binomialCoefficient(self::MaxCapacity + $k - 1, $k - 1);
    }
}
