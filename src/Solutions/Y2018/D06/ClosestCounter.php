<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D06;

use App\Realms\Cartography\Point;
use loophp\collection\Collection;
use loophp\collection\Contract\Operation\Sortable;

final readonly class ClosestCounter
{
    public static function of(Collection $points): self
    {
        return new self($points);
    }

    private function __construct(private Collection $points)
    {
    }

    public function getClosest(string $value, Point $point): string
    {
        [$distance, $closest] = $this->points
            ->groupBy(static fn ($value, Point $coordinate) => $coordinate->distance($point)->manhattan)
            ->sort(type: Sortable::BY_KEYS)
            ->pack()
            ->first();

        if ($distance === 0) {
            return $value;
        }

        if (count($closest) > 1) {
            return '.';
        }

        return strtolower(end($closest));
    }
}
