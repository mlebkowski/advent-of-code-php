<?php
declare(strict_types=1);

namespace App\Solutions\Y2015\D24;

final class LowestValueStrategy
{
    public static function select(float $result, float $qe)
    {
        return min($qe, $result);
    }
}
