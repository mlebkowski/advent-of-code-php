<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D01;

use Stringable;

final readonly class Point implements Stringable
{
    public static function of(int $x, int $y): self
    {
        return new self($x, $y);
    }

    public static function center(): self
    {
        return self::of(0, 0);
    }

    public function __construct(public int $x, public int $y)
    {
    }

    public function inDirection(Orientation $direction): Point
    {
        return Point::of(
            x: $this->x + $direction->xDirection(),
            y: $this->y + $direction->yDirection(),
        );
    }

    public function lineSegment(Orientation $direction, int $length): LineSegment
    {
        $point = $this;
        $points = [$point];
        for ($step = 0; $step < $length; $step++) {
            $points[] = $point = $point->inDirection($direction);
        }
        return LineSegment::of(...$points);
    }

    public function distanceFromStart(): int
    {
        return abs($this->x) + abs($this->y);
    }

    public function offset(self $offset): self
    {
        return self::of($this->x - $offset->x, $this->y - $offset->y);
    }

    public function orientationBetween(Point $other): Orientation
    {
        return match ([$this->x <=> $other->x, $this->y <=> $other->y]) {
            [0, -1] => Orientation::North,
            [1, 0] => Orientation::East,
            [0, 1] => Orientation::South,
            [-1, 0] => Orientation::West,
        };
    }

    public function __toString(): string
    {
        return "{$this->x}×{$this->y}";
    }
}