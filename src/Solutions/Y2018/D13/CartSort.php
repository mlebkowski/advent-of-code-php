<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D13;

use App\Realms\Cartography\Point;

final readonly class CartSort
{
    public static function byMovementOrder(Cart $alpha, Cart $bravo): int
    {
        return Point::sortForGrid($alpha->position, $bravo->position);
    }
}
