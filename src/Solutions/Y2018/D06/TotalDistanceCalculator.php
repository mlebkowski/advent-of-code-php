<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D06;

use App\Realms\Cartography\Point;
use loophp\collection\Collection;

final readonly class TotalDistanceCalculator
{
    public static function of(int $distance, Point ...$points): self
    {
        return new self($distance, $points);
    }

    private function __construct(private int $distance, private array $points)
    {
    }

    public function isWithinTotalDistance(Point $point): bool
    {
        $actual = Collection::fromIterable($this->points)->reduce(
            static fn (int $sum, Point $coordinate) => $sum + $coordinate->distance($point)->manhattan,
            0,
        );

        return $actual < $this->distance;
    }
}
