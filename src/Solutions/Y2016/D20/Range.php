<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D20;

final readonly class Range
{
    public static function of(int $min, int $max): self
    {
        return new self($min, $max);
    }

    public static function lowest(self $alpha, self $bravo): int
    {
        return $alpha->min <=> $bravo->min;
    }

    private function __construct(public int $min, public int $max)
    {
        assert($min <= $max);
    }

    public function blocks(int $value): bool
    {
        return $this->min <= $value && $value <= $this->max;
    }
}
