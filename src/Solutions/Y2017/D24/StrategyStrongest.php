<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D24;

final class StrategyStrongest
{
    public static function reduce(?int $strongest, int $strength)
    {
        return max($strongest ?? 0, $strength);
    }
}
