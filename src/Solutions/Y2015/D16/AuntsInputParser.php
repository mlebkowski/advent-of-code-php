<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D16;

use App\Aoc\Runner\InputParser;
use loophp\collection\Collection;

/** @implements InputParser<AuntsInput> */
final class AuntsInputParser implements InputParser
{
    public function parse(string $input): object
    {
        $attributes = Collection::fromIterable(Attribute::cases())
            ->map(static fn (Attribute $attribute) => $attribute->value)
            ->implode('|');

        $re = Collection::fromIterable(range(1, 3))
            ->map(static fn () => "($attributes): (\\d+)")
            ->implode(', ');

        preg_match_all(
            "/^Sue (\\d+): {$re}$/m",
            $input,
            $matches,
            PREG_SET_ORDER,
        );

        return new AuntsInput(
            Collection::fromIterable($matches)
                ->map(static fn (array $matches) => Sue::of($matches[1], array_slice($matches, 2)))
                ->all(),
        );
    }
}
