<?php

declare(strict_types=1);

namespace App\Lib\Generators;

use Generator;
use loophp\collection\Collection;

final class Product
{
    public static function ofGenerators(Generator ...$iterators): Generator
    {
        return self::ofIterables(
            ...
            Collection::fromIterable($iterators)
                ->map(Collection::fromGenerator(...))
                ->map(static fn (Collection $collection) => $collection->all())
                ->all(),
        );
    }

    public static function ofIterables(iterable ...$iterables): Generator
    {
        if (0 === count($iterables)) {
            yield [];
            return;
        }

        $current = array_shift($iterables);
        foreach ($current as $values) {
            foreach (self::ofIterables(...$iterables) as $other) {
                yield [...$values, ...$other];
            }
        }
    }
}
