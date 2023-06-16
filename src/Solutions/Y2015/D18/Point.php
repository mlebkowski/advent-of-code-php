<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D18;

use Stringable;

final class Point implements Stringable
{
    public static function of(int $x, int $y): self
    {
        assert($x >= 0 && $y >= 0);
        return new self($x, $y);
    }

    private function __construct(public int $x, public int $y)
    {
    }

    public function adjacent(): iterable
    {
        foreach (range(max(0, $this->x - 1), $this->x + 1) as $x) {
            foreach (range(max(0, $this->y - 1), $this->y + 1) as $y) {
                $adjacent = Point::of($x, $y);
                if (false === $adjacent->equals($this)) {
                    yield $adjacent;
                }
            }
        }
    }

    public function equals(Point $other): bool
    {
        return $this->x === $other->x && $this->y === $other->y;
    }

    public function __toString(): string
    {
        return "{$this->x}×{$this->y}";
    }
}
