<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D18;

use loophp\collection\Collection;
use Stringable;

final readonly class Rectangle implements Stringable
{
    public static function covering(Point ...$point): self
    {
        $xValues = Collection::fromIterable($point)->map(static fn (Point $point) => $point->x);
        $yValues = Collection::fromIterable($point)->map(static fn (Point $point) => $point->y);

        $minX = $xValues->min();
        $minY = $yValues->min();
        $maxX = $xValues->max();
        $maxY = $yValues->max();

        return new self(Point::of($minX, $minY), Point::of($maxX, $maxY));
    }

    private function __construct(public Point $minCorner, public Point $maxCorner)
    {
        assert($this->minCorner->x < $maxCorner->x);
        assert($this->minCorner->y < $maxCorner->y);
    }

    public function contains(Point $point): bool
    {
        return $this->minCorner->x <= $point->x && $point->x <= $this->maxCorner->x
            && $this->minCorner->y <= $point->y && $point->y <= $this->maxCorner->y;
    }

    public function __toString()
    {
        return "$this->minCorner → $this->maxCorner";
    }
}
