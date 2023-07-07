<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D14;

use App\Realms\Cartography\Map;
use App\Realms\Cartography\Point;
use Generator;
use loophp\collection\Collection;
use RuntimeException;

final class OrthogonallyConnectedGroupFinder
{
    /**
     * @return Generator<int, Map, null, Map>
     */
    public static function find(Map $map, Point $start): Generator
    {
        $source = $map->withCoordinates()
            ->map(static fn ($value, Point $point) => [(string)$point, $value])
            ->unpack()
            ->all(false);

        $groupValue = $source[(string)$start] ?? throw new RuntimeException('No point, no group, no cookie');

        $seen = array_map(static fn () => ' ', $source);
        $seen[(string)$start] = $groupValue;

        yield self::mapOfSeen($seen, $map->width);

        $pointIsPartOfGroup = static fn (Point $point) => $groupValue === ($source[(string)$point] ?? null);
        $pointAlreadySeen = static function (Point $point) use (&$seen) {
            return ' ' !== $seen[(string)$point];
        };
        $toExplore = Collection::fromIterable($start->orthogonallyAdjacent())->filter($pointIsPartOfGroup);

        while ($toExplore->isNotEmpty()) {
            foreach ($toExplore as $point) {
                $seen[(string)$point] = $groupValue;
            }

            yield self::mapOfSeen($seen, $map->width);

            $toExplore = $toExplore
                ->flatMap(static fn (Point $point) => $point->orthogonallyAdjacent())
                ->filter($pointIsPartOfGroup)
                ->reject($pointAlreadySeen)
                ->squash();
        }

        return self::mapOfSeen($seen, $map->width);
    }

    private static function mapOfSeen(array $seen, int $width): Map
    {
        return Map::ofPoints(array_values($seen), $width);
    }
}
