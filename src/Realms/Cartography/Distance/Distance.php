<?php
declare(strict_types=1);

namespace App\Realms\Cartography\Distance;

use App\Realms\Cartography\Point;

final readonly class Distance
{
    public static function between(Point $alpha, Point $bravo): self
    {
        $manhattan = abs($alpha->x - $bravo->x) + abs($alpha->y - $bravo->y);
        $euclidean = sqrt(($alpha->x - $bravo->x) ** 2 + ($alpha->y - $bravo->y) ** 2);

        return new self($manhattan, $euclidean);
    }

    private function __construct(public int $manhattan, public float $euclidean)
    {
    }
}
