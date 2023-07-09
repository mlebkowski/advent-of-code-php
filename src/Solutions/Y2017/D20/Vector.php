<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D20;

final readonly class Vector
{
    public static function of(int $x, int $y, int $z): self
    {
        return new self($x, $y, $z);
    }

    private function __construct(public int $x, public int $y, public int $z)
    {
    }

    public function value(): int
    {
        return abs($this->x) + abs($this->y) + abs($this->z);
    }
}
