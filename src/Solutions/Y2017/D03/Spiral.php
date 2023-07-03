<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D03;

final class Spiral
{
    public static function findDistanceToCenter(int $n): int
    {
        if ($n <= 1) {
            return 0;
        }

        $sideLength = ceil(sqrt($n)) | 1;
        $cornerValue = $sideLength ** 2;
        $ringNumber = ($sideLength - 1) / 2;
        $distanceToBottomRightCorner = $cornerValue - $n;
        $distanceBetweenCorners = $sideLength - 1;
        $distanceToNextCorner = $distanceToBottomRightCorner % $distanceBetweenCorners;
        $distanceToEdgeCenter = $distanceToNextCorner - $distanceBetweenCorners / 2;

        return $ringNumber + abs($distanceToEdgeCenter);
    }
}
