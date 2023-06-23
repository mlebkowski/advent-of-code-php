<?php
declare(strict_types=1);

namespace App\Solutions\Y2015\D24;

final class QuantumEntanglement
{
    public static function of(array $presents): float
    {
        return array_reduce(
            $presents,
            static fn (float $product, int $weight) => $product * $weight,
            1,
        );
    }
}
