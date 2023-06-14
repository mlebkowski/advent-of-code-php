<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D15;

use loophp\collection\Collection;

final class ScoreCounter
{
    public function __construct(private readonly array $ingredients)
    {
    }

    public function calculateScore(array $counts): Score
    {
        assert(count($counts) === count($this->ingredients), 'Count for each ingredient is required');

        $attributes = Collection::fromIterable($counts)
            ->zip($this->ingredients)
            ->map(static fn (array $pairs) => IngredientSpoons::fromPairs(...$pairs))
            ->flatMap(static fn (IngredientSpoons $spoons) => $spoons->values())
            ->unpack()
            ->groupBy(static fn (mixed $value, mixed $key) => $key)
            ->map(static fn (array $values) => max(0, array_sum($values)))
            ->all(false);

        return Score::ofAttributes(...$attributes);
    }
}
