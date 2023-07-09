<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D19;

use App\Realms\Cartography\Map;
use App\Realms\Cartography\Path;
use App\Realms\Cartography\Point;
use loophp\collection\Collection;

final class LettersAlongPath
{
    private const HighlightColor = "\033[0;31m%s\033[0m";

    public static function of(Map $map, Path $path): string
    {
        $letters = $map->apply(
            static fn (string $value) => ctype_upper($value) ? sprintf(self::HighlightColor, $value) : ' ',
        );

        echo "\n\n", $map->overlayPath($path)->overlay($letters, Point::center()), "\n\n";

        $lookup = $map->withCoordinates()
            ->filter(static fn (string $letter) => ctype_upper($letter))
            ->map(static fn (string $letter, Point $point) => [(string)$point, $letter])
            ->unpack()
            ->all(false);

        return Collection::fromIterable($path->points)
            ->map(static fn (Point $point) => $lookup[(string)$point] ?? null)
            ->filter()
            ->implode();
    }
}
