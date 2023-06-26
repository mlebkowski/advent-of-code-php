<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D08\Operation;

use Stringable;

final readonly class RotateRow implements Stringable
{
    public static function of(int $y, int $offset): self
    {
        return new self($y, $offset);
    }

    private function __construct(public int $y, public int $offset)
    {
        assert($y >= 0);
    }

    public function __toString(): string
    {
        return sprintf('rotate row y=%d by %d', $this->y, $this->offset);
    }
}
