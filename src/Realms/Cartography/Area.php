<?php

declare(strict_types=1);

namespace App\Realms\Cartography;

use App\Lib\Type\Cast;
use Stringable;

final readonly class Area implements Stringable
{
    public static function covering(Point ...$points): self
    {
        $xValues = array_map(Cast::point()::toX(...), $points);
        $yValues = array_map(Cast::point()::toY(...), $points);

        $minX = min($xValues);
        $minY = min($yValues);
        $maxX = max($xValues);
        $maxY = max($yValues);

        return new self(Point::of($minX, $minY), Point::of($maxX, $maxY));
    }

    private function __construct(public Point $minCorner, public Point $maxCorner)
    {
        assert($this->minCorner->x <= $maxCorner->x);
        assert($this->minCorner->y <= $maxCorner->y);
    }

    public function contains(Area|Point $point): bool
    {
        if ($point instanceof Area) {
            return $this->contains($point->minCorner) && $this->contains($point->maxCorner);
        }

        return $this->minCorner->x <= $point->x && $point->x <= $this->maxCorner->x
            && $this->minCorner->y <= $point->y && $point->y <= $this->maxCorner->y;
    }

    public function extend(Orientation $orientation): self
    {
        return match ($orientation) {
            Orientation::North, Orientation::West =>
            Area::covering($this->minCorner->inDirection($orientation), $this->maxCorner),
            Orientation::East, Orientation::South =>
            Area::covering($this->minCorner, $this->maxCorner->inDirection($orientation)),
        };
    }

    public function width(): int
    {
        return $this->maxCorner->x - $this->minCorner->x;
    }

    public function height(): int
    {
        return $this->maxCorner->y - $this->minCorner->y;
    }

    public function __toString()
    {
        return "$this->minCorner → $this->maxCorner";
    }
}
