<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D15;

use App\Realms\Cartography\Point;

final readonly class ReadingOrder
{
    public static function sort(Unit $alpha, Unit $bravo): int
    {
        return Point::sortForGrid($alpha->position, $bravo->position);
    }
}
