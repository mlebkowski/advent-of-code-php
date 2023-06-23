<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D01;

final readonly class Point
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

    public function distanceFromStart(): int
    {
        return abs($this->x) + abs($this->y);
    }

    public function offset(self $offset): self
    {
        return self::of($this->x - $offset->x, $this->y - $offset->y);
    }

}
