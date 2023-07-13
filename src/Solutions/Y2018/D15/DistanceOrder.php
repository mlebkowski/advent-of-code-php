<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D15;

use App\Realms\Cartography\Point;

final readonly class DistanceOrder
{
    public static function fromUnit(Unit $unit): self
    {
        return new self($unit->position);
    }

    private function __construct(private Point $from)
    {
    }

    public function sort(Unit $alpha, Unit $bravo): int
    {
        return $this->distanceTo($alpha) <=> $this->distanceTo($bravo)
            ?: Point::sortForGrid($alpha->position, $bravo->position);
    }

    private function distanceTo(Unit $alpha): int
    {
        return $alpha->position->distance($this->from)->manhattan;
    }
}
