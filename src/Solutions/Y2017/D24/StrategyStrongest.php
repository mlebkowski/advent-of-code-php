<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D24;

final class StrategyStrongest
{
    public static function of(): self
    {
        return new self();
    }

    public function reduce(?int $strongest, Bridge $bridge): int
    {
        return max($strongest ?? 0, $bridge->strength());
    }
}
