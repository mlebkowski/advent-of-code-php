<?php
declare(strict_types=1);

namespace App\Realms\Physics;

use Stringable;

final readonly class Vector implements Stringable
{
    public static function of(int $x, int $y, int $z = 0): self
    {
        return new self($x, $y, $z);
    }

    private function __construct(public int $x, public int $y, public int $z)
    {
    }

    public function add(self $other): self
    {
        return new self($this->x + $other->x, $this->y + $other->y, $this->z + $other->z);
    }

    public function value(): int
    {
        return abs($this->x) + abs($this->y) + abs($this->z);
    }

    public function __toString(): string
    {
        return "<$this->x,$this->y,$this->z>";
    }
}
