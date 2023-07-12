<?php
declare(strict_types=1);

namespace App\Realms\Cartography;

use App\Realms\Cartography\Distance\Distance;
use RuntimeException;
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

    public static function sortForGrid(self $alpha, self $bravo): int
    {
        return $alpha->y <=> $bravo->y ?: $alpha->x <=> $bravo->x;
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

    public function adjacent(): array
    {
        return [
            self::of(x: $this->x - 1, y: $this->y - 1),
            self::of(x: $this->x + 0, y: $this->y - 1),
            self::of(x: $this->x + 1, y: $this->y - 1),
            self::of(x: $this->x - 1, y: $this->y + 0),
            self::of(x: $this->x + 1, y: $this->y + 0),
            self::of(x: $this->x - 1, y: $this->y + 1),
            self::of(x: $this->x + 0, y: $this->y + 1),
            self::of(x: $this->x + 1, y: $this->y + 1),
        ];
    }

    public function opposite(): self
    {
        return new self($this->x * -1, $this->y * -1);
    }

    public function orthogonallyAdjacent(): array
    {
        return [
            self::of(x: $this->x + 0, y: $this->y - 1),
            self::of(x: $this->x - 1, y: $this->y + 0),
            self::of(x: $this->x + 1, y: $this->y + 0),
            self::of(x: $this->x + 0, y: $this->y + 1),
        ];
    }

    public function distance(self $other): Distance
    {
        return Distance::between($this, $other);
    }

    public function offset(self $offset): self
    {
        return self::of($this->x - $offset->x, $this->y - $offset->y);
    }

    public function orientationBetween(Point $other): Orientation
    {
        $xDirection = $other->x <=> $this->x;
        $yDirection = $other->y <=> $this->y;
        foreach (Orientation::cases() as $orientation) {
            if ($orientation->xDirection() === $xDirection && $orientation->yDirection() === $yDirection) {
                return $orientation;
            }
        }

        throw new RuntimeException("Points $this and $other are on a diagonal");
    }

    public function equals(self $other): bool
    {
        return $this->x === $other->x && $this->y === $other->y;
    }

    public function __toString(): string
    {
        return "{$this->x}×{$this->y}";
    }
}
