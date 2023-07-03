<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D15;

use App\Aoc\Runner\InputParser;
use loophp\collection\Collection;

/** @implements InputParser<IngredientsInput> */
final class IngredientsInputParser implements InputParser
{
    public function parse(string $input): IngredientsInput
    {
        $knownAttributes = ['capacity', 'durability', 'flavor', 'texture', 'calories'];
        $re = Collection::fromIterable($knownAttributes)
            ->map(
                static fn (string $attribute) => sprintf('%1$s (?P<%1$s>-?\d+)', $attribute),
            )
            ->implode(', ');

        preg_match_all(
            sprintf('/^(?P<name>\w+): %s$/m', $re),
            $input,
            $matches,
            PREG_SET_ORDER,
        );

        return IngredientsInput::of(
            ...
            Collection::fromIterable($matches)
                ->map(
                    static fn (array $ingredient) => Collection::fromIterable($ingredient)
                        ->filter(
                            static fn ($value, string|int $key) => in_array(
                                $key,
                                $knownAttributes,
                                true,
                            ),
                        )
                        ->map(static fn (string $value) => intval($value))
                        ->all(false),
                )
                ->map(static fn (array $ingredient) => new Ingredient(...$ingredient))
                ->all(),
        );
    }
}
