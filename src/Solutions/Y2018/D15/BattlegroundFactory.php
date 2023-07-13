<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D15;

use App\Realms\Cartography\Map;
use App\Realms\Cartography\Point;

final readonly class BattlegroundFactory
{
    public static function create(Map $map): Battleground
    {
        $units = $map->withCoordinates()
            ->map(static fn (string $item) => Faction::tryFrom($item))
            ->filter()
            ->map(static fn (Faction $faction, Point $point) => Unit::of($point, $faction))
            ->all();

        $map = $map
            ->apply(static fn (string $item) => match ($item) {
                'G', 'E', '.' => ' ',
                '#' => '#',
                default => $item,
            });
        return Battleground::of($map, ...$units);
    }
}
