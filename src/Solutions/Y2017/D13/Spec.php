<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D13;

final readonly class Spec
{
    public static function of(int $depth, int $range): self
    {
        return new self($depth, $range);
    }

    private function __construct(public int $depth, public int $range)
    {
    }

    public function catchesPacket(int $delay = 0): bool
    {
        return ($delay + $this->depth) % $this->term() === 0;
    }

    public function severity(): int
    {
        return $this->depth * $this->range;
    }

    private function term(): int
    {
        return ($this->range - 1) * 2;
    }
}
