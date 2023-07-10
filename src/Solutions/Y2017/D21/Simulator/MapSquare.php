<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D21\Simulator;

use App\Realms\Cartography\Area;
use App\Realms\Cartography\Map;
use App\Realms\Cartography\Point;

final readonly class MapSquare
{
    public static function fromTiles(Map $map): array
    {
        assert($map->width === $map->height);
        assert($map->width === 9);
        // I could not be bothered to iterate:
        return [
            self::of($map->cutOut(Area::covering(Point::of(0, 0), Point::of(2, 2)))),
            self::of($map->cutOut(Area::covering(Point::of(3, 0), Point::of(5, 2)))),
            self::of($map->cutOut(Area::covering(Point::of(6, 0), Point::of(8, 2)))),
            self::of($map->cutOut(Area::covering(Point::of(0, 3), Point::of(2, 5)))),
            self::of($map->cutOut(Area::covering(Point::of(3, 3), Point::of(5, 5)))),
            self::of($map->cutOut(Area::covering(Point::of(6, 3), Point::of(8, 5)))),
            self::of($map->cutOut(Area::covering(Point::of(0, 6), Point::of(2, 8)))),
            self::of($map->cutOut(Area::covering(Point::of(3, 6), Point::of(5, 8)))),
            self::of($map->cutOut(Area::covering(Point::of(6, 6), Point::of(8, 8)))),
        ];
    }

    public static function of(Map $map): self
    {
        assert($map->width === $map->height);
        assert($map->width === 3);

        $id = bindec(strtr((string)$map, ['.' => '0', '#' => 1, "\n" => ""]));
        $pixels = substr_count((string)$map, '#');

        return new self($id, $map, $pixels);
    }

    private function __construct(public int $id, public Map $map, public int $pixels)
    {
    }
}
