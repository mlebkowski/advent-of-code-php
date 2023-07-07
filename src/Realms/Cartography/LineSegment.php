<?php
declare(strict_types=1);

namespace App\Realms\Cartography;

use loophp\collection\Collection;

final readonly class LineSegment
{
    public static function of(Point ...$points): self
    {
        return new self($points);
    }

    public static function between(Point $alpha, Point $bravo): self
    {
        $xDiff = $bravo->x <=> $alpha->x;
        $yDiff = $bravo->y <=> $alpha->y;
        assert(($xDiff === 0) ^ ($yDiff === 0));

        $count = max(abs($bravo->x - $alpha->x), abs($bravo->y - $alpha->y)) + 1;

        return self::of(
            ...
            Collection::range(0, $count)
                ->map(static fn (float $diff) => Point::of(
                    x: $alpha->x + (int)($xDiff * $diff),
                    y: $alpha->y + (int)($yDiff * $diff),
                ))
                ->all(),
        );
    }

    private function __construct(public array $points)
    {
        assert(count($this->points) > 1);
        $x = Collection::fromIterable($this->points)
            ->map(static fn (Point $point) => $point->x)
            ->distinct()
            ->count();
        $y = Collection::fromIterable($this->points)
            ->map(static fn (Point $point) => $point->y)
            ->distinct()
            ->count();
        assert(($x === 1 && $y === count($this->points)) || ($y === 1) && $x === count($points));
    }

    public function start(): Point
    {
        return $this->points[0];
    }

    public function rest(): array
    {
        return array_slice($this->points, 1);
    }

    public function end(): Point
    {
        return $this->points[count($this->points) - 1];
    }
}
