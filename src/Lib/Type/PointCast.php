<?php
declare(strict_types=1);

namespace App\Lib\Type;

use App\Realms\Cartography\Point;

final readonly class PointCast
{
    public static function toX(Point $point): int
    {
        return $point->x;
    }

    public static function toY(Point $point): int
    {
        return $point->y;
    }
}
