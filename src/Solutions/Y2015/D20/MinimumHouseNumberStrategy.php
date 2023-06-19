<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D20;

final class MinimumHouseNumberStrategy
{
    public static function reduce(int $min, int $houseNumber): int
    {
        return min($min, $houseNumber);
    }
}
