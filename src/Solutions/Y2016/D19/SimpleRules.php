<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D19;

final class SimpleRules
{
    public static function of(int $numberOfElves): int
    {
        assert($numberOfElves > 1);
        return 1 + (self::clearMostSignificantBit($numberOfElves) << 1);
    }

    private static function clearMostSignificantBit(float $n): int
    {
        assert($n < 2 ** 32);
        $mask = $n;
        $mask |= $mask >> 1;
        $mask |= $mask >> 2;
        $mask |= $mask >> 4;
        $mask |= $mask >> 16;

        $mask >>= 1;
        return $n & $mask;
    }
}
