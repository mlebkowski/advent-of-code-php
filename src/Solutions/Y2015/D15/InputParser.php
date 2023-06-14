<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D15;

final class InputParser
{
    public static function parse(string $input): IngredientsInput
    {
        $knownAttributes = ['capacity', 'durability', 'flavor', 'texture', 'calories'];
        $re = collect($knownAttributes)
            ->map(
                static fn (string $attribute) => sprintf('%1$s (?P<%1$s>-?\d+)', $attribute),
            )
            ->join(', ');

        preg_match_all(
            sprintf('/^(?P<name>\w+): %s$/m', $re),
            $input,
            $matches,
            PREG_SET_ORDER,
        );

        return IngredientsInput::of(
            ...
            collect($matches)
                ->map(
                    static fn (array $ingredient) => collect($ingredient)
                        ->only($knownAttributes)
                        ->map(static fn (string $value) => intval($value))
                        ->toArray(),
                )
                ->map(static fn (array $ingredient) => new Ingredient(...$ingredient))
                ->toArray(),
        );
    }
}
