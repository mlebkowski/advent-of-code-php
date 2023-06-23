<?php
declare(strict_types=1);

namespace App\Solutions\Y2015\D25;

final class TriangularNumber
{
    public static function for(int $n): int
    {
        return array_sum(range(1, $n));
    }
}
