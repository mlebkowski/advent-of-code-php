<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D17;

final class Variation
{
    public static function withRepetition(array $items): iterable
    {
        if (0 === count($items)) {
            yield [];
            return;
        }

        [$head] = array_splice($items, 0, 1);
        foreach (Variation::withRepetition($items) as $rest) {
            yield $rest;
            yield [...$rest, $head];
        }
    }
}
