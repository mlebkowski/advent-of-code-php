<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D24;

use App\Realms\Cartography\Map;
use App\Realms\Cartography\Point;
use loophp\collection\Collection;

final class PointsOfInterest
{
    public static function fromMap(Map $map): array
    {
        return Collection::fromIterable($map->map)
            ->filter(static fn (string $point) => ctype_digit($point))
            ->sort()
            ->map(static fn (string $point, int $idx) => Point::of(
                x: $idx % $map->width,
                y: (int)floor($idx / $map->width),
            ))
            ->all();
    }
}
