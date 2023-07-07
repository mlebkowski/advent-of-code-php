<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D15;

final class Judge
{
    private const Mask = (1 << 16) - 1;

    public static function bitsMatch(array $values): bool
    {
        assert(2 === count($values));
        [$alpha, $bravo] = $values;
        return ($alpha & self::Mask) === ($bravo & self::Mask);
    }
}
