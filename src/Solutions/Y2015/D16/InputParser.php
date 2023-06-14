<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D16;

use loophp\collection\Collection;

final class InputParser
{
    public static function parse(string $input): array
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

        return Collection::fromIterable($matches)
            ->map(static fn (array $matches) => Sue::of($matches[1], array_slice($matches, 2)))
            ->all();
    }
}
