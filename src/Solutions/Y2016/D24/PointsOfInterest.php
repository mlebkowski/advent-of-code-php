<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D24;

use App\Realms\Cartography\Map;
use loophp\collection\Collection;

final class PointsOfInterest
{
    public static function fromMap(Map $map): array
    {
        return Collection::fromIterable($map->withCoordinates())
            ->filter(static fn (string $point) => ctype_digit($point))
            ->sort()
            ->keys()
            ->all();
    }
}
