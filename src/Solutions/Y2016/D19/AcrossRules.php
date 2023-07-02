<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D19;

final class AcrossRules
{
    public static function of(int $numberOfElves): int
    {
        assert($numberOfElves > 1);

        $power = (int)ceil(log($numberOfElves, 3)) - 1;
        $index = $numberOfElves - pow(3, $power);

        $regionSize = pow(3, $power + 1) - pow(3, $power);
        $halfPoint = $regionSize / 2;
        if ($index <= $halfPoint) {
            return $index;
        }

        $index -= $halfPoint;
        return $halfPoint + $index * 2;
    }
}
