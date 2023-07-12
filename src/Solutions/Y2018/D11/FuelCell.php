<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D11;

use App\Realms\Cartography\Point;

final readonly class FuelCell
{
    public static function powerLevel(Point $coordinate, int $gridSerialNumber): int
    {
        $rackId = $coordinate->x + 10;
        $level = $rackId * $coordinate->y;
        $level += $gridSerialNumber;
        $level *= $rackId;
        $level /= 100;
        return (int)$level % 10 - 5;
    }
}
