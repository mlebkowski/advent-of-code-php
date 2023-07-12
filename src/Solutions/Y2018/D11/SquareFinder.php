<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D11;

use App\Lib\Type\Cast;
use App\Realms\Cartography\Point;
use loophp\collection\Collection;

final class SquareFinder
{
    public static function of(int $gridSize, int $squareSize, int $serialNumber): Square
    {
        return Collection::range(1, $gridSize, 1)
            ->map(Cast::toInt(...))
            ->product(Collection::range(1, $gridSize, 1)->map(Cast::toInt(...)))
            ->map(static fn (array $xy) => Square::of(
                $squareSize,
                Point::of(...$xy),
                $serialNumber,
            ))
            ->sort(callback: Square::sortLargestTotalPower(...))
            ->first();
    }
}
