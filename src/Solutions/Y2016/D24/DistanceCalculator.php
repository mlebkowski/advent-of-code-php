<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D24;

use App\Realms\Cartography\PathFinding;
use App\Realms\Cartography\Point;

final class DistanceCalculator
{
    public static function betweenEachPoint(PathFinding $pathFinding, Point ...$points): array
    {
        $result = [];
        foreach ($points as $alpha) {
            foreach ($points as $bravo) {
                if ($alpha->equals($bravo)) {
                    continue;
                }

                $path = $pathFinding->getPath($alpha, $bravo);
                $result[(string)$alpha][(string)$bravo] = $path;
            }
        }
        return $result;
    }
}
